<?php
namespace app\admin\model;
use think\Model;
use think\Db;
use think\Cache;
/**
* 分类的模型 
*/
class Type extends Model{
    //查询列表数据
    public function getList()
    {
        //读取缓存内容
        $type_info = Cache('type_info');
        if(!$type_info)
        {
            //缓存中没有数据  先去数据库取出数据
            $type_info = $this->paginate(30);
            //将数据放入缓存中
            Cache('type_info',$type_info,3600*24);
        }
        return $type_info;
    }

    public function editType($data)
    {   
        //修改数据
        $this->isUpdate(true)->allowField(true)->save($data);
        //更新缓存，删除缓存读取数据时会触发数据操作    
        cache('type_info',null);
    }
}