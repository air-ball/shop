<?php
namespace app\admin\controller;
use think\Request;
use think\Db;
use think\Model;
/**
*   商品属性类型 
*/

class Type extends Common
{
    //删除类型
    public function remove(){
        $res = Db::name('Type')->delete(input('id/d'));
            Cache('type_info',null);
            $this->success('删除成功','index');
    }
    //类型的编辑
    public function edit(Request $request)
    {
        $model = model('Type');
        if($request->isGet()){
            //显示原有数据
            $type_info = $model->get(input('id/d'));
            $this->assign('type_info',$type_info);
            return $this->fetch();
        }

        //处理提交表单
        $res = $this->validate(input(),'Type');
        if($res !==true)
        {
            $this->error($res);
        }
        $model ->editType(input());
        $this->success('ok','index');
    }


    //类型的列表
    public function index()
    {
        //获取类型列表数据
        $data = model('Type')->getList();
        $this-> assign('data',$data);
        return $this->fetch();
    }
    //类型的添加
    public function add(Request $request){
        if($request->isGet())
        {
            //加载前端模板
            return $this->fetch();
        }
        //处理提交数据  $res 成功返回true  不成功则返回错误信息
        $res = $this->validate(input(),'Type');
        if($res !== true)
        {
            $this->error($res);
        }

        
        //读取缓存内容
        $type_info = Cache('type_info');
        if(!$type_info)
        {
            //缓存中没有数据  先去数据库取出数据
            $type_info = model('Type')->all();
            //将数据放入缓存中
            Cache('type_info',$type_info,3600*24);
        }
        Db::name('type')->insert(input());
        Cache('type_info',null);
        $this->success('ok','index');

    }
}