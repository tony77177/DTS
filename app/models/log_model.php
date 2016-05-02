<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 登录日志模型
 * Created by PhpStorm.
 * User: TONY
 * Date: 14-1-1
 * Time: 下午12:34
 */

class Log_model extends CI_Model{

    function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    /**
     * 获取登录日志列表
     * @param int $offset       偏移量
     * @param int $page_size    显示条数
     * @param string $where     条件查询
     * @return mixed            结果集
     */
    function get_list($offset = NULL, $page_size = NULL, $where = NULL){
        $list_sql = "SELECT * FROM t_log $where ORDER BY log_dt DESC LIMIT $offset,$page_size";
        $result = $this->common_model->getDataList($list_sql, 'default');
        return $result;
    }

    /**
     * 获取登录日志数据总条数
     * @return int              条数
     */
    function get_list_total_num(){
        $sql = "SELECT COUNT(*) AS num FROM t_log";
        $count = $this->common_model->getTotalNum($sql, 'default');
        return $count;
    }

}

/* End of file log_model.php */
/* Location: ./app/models/log_model.php */