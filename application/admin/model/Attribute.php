<?php
namespace app\admin\model;
use think\Model;
use think\Db;
/**
*   商品属性模型 
*/
class Attribute extends Model{
    //根据type_id获取属性信息
    public function getAttrByTypeId($type_id)
    {
        $data = $this->all(['type_id'=>$type_id]);
        // 保存最终结果
        $list = [];
        foreach($data as $value)
        {
            $value = $value->toArray();
            if($value['attr_input_type'] == 2){
                //select列表选择
                $value['attr_values'] = explode(',',$value['attr_values']);
            }
            $list[] = $value;
        }
        return $list;
    }
    //编辑表单提交
    public function editAttr($data)
    {
        //判断select 选择时是否存在默认值
        if($data['attr_input_type'] ==2 && !$data['attr_values'])
        {
            $this->error='默认值需要设置';
            return false;
        }
        return $this->isUpdate(true)->allowField(true)->save($data);
    }
    //属性删除
    public function remove($attr_id)
    {
        return $this->where('id',$attr_id)->delete();
    }
    //所有属性列表
    public function getList()
    {
        return Db::name('attribute')->alias('a')
            ->join('shop_type b','a.type_id = b.id','left')
            ->field('a.*,b.type_name')->paginate(10);
    }
    //属性添加
    public function addAttr($data)
    {
        //判断select 选择时是否存在默认值
        if($data['attr_input_type'] ==2 && !$data['attr_values'])
        {
            $this->error='默认值需要设置';
            return false;
        }
        cache('type_info',null);
        return $this->isUpdate(false)->allowField(true)->save($data);
    }
}