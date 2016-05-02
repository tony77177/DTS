<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 养生常识管理
 * Created by PhpStorm.
 * User: zhaoyu
 * Date: 14-1-15
 * Time: 下午4:35
 */

class Health_list extends CI_Controller{

    private $per_page = 5; //每页显示数据条数
    private $uri_segment = 2; //分页方法自动测定你 URI 的哪个部分包含页数

    function __construct(){
        parent::__construct();
        $this->admin_model->auth_check();
        $this->load->library(array('common_class', 'pagination'));
        $this->load->model('news_model');
    }

    /**
     * Index
     */
    public function index(){

        $offset = 0; //偏移量
        $where = "WHERE type=1";

        if ($this->input->get('per_page')) {
            $offset = ((int)$this->input->get('per_page') - 1) * $this->per_page; //计算偏移量
        }

        $count = $this->news_model->get_list_total_num($where); //总条数

        //初始化分页数据
        $config = $this->common_class->getPageConfigInfo('/health_list/?', $count, $this->per_page, $this->uri_segment);
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $data['news_list'] = $this->news_model->get_list($offset, $this->per_page, $where);
        $this->load->view('health_list/health_news', $data);
    }

    /**
     * 添加文章
     */
    public function add(){
        if ($this->input->post('_title') && $this->input->post('_content')) {
            $result = $this->news_model->add_news($this->input->post('_title'), $this->input->post('_content'), $this->session->userdata('admin_info'), 1);
            if ($result) {
                die('ok');
            } else {
                die('fail');
            }
        }
        $this->load->view('health_list/health_add');
    }

    /**
     * 删除文章
     */
    function del(){
        if ($this->input->post('_uuid')) {
            $result = $this->news_model->del_news($this->input->post('_uuid'));
            if ($result) {
                die('ok');
            } else {
                die('fail');
            }
        } else {
            die('fail');
        }
    }

    /**
     * 文章编辑
     * @param $_id  文章ID
     */
    public function edit($_id){
        if (empty($_id)) {
            redirect('index');
        } else {

            if ($this->input->post('_title') && $this->input->post('_content')) {
                $result = $this->news_model->upd_news($_id, $this->input->post('_title'), $this->input->post('_content'));
                if ($result) {
                    die('ok');
                } else {
                    die('fail');
                }
            }

            $data['news_info'] = $this->news_model->get_list('0', '1', "WHERE id='" . $_id . "'");
            if (empty($data['news_info'])) {
                redirect('index');
            }
            $data['uuid'] = $_id;
            $this->load->view('health_list/health_edit', $data);
        }
    }

}

/* End of file health_list.php */
/* Location: ./app/controllers/health_list.php */