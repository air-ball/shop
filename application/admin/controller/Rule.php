<?php
namespace app\admin\controller;
use think\Request;
use think\Model;
/**
 * 权限管理
 */

 class Rule extends Common
 {
    //缓存更新
    public function flush()
    {
        return $this->clearCache();
    }
    //删除权限
    public function remove(){
        model('Rule')->destroy(input('id/d'));
        $this->success('删除成功','index');
    }
    //权限编辑
    public function edit(Request $request){
        $model = model('Rule');
        if($request->isGet()){
            //根据id查数据
            $rule_info =$model->where('id',input('id'))->find();
            $this->assign('rule_info',$rule_info);
            //查询所有权限数据
            $rules = model('Rule') ->getRules();
            $this->assign('rules',$rules);
            return $this->fetch();
        }
        //处理提交表单
        $res = $model ->isUpdate(true)->allowField(true)->save(input());
        if($res === false){
            $this->error($model->getError());
        }
        $this->success('修改成功','index');
    }
    //  权限列表
    public function index(){
        
        //获取所有格式化之后的数据 模型对象调用自定义方法
        $rules = model('Rule') ->getRules();
        $this->assign('rules',$rules);
        return $this->fetch();
    }
    //添加权限
    public function add(Request $request){
        //获取模型对象
        $model = model('Rule');
        if($request->isGet()){
            //获取所有格式化之后的数据 模型对象调用自定义方法
            $rules = $model ->getRules();
            //将数据分配给模板
            $this->assign('rules',$rules);
            return $this->fetch();
        }
        if(!input('rule_name')){
            $this->error('不能为空','add');
            return false;
        }
        //处理表单
        $res = $model->isUpdate(false)->allowField(true)->save(input());
        $this->success('添加成功','index');
    }
 } 