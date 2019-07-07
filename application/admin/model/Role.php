<?php
namespace app\admin\model;
use think\Model;
use think\Db;

class Role extends Model{
    //添加角色
    public function addRole($data){
        return $this->isUpdate(false)->allowField(true)->save($data);
    }
    //获取所有角色
    public function getList(){
        return $role_info = model('Role')->select();
    }

}