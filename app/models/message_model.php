<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 留言管理模型
 * Created by PhpStorm.
 * User: TONY
 * Date: 13-12-26
 * Time: 下午9:42
 */

class Message_model extends CI_Model{

    function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    /**
     * 获取留言列表
     * @param int $offset       偏移量
     * @param int $page_size    显示条数
     * @param string $where     条件查询
     * @return mixed            结果集
     */
    function get_list($offset = NULL, $page_size = NULL, $where = NULL){
        $list_sql = "SELECT * FROM t_message $where ORDER BY create_dt DESC LIMIT $offset,$page_size";
        $result = $this->common_model->getDataList($list_sql, 'default');
        return $result;
    }

    /**
     * 获取留言总条数
     * @return int              条数
     */
    function get_list_total_num(){
        $sql = "SELECT COUNT(*) AS num FROM t_message";
        $count = $this->common_model->getTotalNum($sql, 'default');
        return $count;
    }

}

/* End of file message_model.php */
/* Location: ./app/models/message_model.php */