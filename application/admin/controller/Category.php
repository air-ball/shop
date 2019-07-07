<?php
namespace app\admin\controller;
use think\Request;
use think\Db;
/**
*分类控制器
**/
class Category extends Common
{
    //缓存更新
    public function flush()
    {
        return $this->clearCache();
    }
    //编辑方法
    public function edit(Request $request)
    {
        $category_model = model('Category');
        if($request->isGet()){
            //获取当前分类的信息
            $info = $category_model->get(input('id'));  //通过获取请求信息的  input 方法获取get中的id
            //获取所有分类数据
            $category = $category_model->getCateTree();
            //赋值模板
            $this->assign(['info'=>$info,'category'=>$category]);
            
            $me_and_son = $category_model->getCateTree2($info['id']);
            $me_and_son[] = $info['id'];
            // halt($me_and_son);
            $this->assign('me_and_son',$me_and_son);
            return $this->fetch();
        }


        //POST 表单提交   调用自定义的模型方法修改数据
        $result = $category_model->saveData(input());
        if($result ===false){
            //error方法
            $this->error($category_model->getError());
        }
        //修改成功提示
        $this->success('修改成功','index');
    }
    //删除分类方法
    public function remove()
    {
        //调用自定义模型方法删除
        model('Category')->remove(input('id/d'));
        $this->success('删除完成','index');
    }
    //分类列表
    public function index()
    {
        //使用模型对象调用自定义方法获取所需要的数据
        $category = model('Category')->getCateTree();
        // dump($category);
        $this->assign('category',$category);
        return $this->fetch();
    }
    //分类的添加
    public function add(Request $request)
    {
        //获取模型对象
        $category_model = model('Category');

        //如果请求方式为get，渲染模板（显示页面）
        if($request->isGet())
        {
            //model 方法
            $category = $category_model ->getCateTree();

            /***********************DB query方法 ********************/
            //查看所有的分类数据    (name 后天填写数据表名，不用写前缀)
            // $category = Db::name('category')->select();
            //初始化数据    分级
            // $category = get_tree($category);
            /***********************DB query方法 ********************/

            //将数据分配给模板
            $this->assign('category',$category);
            return $this ->fetch();
        }
        $data = request()->post();
        
        // 否则为POST 则处理表单提交数据
        Db::name('category')->insert($request->post());
        $this->success('添加分类成功','add');
    }
}