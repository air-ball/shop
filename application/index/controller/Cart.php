<?php
namespace app\index\controller;
class Cart extends Common
{
    //ajax修改商品数量
    public function changeNumber(){
        $goods_id = input('goods_id/d');
        $goods_count = input('goods_count'); 
        $goods_attr_ids = input('goods_attr_ids',''); 
        model('Cart')->changeNumber($goods_id,$goods_count,$goods_attr_ids);
        return json(['code'=>1]);
    }
    //购物车删除
    public function remove(){
        // 接受商品ID   属性id
        $goods_id = input('goods_id/d');
        $goods_attr_ids = input('goods_attr_ids');
        //调用模型方法删除
        model('Cart')->remove($goods_id,$goods_attr_ids);
        $this->success('删除成功','index');
    }
    //购物车列表
    public function index(){
        // 购物车数据
        $data = model('Cart')->getList();
        $this->assign('data',$data);
        //计算总金额C
        $total = model('Cart') ->getTotal($data);
        $this->assign('total',$total);
        return $this->fetch();
    }

    //商品加入购物车
    public function addCart()
    {
        //接受需要的参数
        $goods_id = input('goods_id/d');
        $goods_count=input('goods_count/d');
        $goods_attr_ids = input('attr_id/a');
        //将属性值ID组合转化成逗号风格的字符串
        $goods_attr_ids = implode(',',$goods_attr_ids);
        //助手函数调用模型方法
        model('Cart')->addCart($goods_id,$goods_count,$goods_attr_ids);
        $this->success('加入购物车成功');
    }
}