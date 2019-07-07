<?php
namespace app\admin\validate;
use think\validate;
/**
* 商品类型添加 验证器
*/

class Type extends Validate
{
    //验证规则
    protected $rule = [
        'type_name|类型名称'=>'require|unique:type',
    ];
}

?>