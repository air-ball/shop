<?php
namespace app\admin\validate;
use think\Validate;
/**
*   添加商品  验证规则
*/

class Goods extends Validate
{
        //验证规则
        protected $rule = [
            'goods_name|商品名称'=>'require|token',
            'cate_id|分类'=>'require|gt:0',
            'shop_price|本店售价'=>'require|gt:0',
            'market_price|市场售价'=>'require|checkPrice'
        ];
        
        public function checkPrice($value,$rule,$data)
        {
            if($value < $data['shop_price'])
            {
                return false;
            }
            return true;
        }

}