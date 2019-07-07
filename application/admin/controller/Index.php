<?php
namespace app\admin\controller;
use think\Db;
/*
后台首页控制器
*/
class Index extends Common
{   
    //后台首页的方法
    public function index()
    {
        // $query = Db::name('user');
        return $this->fetch();
    }
    public function menu()
    {   
        //赋值菜单数据
        $this->assign('menus',$this->_user['menus']);
        return $this->fetch();
    }
    public function main()
    {
        return $this->fetch();
    }
    public function top()
    {
        return $this->fetch();
    }
}

?>