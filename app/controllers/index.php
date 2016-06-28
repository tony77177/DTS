<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 后台首页控制器
 * Created by PhpStorm.
 * User: TONY
 * Date: 13-12-28
 * Time: 下午1:00
 */

class Index extends CI_Controller{

    function __construct(){
        parent::__construct();
        //$this->admin_model->auth_check();
        $this->load->model('index_model');

        //加载PHP EXCEL
        $this->load->library('PHPExcel');
        $this->load->library('PHPExcel/IOFactory');

        //加载自定义选项
        $this->config->load('user_define', TRUE);

//        $this->load->library('phpexcel');



        //模拟UA提交
        //ini_set('user_agent','Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 5.0)');

    }

    /**
     * 后台管理首页
     */
    public function index(){
        /*$data['message_num'] = $this->index_model->get_message_total_num();
        $data['news_num'] = $this->index_model->get_news_total_num();
        $data['login_num'] = $this->index_model->get_log_total_num($this->session->userdata('admin_info'));
        $data['latest_login'] = $this->index_model->get_latest_login_time($this->session->userdata('admin_info'));*/
        //$this->load->view('index', $data);

        //$this->load->library('PHPExcel/IOFactory');
        $this->load->view('index');

    }

    /**
     * 根据前台回传域名解析对应IP地址，并利用IP地址解析其归属地
     *
     * 默认有3个API供选择，默认情况选择淘宝API获取信息
     */
    public function get_info(){
        $search_info = $this->input->post('_search_info');

        //die($this->config->config['user_define']['ip_api_info']['taobao']);

        $api_link = $this->config->config['user_define']['ip_api_info'][$this->config->config['user_define']['cur_ip_api_cfg']];//组装API链接地址

        //die(gethostbyname($search_info));

        //die($this->config->config['user_define']['ip_api_info']['taobao']);

        $get_result_info = $api_link.gethostbyname($search_info);//组装最终请求地址，利用PHP gethostbyname函数解析域名地址

        $result = json_decode(file_get_contents($get_result_info));//获取网页请求返回内容

        $result_code = $result->code;

        $result_data = $result->data->country;

        $result_data .= ','.$result->data->region;

        $result_data .= ','.$result->data->city;

        $result_data .= ','.$result->data->isp;

        if($result_code==1){
            die('fail');
        }else{
            die($result_data);
        }

    }


    /**
     * 上传excel文件，并进行解析返回对应IP结果
     *  暂定两种处理逻辑：
     *      1）如果有IP则直接查询归属地；
     *      2）如果是域名，先通过DNS解析IP，然后再查询归属地
     *
     *  查询完成之后封装对应的结果，生成excel文件进行输出
     *
     *  create time:2016-6-6 11:19:45
     */

     public function get_info_by_file(){
         //$this->load->library('PHPExcel');

//         $this->load->library('phpexcel');
//         $this->load->library('PHPExcel/iofactory');

         $this->load->file(APPPATH.'libraries/PHPExcel/IOFactory.php'); //full path to

         //$this->load->library ( array( 'form_validation' ,'PHPExcel','PHPExcel/IOFactory'));

         $objPHPExcel = new PHPExcel();
         $objPHPExcel -> getProperties() -> setTitle("export") -> setDescription("none");

         $objPHPExcel -> setActiveSheetIndex(0);


         $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');
//         $objWriter = IOFactory :: createWriter($objPHPExcel, 'Excel5');
         // Sending headers to force the user to download the file
         header('Content-Type: application/vnd.ms-excel');
         header('Content-Disposition: attachment;filename="Products_' . date('dMy') . '.xls"');
         header('Cache-Control: max-age=0');

         $objWriter -> save('php://output');


     }



    /**
     * 密码修改
     */
    public function change_pwd(){

        //POST如果有数据则进行更新验证
        if ($this->input->post('curr_pwd') && $this->input->post('new_pwd')) {
            //验证当前密码是否正确
            $num = $this->admin_model->check_login($this->session->userdata('admin_info'), md5($this->input->post('curr_pwd')));
            if (!$num) {
                die('fail');
            } else {
                $result = $this->admin_model->change_pwd($this->session->userdata('admin_info'), md5($this->input->post('new_pwd')));
                if ($result) {
                    die('ok');
                } else {
                    die('0');
                }
            }
        }
        $this->load->view('change_pwd');
    }
}

/* End of file index.php */
/* Location: ./app/controllers/index.php */