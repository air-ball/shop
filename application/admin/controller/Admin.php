<?php
namespace app\admin\controller;
use think\Model;
use think\Request;
use think\Db;
/**
 * 用户管理
 */
class Admin extends Common{
    //缓存更新
    public function flush()
    {
        return $this->clearCache();
    }
    
    //编辑用户信息
    public function edit(Request $request){
        //防止用户强行在url中编辑超级管理员
        $uId = input('id/d');
        if($uId<=1){
            $this->error('参数错误','index');
        }
        if($request->isGet()){
            //显示原来数据
            $data = Db::name('admin')->where('id',$uId)->find();
            $this->assign('admin_info',$data);

            //获取角色信息
            $role_info = model('Role')->getList();
            $this->assign('role_info',$role_info);
            return $this->fetch();
        }
        //处理表单
        $model = model('Admin');
        $res = $model->editUser(input());
        if($res === false){
            $this->error($model->getError());
        }
        $this->success('修改成功','index');
    }
    //后台用户列表
    public function index()
    {
        //获取用户表数据
        $data = model('Admin')->getList();
        $this->assign('admin_info',$data);
        //获取所有角色数据
        $role_info = model('Role')->getList();
        $this->assign('role_info',$role_info);
        return $this->fetch();
    }
    //添加用户 
    public function add(Request $request){
        if($request->isGet())
        {
            //获取可用的角色
            $role_info = model('Role')->getList();
            $this->assign('role_info',$role_info);
            return $this->fetch();
        }
        //处理表单
        $data = input();
        $data['password'] = md5($data['password']);
        $res = model('Admin')->addUser($data);
        if($res === false){
            return $this->error($res,'index');
        }
        return $this->success('添加成功','index');
    }

}