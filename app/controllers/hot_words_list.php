<?php
/**
 * 搜索热词管理控制器
 * Created by PhpStorm.
 * User: zhaoyu
 * Date: 14-1-7
 * Time: 下午3:20
 */

class Hot_words_list extends CI_Controller{

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
        $this->load->view('search_manage/hot_words_list');
    }

}

/* End of file hot_words_list.php */
/* Location: ./app/controllers/hot_words_list.php */