<?php
namespace app\admin\model;
use think\Model;
use think\Db;
//分类的模型
class Category extends Model{
    // public function getQueryObj($name = '')
    // {
    //     if($name){
    //         return Db::name($name);
    //     }
    //     return Db::name($this->name);
    // }
    //获取所有分类数据
    public function getCateTree($id=0,$is_clear=false)
    {
        //先获取所有分类数据
        $category =Db::name('category')->select();
        return get_tree($category,$id,0,$is_clear);
    }

    ////////////分类选择禁用项专用数据////////////// 
    public function getCateTree2($id=0)
    {
        //先获取所有分类数据
        $category =Db::name('category')->select();
        return get_me_son($category,$id);
    }


    //删除数据
    public function remove($cate_id)
    {
        //保存最终要删除的数据的id，初始指定被删除的id
        $where = [$cate_id];
        //查找分类下的所有子分类
        $son = $this->getCateTree($cate_id);
        if($son){
            foreach($son as $value)
            {
                //向$where变量增加一个元素记录要删除数据的id
                $where[] =$value['id'];
            }
        }
        // dump($where);die;
        //删除数据
        $this->destroy($where);
    }

    //处理提交的修改数据
    public function saveData($data)
    {
        /***************  第二种限制父分类方法   有瑕疵，可以设置其他顶级分类为该顶级分类的子分类  ***********/

        // //修改数据不能设置自己为自己的上级分类
        // if($data['id']==$data['parent_id']){
        //     $this->error = '不能设置自己为自己的父分类';
        //     return false;
        // }

        // //判断当前修改的分类的父分类不能是自己已有的任何一个子分类
        // // 获取当前分类具备的自己分类
        // $son = $this ->getCateTree($data['id']);
        // //判断
        // foreach($son as $value)
        // {
        //     if($data['parent_id']==$value['id']){
        //         $this->error = '子孙错乱';
        //         return false;
        //     }
        // }

        /****************************************  END  ****************************************************/
        //$data中的存在的逐渐可以直接作为条件修改
        return $this->allowField(true)->isUpdate(true)->save($data);
    }
}