<?php
namespace app\index\controller;
use think\Controller;
use think\Model;

class Index extends Common
{
    public function index()
    {
        //分配首页标识符    存在则说明为首页，反之则不是首页
        $this->assign('is_show',1);
        $goods_model = model('Goods');
        //获取热卖商品
        $goods['hot'] = $goods_model->getRecGoods('is_hot');
        //获取推荐商品
        $goods['rec'] = $goods_model->getRecGoods('is_rec');
        // 获取新品商品
        $goods['new'] = $goods_model->getRecGoods('is_new');
        $this->assign('goods',$goods);
        return $this->fetch();
    }
}
