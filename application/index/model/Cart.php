<?php
namespace app\index\model;
use think\Model;
use think\Db;
class Cart extends Model
{
    //数据库转移    登录后购物车数据cookie转移到数据库  cookie 数据销毁
    public function cookie2db(){
        //验证是否登录
        $user_info = session('user_info');
        if(!$user_info){
            //已登录
            return false;
        }

        //获取cookie数据
        $cart_list = cookie('cart_list');
        if($cart_list){
            foreach($cart_list as $key => $value)
            {
                //提取goods_id与goods_attr_ids
                $temp = explode('-',$key);
                //判断当前cookie中的购物车数据  在数据库中是否存在，存在则数量更新，不存在则写入数据
                $map = [
                    'goods_id'=>$temp[0],
                    'goods_attr_ids'=>$temp[1],
                    'user_id'=>$user_info['id']
                ];
                if($this->where($map)->find()){
                    //存在该数据（商品id跟属性id相同）
                    $this->where($map)->setField('goods_count',$value);
                }else{
                    //不存在该数据
                    $map['goods_count']=$value;
                    $this->isUpdate(false)->allowField(true)->save($map);
                }            
            }
        }

        //请客空cookie购物车数据
        cookie('cart_list',null);
    }
    public function changeNumber($goods_id,$goods_count,$goods_attr_ids){
        //判断用户是否登录
        $user_info = session('user_info');
        if($user_info){
            // 已登录
            $map = [
                'goods_id'=>$goods_id,
                'goods_attr_ids'=>$goods_attr_ids,
                'user_id'=>$user_info['id']
            ];
            $this->where($map)->setField('goods_count',$goods_count);
        }else{
            //未登录
            $cart_list = cookie('cart_list')?cookie('cart_list'):[];
            //组装下标名称
            $key = $goods_id.'-'.$goods_attr_ids;
            $cart_list[$key] = $goods_count;
            cookie('cart_list',$cart_list,3600*24*7);
        }
    }
    //删除购物车数据
    public function remove($goods_id,$goods_attr_ids){
        //判断是否登录
        $user_info = session('user_info');
        if($user_info){
            $map = [
                'goods_id'=>$goods_id,
                'goods_attr_ids'=>$goods_attr_ids,
                'user_id'=>$user_info['id']
            ];
            $this->where($map)->delete();
        }else{
            //查询cookie数据
            $cart_list = cookie('cart_list')?cookie('cart_list'):[];
            //组装cookie规则   商品id-属性id =>数量
            $key = $goods_id.'-'.$goods_attr_ids;
            unset($cart_list[$key]);
            cookie('cart_list',$cart_list,3600*24*7);
        }
    }

    //计算购物车
    public function getSum($data){
        //总数初始化
        $sum = 0;
        foreach($data as $value){
            $sum += $value['goods_count'];
        }
        return $sum;
    }
    //计算购物车总金额
    public function getTotal($data){
        //总金额初始化
        $total = 0;
        //循环购物车所有商品
        foreach($data as $value){
            $total += $value['goods']['shop_price']*$value['goods_count'];
        }
        return $total;
    }
    //获取购物车列表
    public function getList(){
        $user_info = session('user_info');
        if($user_info){
            //已登录情况
            $cart_list = db('cart')->where('user_id',$user_info['id'])->select();
        }else{
            //未登录
            $cart = cookie('cart_list')?cookie('cart_list'):[];
            //将cookie 中的数据格式转化成跟数据库的格式一致
            $cart_list = [];
            foreach($cart as $key =>$value)
            {
                //提取key中的内容
                $temp = explode('-',$key);
                $cart_list[]=[
                    'goods_id'=>$temp[0],
                    'goods_attr_ids'=>$temp[1],
                    'goods_count'=>$value
                ];
            }
        }
        // 循环获取数组   每一个数据代表一个购物车商品
        foreach($cart_list as $key =>$value){
            $cart_list[$key]['goods'] = db('goods')->where('id',$value['goods_id'])->find();
            //获取商品属性值信息
            $sql = "SELECT a.attr_value,b.attr_name FROM shop_goods_attr a 
                LEFT JOIN shop_attribute b on a.attr_id = b.id WHERE a.id IN({$value['goods_attr_ids']})";
            $cart_list[$key]['attrs'] = db('goods_attr')->query($sql);
        }
        return $cart_list;
    }
    //商品加入购物车
    public function addCart($goods_id,$goods_count,$goods_attr_ids){
        //判断用户是否登录
        $user_info = session('user_info');
        if($user_info){
            //用户已登录，先查询购物车数据库中是否存在相同商品，存在则累加数量，不存在则写入数据库
            $map = [
                'goods_id'=>$goods_id,
                'goods_attr_ids'=>$goods_attr_ids,
                'user_id'=>$user_info['id']
            ];
            if($this->where($map)->find()){
                //  setInc 设置指定字段的值增加 第二个参数为累加的数量，不写则默认 1    setDec  自减
                $this->where($map)->setInc('goods_count',$goods_count);
            }else{
                // 不存在相同的商品，则写入数据库
                $map['goods_count'] = $goods_count;
                $this->isUpdate(false)->allowField(true)->save($map);
            }
        }else{
            // 如果没有登录则操作Cookie,先查询cookie是否有相同商品，存在则累加，不存在则写入
            //读取cookie中的内容
            $cart_list = cookie('cart_list')?cookie('cart_list'):[];
            //组装下标名称  约束规则    商品id - 属性id =>数量
            $key = $goods_id.'-'.$goods_attr_ids;
            //判断是否存在    array_key_eists 判断$key下标 在数组中是否存在  因为这里的下标是由商品ID跟属性ID组成
            if(array_key_exists($key,$cart_list)){
                //累加数量
                $cart_list[$key] += $goods_count;
            }else{
                //新的商品写入购物车
                $cart_list[$key]=$goods_count;
            }
            //将数据保存到cookie中  6天有效
            cookie('cart_list',$cart_list,3600*24*6);
        }

    }
}
