<?php
namespace app\admin\controller;
use think\Request;
use think\Db;
use think\Model;
/**
 * 添加角色
 */ 

class Role extends Common
{
    //缓存更新
    public function flush()
    {
        return $this->clearCache();
    }
    //分配权限
    public function disfetch(Request $request){
        
        //获取到当前角色ID值
        $rid = input('id/d');
        if($request->isGet()){
            //获取当前已有的权限
            $rule_info = model('role')->find($rid);
            $this->assign('hasRules',$rule_info['role_ids']);
            //显示表单中所有权限数据
            $rules = Db::name('rule')->select();
            $this->assign('rule_info',$rules);
            return $this->fetch();
        }
        //权限ID集
        $data = implode(',',input('role_ids/a'));
        //Db入库
        $res = Db::name('role')->where('id',$rid)->setField('role_ids',$data);
        if($res === false){
            $this->error('分配失败','index');
        }
        $this->success('分配成功','index');
    }
    //添加角色
    public function add(Request $request)
    {
        if($request->isGet())
        {
            return $this->fetch();
        }
        $data = input(); 
        $res = model('Role')->addRole($data);
        if($res === false){
            return $this->error('添加失败');
        }
        $this->success('添加成功','index');
    }
    
    //角色列表
    public function index(){
        //查询所有角色
        $role_info = model('Role')->getList();
        $this->assign('role_info',$role_info);
        return $this->fetch();
    }
    //编辑角色
    public function edit(Request $request){
        if($request->isGet())
        {
            $role_id = input('id');
            //获取旧数据
            $role_info = Db::name('role')->where('id',$role_id)->find();
            $this->assign('role_info',$role_info);
            return $this->fetch();
        }
        //处理表单
        $data = input();
        $res = model('role')->isUpdate(true)->allowField(true)->save($data);
        if($res === false){
            return $this->error($this->getError());
        }
        $this->success('修改成功','index');

    }

    //删除角色
    public function remove()
    {
        $data = input();
        $res = model('role')->destroy($data);
        if($res === false)
        {
            return $this->error($this->getError());
        }
        $this->success('删除角色成功','index');
    }
}