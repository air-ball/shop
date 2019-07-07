<?php
namespace app\admin\controller;
use think\Request;
use think\Db;
use think\Model;
/**
*   商品属性 
*/
class Attribute extends Common
{
    //编辑属性
    public function edit(Request $request)
    {
        $model = model('Attribute');
        if($request ->isGet())
        {
            //获取当前要修改属性
            $attr_info = $model ->get(input('id'));
            $this->assign('attr_info',$attr_info);
            //查询所有的类型
            $type = model('Type')->getList();
            $this->assign('type',$type);
            return $this->fetch();
        }
        //处理表单
        $res = $model ->editAttr(input());
        if($res === false)
        {
            $this->error($model->getError());
        }
        $this->success('ok','index');
    }
    //属性删除
    public function remove()
    {
        model('Attribute')->remove(input('id'));
        $this->success('ok','index');
    }
    //属性列表
    public function index()
    {
        $data = model('Attribute')->getList();
        $this->assign('data',$data);
        return $this->fetch();
    }
    //添加属性
    public function  add(Request $request)
    {
        if($request->isGet())
        {
            //查询所有的类型
            $type = model('Type')->getList();
            $this->assign('type',$type);
            return $this->fetch();
        }
        //处理表单
        $model = model('Attribute');
        //调用attribute模型方法
        $res = $model->addAttr(input());
        if($res === false)
        {
            $this->error($model->getError());
        }
        $this->success('ok','index');
    }
}