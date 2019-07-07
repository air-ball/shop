<?php
namespace app\index\model;
use think\Model;
use think\Db;

class Order extends Model{

    // 下单方法
    public function order($order){
        //订单主表写入内容
        // 提取用户id
        $order['user_id'] = session('user_info')['id'];
        //计算订单号
        $order['order_sn'] =date('YmdHis').rand(100000,999999);

        //获取购物车数据
        $cart_list = model('Cart')->getList();
        //计算总金额
        $order['total'] =  model('Cart')->getTotal($cart_list);
        //获取到写入的ID
        $order['id'] = $this->getLastInsId();

        //订单详情写入表格
        $order_detail=[];
        foreach($cart_list as $key =>$value){
            $order_detail[] =[
                'order_id'=>$order['id'],
                'goods_id'=>$value['goods_id'],
                'goods_count'=>$value['goods_count'],
                'goods_attr_ids'=>$value['goods_attr_ids']                
            ];
        }

        //开启事务
        Db::StartTrans();
        try{
            //批量写入数据  订单主表
            $this->save($order);
            //写入订单详情表
            db('order_detail')->insertAll($order_detail);
            Db::commit();
        }catch(\Exception $e){
            //回滚
            Db::rollback();
        }

        //清空购物车
        return $order;
    }
}