<?php
namespace app\index\controller;
class Goods extends Common
{
    public  function detail()
    {
        //获取商品信息
        $goods_model = model('Goods');
        $goods = $goods_model->getGoodsInfo(input('id/d'));
        $this->assign('goods',$goods);
        return $this->fetch();
    }
}