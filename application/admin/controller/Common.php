<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Cache;
/*
公共控制器
*/
class Common extends Controller
{
    //更新缓存
    public function clearCache(){
        //获取所有的后台用户
        $user_list = Db::name('admin')->select();
        foreach($user_list as $key =>  $value){
            cache('user_info_id_'.$value['id'],null);
        }
        return "更新成功";
    }
    //保存用户登录的数据    主要目的：角色ID
    public $_user = [];
    // 自动拦截未登录
    public function  __construct()
    {
        parent::__construct();
        //判断是否登录  赋值cookie中的用户信息给变量  若变量没有数据，则需要登录先
        $user_info = cookie('admin_info');
        if(!$user_info)
        {
            $this->error('先登录','login/index');
        }
        //读取缓存中的内容
        // 设置名称需要使用用户唯一标识，确保各读各的缓存
        $this->_user = cache('user_info_id_'.$user_info['id']);

        if(!$this->_user)
        {
            //登录成功后将用户的基本信息存储到属性中
            $this->_user = $user_info;

            //根据用户不同获取到对应角色下的权限数据
            if($this->_user['role_id'] == 1){
                //role_id 为 1，超级管理员，获取所有的权限信息
                $rule_list = Db::name('rule')->select();
            }else{
                //根据用户的角色ID获取权限ID
                $role_info = Db::name('role')->where('id',$this->_user['role_id'])->find();
                $rule_list = Db::name('rule')->where('id','in',$role_info['role_ids'])->select();
            }

            //格式化数据方便判断
            foreach($rule_list as $key =>$value)
            {
                //将用户具备的权限信息转换为一维数组保存到_user 属性中
                //rules 每个元素的内容为控制器与方法名称所组合的字符串。    方便后面验证用户访问的 控制器/方法 是否在所具有的下面数组中
                $this->_user['rules'][] = strtolower($value['controller_name'].'/'.$value['action_name']);  //拼出  控制器/方法名
                //将导航菜单数据储存到_user属性中
                if($value['is_show'] == 1){
                    $this->_user['menus'][] = $value; 
                }
            }

            //将数据写入缓存
            cache('user_info_id_'.$user_info['id'],$this->_user,3600*24);
        }

        //判断是否有权访问
        if($this->_user['role_id'] != 1 ){
            //增加固定权限------首页访问权限
            $this->_user['rules'][]='index/index';
            $this->_user['rules'][]='index/top';
            $this->_user['rules'][]='index/menu';
            $this->_user['rules'][]='index/main';
            //非超级管理员角色用户需要验证权限
            // 获取当前用户访问的控制器、方法名称
            $action = strtolower(request()->controller().'/'.request()->action());

            //判断用户所访问的控制器、方法名是否在他所具有权限的范围内   上面的$this->_user['rules']数组
            if(!in_array($action,$this->_user['rules'])){
                if(request()->isAjax()){
                    echo json_encode(['code'=>0,'msg'=>'无权访问']);
                    exit();
                }else{
                    $this->error('无权访问');
                }
            }
        }


    }
}