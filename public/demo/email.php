<?php
/**
 * 发邮件
 */

require './PHPMailer/class.phpmailer.php';
$mail             = new PHPMailer();
/*服务器相关信息*/
$mail->IsSMTP();   //启用smtp服务发送邮件                     
$mail->SMTPAuth   = true;  //设置开启认证             
$mail->Host       = 'smtp.qq.com';   	 //指定smtp邮件服务器地址  
$mail->Username   = '931898631';  	//指定用户名	
$mail->Password   = 'fimmlnlklttobfjd';		//邮箱的第三方客户端的授权密码
/*内容信息*/
$mail->IsHTML(true);
$mail->CharSet    ="UTF-8";			
$mail->From       = '931898631@qq.com';	 		
$mail->FromName   ="你聪哥";	//发件人昵称
$mail->Subject    = '邮件发送使用phpmailer'; //发件主题
$mail->MsgHTML('邮件发送使用phpmailer');	//邮件内容 支持HTML代码


$mail->AddAddress('404181947@qq.com');  //收件人邮箱地址
//$mail->AddAttachment("test.png"); //附件
$mail->Send();			//发送邮箱