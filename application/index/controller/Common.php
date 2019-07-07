<?php
namespace app\index\controller;
use think\Model;
use think\Controller;
use think\Db;

class Common extends Controller{
    public function __construct()
    {
        parent::__construct();
        //查询需要的分类数据
        $category = Db::name('category')->select();
        $this->assign('category',$category);
    }

    //验证是否登录  $callback为登录成功后要跳转的路由地址
    public function checkLogin($callback){
        $user_info = session('user_info');
        if(!$user_info){
            $url = url('user/login','',true,true).'?callback='.$callback;
            $this->error('先登录',$url);
        }
    }
    
}