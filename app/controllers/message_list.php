<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 留言列表控制器
 * Created by PhpStorm.
 * User: zhaoyu
 * Date: 13-12-31
 * Time: 下午4:38
 */

class Message_list extends CI_Controller{

    private $per_page = 5; //每页显示数据条数
    private $uri_segment = 2; //分页方法自动测定你 URI 的哪个部分包含页数

    function __construct(){
        parent::__construct();
        $this->admin_model->auth_check();
        $this->load->library(array('email', 'pagination', 'common_class'));
        $this->load->model('message_model');
    }

    /**
     * Index
     */
    public function index(){

        $offset = 0; //偏移量

        if ($this->input->get('per_page')) {
            $offset = ((int)$this->input->get('per_page') - 1) * $this->per_page;//计算偏移量
        }

        $count = $this->message_model->get_list_total_num(); //总条数

        //初始化分页数据
        $config = $this->common_class->getPageConfigInfo('/message_list/?', $count, $this->per_page, $this->uri_segment);
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $data['message_list'] = $this->message_model->get_list($offset, $this->per_page);
        $this->load->view('message_manage/message_list', $data);
    }

    public function send_mail(){

        if ((!$this->input->post('user_name')) || (!$this->input->post('content')) || (!$this->input->post('phone_number')) || (!$this->input->post('add_time'))) {
            die('fail');
        }

        //获取EMIAL相关配置信息
        $data['email_config_info'] = $this->common_class->getUserConfInfo('email_config_info');

        $host = $data['email_config_info']['smtp_host'];

        $user = $data['email_config_info']['smtp_user'];

        $pass = $data['email_config_info']['smtp_pass'];

        $email_addr = $data['email_config_info']['email_addr'];

        $email_title = $data['email_config_info']['email_title'];

        $send_to = $data['email_config_info']['send_to'];

        $config = $this->common_class->getEmailConfigInfo($host, $user, $pass);

        $this->email->initialize($config);

        $this->email->from($email_addr, $email_title);

        $this->email->to($send_to); //收件人
        $this->email->subject($email_title);
        $content = "<h3>姓名：" . $this->input->post('user_name') . "</h3>";
        $content .= "<h3>内容：" . $this->input->post('content') . "</h3>";
        $content .= "<h3>电话：" . $this->input->post('phone_number') . "</h3>";
        $content .= "<h3>时间：" . $this->input->post('add_time') . "</h3>";
        $content .= "邮件来自<a href=\"http://www.freedomdream.cn\" target=\"_blank\">畅想</a>";
        $this->email->message($content);

        if (!$this->email->send()) {
            echo 'fail';
        }else{
            echo 'ok';
        }
    }

}

/* End of file message_list.php */
/* Location: ./app/controllers/message_list.php */