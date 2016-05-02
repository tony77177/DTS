<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**]
 * 首页信息获取模型
 * Created by PhpStorm.
 * User: zhaoyu
 * Date: 14-1-2
 * Time: 下午2:47
 */

class Index_model extends CI_Model{

    function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    /**
     * 获取新闻列表总数
     * @return mixed    新闻总条数
     */
    function get_news_total_num(){
        $sql = "SELECT COUNT(*) AS num FROM t_news";
        $count = $this->common_model->getTotalNum($sql, 'default');
        return $count;
    }

    /**
     * 获取当前登录用户的登录次数
     * @param $_login_name          登录用户名
     * @return mixed                        登录次数
     */
    function get_log_total_num($_login_name){
        $sql = "SELECT COUNT(*) AS num FROM t_log WHERE admin_name='" . $_login_name . "'";
        $count = $this->common_model->getTotalNum($sql, 'default');
        return $count;
    }

    /**
     * 获取当前用户最近一次登录时间
     * @param $_login_name          用户名
     * @return mixed                    上次登录时间
     */
    function get_latest_login_time($_login_name){
        $latest_sql = "SELECT log_dt FROM t_log WHERE admin_name='" . $_login_name . "' ORDER BY log_dt DESC LIMIT 1";
        $result = $this->common_model->getDataList($latest_sql, 'default');
        return $result[0]["log_dt"];
    }

    /**
     * 获取留言总条数
     * @return mixed    留言总条数
     */
    function get_message_total_num(){
        $sql = "SELECT COUNT(*) AS num FROM t_message";
        $count = $this->common_model->getTotalNum($sql, 'default');
        return $count;
    }

}

/* End of file index_model.php */
/* Location: ./app/models/index_model.php */