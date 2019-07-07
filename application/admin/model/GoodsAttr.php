<?php
namespace app\admin\model;
use think\Model;
use think\Db;
/**
 * 商品属性的模型
 */

 class GoodsAttr extends Model
 {
     //根据商品ID查询属性名称 和 属性值
     public function getAttrByGoodsId($goods_id)
     {
         //执行原生SQL语句
         $sql='SELECT a.*,b.attr_name,b.attr_type,b.attr_input_type,b.attr_values FROM 
         shop_goods_attr a LEFT JOIN shop_attribute b on a.attr_id = b.id where a.goods_id = ?';
         $list = Db::query($sql,[$goods_id]);
         $attrs = [];   //保存最终结果
         //数据格式化
         foreach ($list as $key =>$value){
             if($value['attr_input_type'] == 2)
             {
                //select选择需要将默认值格式化为数组
                $value['attr_values'] = explode(',',$value['attr_values']);
             }
             $attrs[] = $value;
         }
         return $attrs;
     }
    //添加商品入库  goods_attr入库
    public function addAll($goods_id,$attr_ids,$attr_values)
    {
        $list = [];//最终要写入数据的结果变量
        
        //去重的临时变量  
        // 每循环一条数据就保存，然后下一次循环，判断新的数据是否在里面，在则代表重复，不在则代表不重复，将新数据再保存在该变量中
        $temp = [];
        
        //组装最终的数据格式
        foreach($attr_ids as $key =>$value)
        {
            //组装临时变量储存数据格式
            $string = $value.'-'.$attr_values[$key];
            if(in_array($string,$temp))
            {
                //说明数据已经存在重复  跳出本次循环
                continue;
            }
            //说明数据没有重复
            $temp[] = $string;

            //attr_ids 变量中一个元素对应就需要一条数据
            $list[] = [
                'goods_id'=>$goods_id,
                'attr_id'=>$value,
                'attr_value'=>$attr_values[$key]
            ];
        }
        //批量写入
        return $this->saveAll($list);
    }
 }