<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 自定义相关配置类
 * Created by PhpStorm.
 * User: zhaoyu
 * Date: 14-1-2
 * Time: 下午3:33
 * Modify: 2016-5-24 12:18:59
 */

/**
 * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
 *                      发送邮件配置参数说明
 * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
 *
 * smtp_host    SMTP服务器地址
 *
 * smtp_user    发送邮件的账号
 *
 * smtp_pass    发送邮件密码
 *
 * email_addr   发送邮件的完整email地址
 *
 * email_title  `发送邮件的标题
 *
 * send_to       接收邮件地址
 *
 */

$config['email_config_info'] = array(
    'smtp_host' => 'smtp.126.com',
    'smtp_user' => 'justfortest77',
    'smtp_pass' => 'woainitest',
    'email_addr' => 'justfortest77@126.com',
    'email_title' => '咨询留言邮件',
    'send_to' => 'tony77@foxmail.com'
);

/**
 * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
 *             获取IP归属API配置
 * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
 *
 * taobao    淘宝API免费公共接口       地址：http://ip.taobao.com/
 *
 * ipip      IPIP.net免费公共接口     地址：http://freeapi.ipip.net/
 *
 * ip138     IP138.com免费公共接口    地址：http://www.ip138.com/api/
 *
 *
 */

$config['ip_api_info'] = array(
    'taobao' => 'http://ip.taobao.com/service/getIpInfo.php?ip=',
    'ipip' => 'http://freeapi.ipip.net/',
    'ip138' => 'http://test.ip138.com/query/?ip='
);



/* End of file user_define.php */
/* Location: ./app/config/user_define.php */