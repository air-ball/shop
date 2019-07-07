<?php
namespace app\index\controller;
use think\Request;
class User extends Common
{
    /***************************邮箱注册方法*******************************/

    //发送邮件
    public function send(){
        //发邮件
        $to = input('to');
        if(!$to){
            return  json(['code'=>0,'msg'=>'邮箱不能为空']);
        }
        //随机生成验证码
        $msg = rand(100000,999999);
        //将验证码存入session
        cookie('emcode',$msg,600);
        //将收验证码的邮箱地址保存到session
        session('email',$to);
        send_email($to,$msg,'京西商城');
    }

    //邮箱注册
    public function email(Request $request){
        if($request ->isGet()){
            //显示模板
            return $this->fetch();
        }
        $model = model('User');
        //调用模型方法注册
        $res = $model->email(input('username'),input('password'),input('email'),input('emcode'));
        if($res === false){
            // return json(['code'=>0,'msg'=>'注册失败']);
           return $this->error($model->getError());
        }
        return json(['code'=>1,'msg'=>'注册成功']);
    }

    /***************************邮箱注册方法      END*******************************/

    //退出登录
    public function logout(){
        session('user_info',null);
        $this->redirect('login');
    }
    //登录
    public function login(Request $request){
        if($request->isGet()){
            return $this->fetch();
        }
        //处理表单
        $model = model('User');
        $res = $model->login(input('username'),input('password'));
        if($res === false){
            $this->error($model->getError());
        }
        //登录成功后返回上一页
        if(input('callback'))
            header('location:'.input('callback'));
        else
            $this->success('登录成功','index/index');
    }
    

    /*******************************纯账号密码注册方法*************************************/
    //ajax注册
    public function doregist(Request $request){
        if(!$request->isAjax()){
            return json(['code'=>0,'msg'=>'非法请求，匿了']);
        }
        $model = model('User');
        //调用模型方法注册
        $res = $model ->regist(input('username'),input('password'));
        if($res === false){
            return json(['code'=>0,'msg'=>$model->getError()]);
        }
        return json(['code'=>1,'msg'=>'注册成功']);
    }

    /*************************纯账号密码注册方法      END*************************************/

    //生成验证码
    public function captcha()
    {
        $obj = new \think\captcha\Captcha([
            'length'=>3,
            'codeSet'=>'1234567890'
        ]);
        return $obj ->entry();
    }
    public function regist()
    {
        return $this->fetch();
    }


}