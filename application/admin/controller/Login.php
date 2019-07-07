<?php
namespace app\admin\controller;
use think\Request;
use think\Db;
use think\Controller;
/**
*登录页 
*/

class Login extends Controller
{
    //退出登录
    public function logout()
    {
        //清除cookie
        cookie('admin_info',null);
        //提示并跳转到登录页
        $this->success('退出成功','login/index');

    }
    //生成验证码
    public function captcha()
    {
        $obj = new \think\captcha\Captcha([
            'length'=>3,
            'codeSet'=>'1234567890'
        ]);
        return $obj ->entry();
    }
    //完成用户登录操作
    public function index(Request $request)
    {
        if($request->isGet())
        {   
            return $this->fetch();
        }
        //接受表单，查询数据库验证账号密码是否正确
        $res = model('Admin')->login(input());
        if($res === false)
        {
            $this->error(model('Admin')->getError());
        }
        $this->success('ok','admin/index/index');
    }
}