<?php
namespace app\admin\model;
use think\Db;
use think\Model;

class Admin extends Model{
    //编辑用户
    public function editUser($data)
    {
        //用户名是否重复
        $map = [
            'username'=>$data['username'],
            //若未修改用户名，则排除自身在内
            'id'=>['neq',$data['id']]
        ];
        if($this->get($map)){
            $this->error = '用户名已存在';
            return false;
        }
        //若未修改密码，则销毁该变量，以免空变量覆盖数据库的密码
        if(!$data['password'])
        {
            unset($data['password']);
        }else{
            //处理密码
            $data['password'] = md5($data['password']);    
        }
        return $this->isUpdate(true)->allowField(false)->save($data);
    }
    //用户列表
    public function getList(){
        return $data = model('admin')->select();
    }
    //添加用户
    public function addUser($data)
    {
        //验证用户名是否唯一
        if($this->get(['username'=>$data['username']]))
        {
            $this->error = '用户名已存在';
            return false;
        }
        //处理表单
        return $this->isUpdate(false)->allowField(true)->save($data);

    }
    public function login($data){
        //检查验证码
        $obj = new \think\captcha\Captcha();
        if(!$obj ->check($data['captcha'])){
            $this->error = '验证码错误';
            return false;
        }
        //检查账号和密码
        $user_info = $this->get(['username'=>$data['username'],'password'=>md5($data['password'])]);
        if(!$user_info)
        {
            $this->error = '用户名或密码错误';
            return false;
        }
        // 验证通过，保存用户状态（用户是否选择保持登录）
        $expire = 0;    //默认cookie保存时间为0  关闭页面则销毁
        if(isset($data['remember']))
        {
            //保存登录状态(七天自动登录)
            $expire = 3600*24*7;
        }
        cookie('admin_info',$user_info->toArray(),$expire);
    }
}