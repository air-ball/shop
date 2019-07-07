<?php
namespace app\admin\model;
use think\Model;
use think\Db;
/**
*   商品控制模型 
*/

class Goods extends Model
{
    //彻底删除数据
    public function del($goods_id)
    {
        //先查商品信息
        $goods_info = $this->get($goods_id);
        //删除图片  @ 隐藏错误信息
        @unlink($goods_info->getAttr('goods_img'));
        @unlink($goods_info->getAttr('goods_thumb'));
        //删除数据
        $goods_info->delete();
    }
    //编辑商品
    public function editGoods($post_data)
    {
        //处理推荐状态  单选框未选中时不会提交任何内容   
        $post_data['is_rec'] = isset($post_data['is_rec'])?1:0;
        $post_data['is_hot'] = isset($post_data['is_hot'])?1:0;
        $post_data['is_new'] = isset($post_data['is_new'])?1:0;
        //不能修改goods_sn 商品编号的内容   先删除要提交的数据里面的 编码该变量
        unset($post_data['goods_sn']);
        //可以不传修改条件，函数默认将主键设为修改条件
        return $this->isUpdate(true)->allowField(true)->save($post_data);
    }
    //推荐状态切换
    public function changeStatus($goods_id,$field)
    {
        //查询当前商品的信息
        $goods_info = $this->get($goods_id);
        if(!$goods_info)
        {
            $this->error='参数错误';
            return false;
        }
        //计算最后修改的内容
        $status = $goods_info->getAttr($field) ? 0:1;
        //修改内容
        $goods_info -> $field = $status;
        $goods_info->isUpdate(true)->save();
        return $status;
    }
    //获取商品列表
    public function goodsList($is_del = 0)
    {
        //保存查询商品的条件
        $map = ['is_del'=>$is_del];  //不显示回收站的商品
        //获取关键字 get.keyword
        $keyword = input('keyword');
        //判断是否输入了关键字
        if($keyword){
            // 拼搜索条件
            $map['goods_name'] = ['like','%'.$keyword.'%'];
        }
        //推荐状态的条件搜索    推荐、热销、新品
        $intro_type = input('intro_type');
        //判断是否选择了推荐状态条件
        if($intro_type)
        {
            // 添加查询条件数组中   1代表是
            $map[$intro_type] = 1;
        }

        //  使用分类作为条件搜索
        $cate_id = input('cate_id');
        if($cate_id)
        {
            //获取当前分类下的所有子分类      ID为 $cate_id的分类下面的子分类    true  控制静态变量是否清空
            $tree = model('Category')->getCateTree($cate_id,true);
            //提取所有的子类
            $son = [];  //保存in语法所需要指定的id数组
            $map['cate_id'] = $cate_id;
            $son[] = $cate_id; //查找子分类不包括自己本身
            foreach ($tree as $key =>$value)
            {
                $son[]=$value['id'];
            }
            $map['cate_id'] = ['in',$son];
        }

        //获取所有商品数据  分页 传参为 每页显示条数    query 为分页函数的第三个参数，  url额外地参数
        $data = Db::name('goods')->where($map)->paginate(10,false,['query'=>input()]);
        // dump(Db::name('goods')->getLastSql());
        return $data;
    }
    public function addGoods($post_data)
    {
        //添加时间
        $post_data['addtime'] = time();
        //开启事物
        Db::startTrans();
        try{
            //goods表 商品入库
            $this->allowField(true)->isUpdate(false)->save($post_data);
            //根据上一条SQL执行语句获取商品ID
            $goods_id = $this->getLastInsId();
            //调用模型方法完成数据的入库
            model('GoodsAttr')->addAll($goods_id,input('attr_ids/a'),input('attr_values/a'));
            // 完成商品相册入库
            model('GoodsImg')->addAll($goods_id);
            Db::commit();
        }catch(\Exception $e){
            Db::rollback();
            $this->error = '写入错误';
            return false;
        }
    }
}