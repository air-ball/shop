<?php
namespace app\index\model;
use think\Model;

/**
 * 商品信息
 */
class Goods extends Model
{
    //通过id获取商品信息
    public function getGoodsInfo($goods_id){
        $query = db('goods');
        //使用query 对象调用方法查询数据
        $goods = $query->find($goods_id);
        //获取商品相册图片
        $goods['imgs']=db('goods_img')->where('goods_id',$goods_id)->select();
         //获取商品属性信息
        $attr = db('goods_attr')->alias('a')->field('a.*,b.attr_name,b.attr_type')->where('a.goods_id',$goods_id)
        ->join('shop_attribute b','a.attr_id=b.id','left')->select();
        foreach($attr as $key =>$value)
        {
            if($value['attr_type'] == 1){
                //唯一属性
                $goods['onlyone'][]=$value;
            }else{
                //单选属性
                //以属性id作为第一个维度的下标，方便操作数据
                $goods['single'][$value['attr_id']][]=$value;
            }
        }
        return $goods;
    }
    //获取不同状态下的商品
    public function getRecGoods($field){
        return $this->where($field,1)->limit(5)->select();
    }    
}