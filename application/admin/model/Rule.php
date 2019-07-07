<?php
namespace app\admin\model;
use think\Model;
use think\Db;
/**
 * 权限
 */
class Rule extends Model
{
    public function getRules($id=0){
        //先获取所有分类数据
        $rule =Db::name('rule')->select();
        return get_tree($rule,$id,0);
    }
}