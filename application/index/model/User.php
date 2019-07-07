<?php
namespace app\index\model;
use think\Model;
use think\Db;

class User extends Model{
    //返回数据的结果集
    protected $resultSetType = 'think\Collection';

    //邮箱注册
    public function email($username,$password,$email,$emcode){
        if($username && $password){

            //检查重名
            if($this->get(['username'=>$username])){
                $this->error = '用户名已存在';
                return false;
            }
            if($email){
                //检查邮箱
                if($this->get(['email'=>$email])){
                    $this->error = '该邮箱已注册';
                    return false;
                }

                //以防用户提收到验证码后修改邮箱
                if(!($email == session('email'))){
                    $this->error = '验证邮箱跟提交的邮箱地址不一致！';
                    return false;
                }
            }else{
                $this->error  = '邮箱不能为空';
            }
            
            if($emcode){
                //检查邮箱验证码
                if(!($emcode == cookie('emcode'))){
                    $this->error='邮箱验证码不正确';
                    return false;
                }
            }else{
                $this->error='邮箱验证码不能为空';
                return false;
            }

            //验证验证码
            $obj = new \think\captcha\Captcha();
            if(!$obj->check(input('captcha'))){
                $this->error='验证码错误';
                return false;
            }

            //计算激活码
            $active_code = uniqid();
            //生成盐
            $salt = rand(100000,999999);

            //密码
            $password = md6($password,$salt);

            //入库
            $data = [
                'username'=>$username,
                'password'=>$password,
                'email'=>$email,
                'salt'=>$salt
            ];
        
            //调用模型方法入库
            return $this->isUpdate(false)->allowField(true)->save($data);
        }else{
            $this->error="用户名或密码不能为空";
            return false;
        }
    }
    //登录
    public function login($username,$password){
        //查询数据库是否存在该用户
        $user_info = $this->get(['username'=>$username]);
        if(!$user_info)
        {
            $this->error= '账号错误';
            return false;
        }
        //将获取到的一组数据转换成数组格式
        $user_info->toArray();
        // 对比密码
        if($user_info['password'] != md6($password,$user_info['salt'])){
            $this->error = '密码错误';
            return false;
        }

        //保存用户登录状态
        session('user_info',$user_info);
        //转移购物车数据    登录后cookie的购物车数据转移到数据库
        model('Cart')->cookie2db();
    }
    //用户注册
    public function regist($username,$password)
    {
        if($username && $password){
            //检查重名
            if($this->get(['username'=>$username]))
            {
                $this->error = '用户名重名';
                return false;
            }
            //验证验证码
            $obj = new \think\captcha\Captcha();
            if(!$obj->check(input('captcha'))){
                $this->error='验证码错误';
                return false;
            }
            
            // 生成盐
            $salt = rand(100000000,999999999);
            //生成密码
            $password = md6($password,$salt);
            //入库
            $data = [
                'username'=>$username,
                'password'=>$password,
                'salt'=>$salt,
            ];
            $this->isUpdate(false)->allowField(true)->save($data);
        }else{
            $this->error = '用户名或密码不能为空';
            return false;
        }
    }
}