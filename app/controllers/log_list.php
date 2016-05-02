<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 登陆日志控制器
 * Created by PhpStorm.
 * User: zhaoyu
 * Date: 13-12-31
 * Time: 下午4:53
 */

class Log_list extends CI_Controller{

    private $per_page = 5; //每页显示数据条数
    private $uri_segment = 2; //分页方法自动测定你 URI 的哪个部分包含页数

    function __construct(){
        parent::__construct();
        $this->admin_model->auth_check();
        $this->load->library(array('common_class', 'pagination'));
        $this->load->model('log_model');
    }

    /**
     * Index
     */
    public function index(){
        $offset = 0; //偏移量

        if ($this->input->get('per_page')) {
            $offset = ((int)$this->input->get('per_page') - 1) * $this->per_page;//计算偏移量
        }

        $count = $this->log_model->get_list_total_num(); //总条数

        //初始化分页数据
        $config = $this->common_class->getPageConfigInfo('/log_list/?', $count, $this->per_page, $this->uri_segment);
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $data['log_list'] = $this->log_model->get_list($offset, $this->per_page);
        $this->load->view('log_manage/log_list', $data);
    }

}

/* End of file log_list.php */
/* Location: ./app/controllers/log_list.php */