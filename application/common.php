<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Db;

//封装发邮件函数
/**
 * $param1  $to  string 收件人邮箱地址
 * $param2  $msg  string    发送的内容/验证码
 * $param3  $Subject    邮件主题 
 */
if(!function_exists('send_email')){
    function send_email($to,$msg,$Subject='账号注册邮件激活'){
        require '../extend/PHPMailer/class.phpmailer.php';
        $mail             = new PHPMailer();
        //读取配置信息
        $server = config('email_server');

        /*服务器相关信息*/
        $mail->IsSMTP();   //启用smtp服务发送邮件                     
        $mail->SMTPAuth   = true;  //设置开启认证             
        $mail->Host       = $server['host'];   	 //指定smtp邮件服务器地址  
        $mail->Username   = $server['username'];  	//指定用户名	
        $mail->Password   = $server['password'];		//邮箱的第三方客户端的授权密码
        /*内容信息*/
        $mail->IsHTML(true);
        $mail->CharSet    ="UTF-8";			
        $mail->From       = $server['form'];	 	//发件人邮箱	
        $mail->FromName   ="京西商城官方";	//发件人昵称
        $mail->Subject    = $Subject; //发件主题

        //验证码信息前缀
        $ss = '您本次注册验证码为：';
        $mail->MsgHTML($ss.$msg);	//邮件内容 支持HTML代码
    

        $mail->AddAddress($to);  //收件人邮箱地址
        //$mail->AddAttachment("test.png"); //附件
        return $mail->Send();			//发送邮箱
    }
}
if(!function_exists('md6')){
    
    //加盐
    function md6($password,$salt){
        return $password = md5(md5($password.$salt));
    }
}
if(!function_exists('get_tree'))
{
    /**
    * 对分类数据进行格式化
    * $param array  $data 原始数据
    * $param integer  $id 寻找的哪一个分类下的子分类
    * $param integer  $lev 层次
    * $param array
    * $param true false  是否要清空 $list   
    */
    function get_tree($data,$id=0,$lev=0,$is_clear=false)
    {
        static $list = [];  //保存的最终结果
        if($is_clear)
        {
            //已有的list 变量内容不保留
            $list = [];
        }
        foreach($data as $value)
        {
            if($value['parent_id'] == $id)
            {
                $value['lev'] = $lev;
                $list[] = $value;
                get_tree($data,$value['id'],$lev+1,false);
            }
        }
        return $list;
    }

    function get_me_son($data,$id=0)
    {
        static $list = [];  //保存的最终结果
        foreach($data as $value)
        {
            if($value['parent_id'] == $id)
            {
                $list[] = $value['id'];
                get_me_son($data,$value['id']);
            }
        }
        return $list;
    }
}

