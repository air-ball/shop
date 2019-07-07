<?php
namespace app\admin\controller;
use think\Request;
use think\Db;
/**
* 商品控制器 
*/

class Goods extends Common
{
    //缓存更新
    public function flush()
    {
        return $this->clearCache();
    }
    //ajax 获取类型下的属性
    public function showAttr()
    {
        //接受类型
        $type_id = input('type_id');
        //根据类型ID获取类型下的属性
        $attrs = model('Attribute')->getAttrByTypeId($type_id);
        $this->assign('attrs',$attrs);
        return $this->fetch();
    }
    //回收站商品列表显示
    public function recycle()
    {
        // //获取所有分类数据
        $category = model('Category')->getCateTree();
        $this->assign('category',$category);
        //调用自定义模型方法获取所有数据
        $data = model('Goods')->goodsList(1);
        $this->assign('data',$data);
        return $this->fetch();
    }
    //彻底删除
    public function del()
    {
        //获得要删除的商品ID
        $goods_id = input('id/d');
        model('Goods')->del($goods_id);
        $this->success('ok');
    }
    //商品还原（从回收站还原）
    public function rollback()
    {
        $goods_id = input('id/d');     //获取要放入回收站的商品ID
        // setField 方法为query类下的方法，用于修改指定字段的值
        // 第一个参数是字段名称，第二个字段是修改的内容
        Db::name('goods')->where('id',$goods_id)->setField('is_del',0);
        $this->success('ok','index');
    }
    //商品伪删除（放入回收站）
    public function remove()
    {
        $goods_id = input('id/d');     //获取要放入回收站的商品ID
        // setField 方法为query类下的方法，用于修改指定字段的值
        // 第一个参数是字段名称，第二个字段是修改的内容
        Db::name('goods')->where('id',$goods_id)->setField('is_del',1);
        $this->success('ok','index');
    }
    //商品信息编辑
    public function edit(Request $request)
    {
        $model = model('Goods');
        if($request->isGet())
        {
            //查询该商品原有数据
            $goods_info = $model ->get(input('id'));
            //查询所有分类信息
            $category = model('Category')->getCateTree();
            //获取所有的类型
            $type = model('Type')->getList();
            //获取商品下的所有属性值信息
            $attrs = model('GoodsAttr')->getAttrByGoodsId(input('id/d'));
            // dump($attrs);die;
            return $this->fetch('edit',['goods_info'=>$goods_info,'category'=>$category,'type'=>$type,'attrs'=>$attrs]);
        }
        
        /************处理提交表单************/
        //接受参数
        $post_data = input();

        //验证器检查信息
        $res = $this->validate($post_data,'Goods');
        if($res !==true)
        {
            $this->error($res);
        }
        //文件上传图片处理  第二个参数为布尔值   控制是否必须上传图片
        $this->upload($post_data,false);

        // 调用自定义的模型方法完成入库
        $goods_model = model('Goods');
        $res = $goods_model ->editGoods($post_data);
        // 完成商品相册入库
        model('GoodsImg')->addAll(input('id'));
        if($res ===  false)
        {
            $this->error($goods_model->getError());
        }
        $this->success('OK','index');

    }
    //ajax同步更新商品状态切换
    public function changeStatus()
    {
        $model = model('Goods');
        //调用自定义方法完成状态切换    field 是ajax请求的参数，为所点击的字段名 如 ：is_new is_hot
        //$res 正常返回 0 或者 1 (修改后数据库的结果，0否，1是)，不正常返回false 
        $res = $model ->changeStatus(input('goods_id'),input('field'));
        if($res === false)
        {
            echo json_ecode(['code'=>1,$model->getError()]);exit;
        }
        echo json_encode(['code'=>1,'msg'=>'ok','status'=>$res]);
    }
    //商品列表显示
    public function index()
    {
        //获取所有分类数据
        $category = model('Category')->getCateTree();
        $this->assign('category',$category);
        //调用自定义的模型方法获取所有的数据
        $data = model('Goods')->goodsList();
        $this->assign('data',$data);
        return $this->fetch();
    }
    //商品添加
    public function add(Request $reqeust)
    {
        if($reqeust->isGet())
        {
            //获取商品类型数据
            $type = model('Type')->getList();
            $this->assign('type',$type);
            //查询分类数据
            $category = model('Category') ->getCateTree();
            $this->assign('category',$category);
            //（渲染模板）显示添加商品表单
            return $this->fetch();
        }
        //接受POST表单参数
        $post_data = input();
        //货号检查
        $this->checkGoodsSn($post_data);

        //验证规则  param1  数据    param  模块/validate下的 验证规则
        $res = $this->validate($post_data,'Goods');
        if($res !== true)
        {
            $this->error($res);
        }
                     
        // //文件上传图片处理
        $ss = $this->upload($post_data);
        
        //调用自定义模型方法完成入库
        $goods_model = model('Goods');
        $res = $goods_model->addGoods($post_data);
        // dump($res);die;
        if($res === false)
        {
            $this->error($goods_model->getError());
        }

        $this->success('ok','index');

    }
    
    //图片处理
    protected function upload(&$post_data,$is_must=true)
    {
        //文件上传  goods_img   表单文件域的name
        $file = request()->file('goods_img');
        if(!$file)
        {
            if($is_must){
                //没有上传图片，代码中止
                $this->error('图片必须上传');
            }else{
                //可以不上传图片，返回true   继续执行下面的代码
                return true;
            }
        }
        //文件上传  移动图片到域名根目录的uploads下
        $info = $file->validate(['ext'=>'jpg,png'])->move('uploads');
        if(!$info){
            $this->error($file->getError());
        }
        
        // 获取上传后的地址
        $goods_img = 'uploads/'.$info->getSaveName();
        // 更换地址中的 \为/  linux系统
        $goods_img = str_replace('\\','/',$goods_img);
        // 打开图片
        $img = \think\Image::open($goods_img);
        // 缩略图的保存地址
        $goods_thumb = 'uploads/'.date('Ymd').'/thumb_'.$info->getFileName();
        // 生成缩略图
        $img ->thumb(150,150)->save($goods_thumb);

        //保存到表单提交，存入数据库
        $post_data['goods_img'] = $goods_img;
        $post_data['goods_thumb'] = $goods_thumb;

    }
    //货号检查
    protected function checkGoodsSn(&$post_data)
    {
        //判断是否提交 提交货号检查唯一否则生成唯一
        if($post_data['goods_sn'])
        {
            if(model('Goods')->get(['goods_sn'=>$post_data['goods_sn']]))
                $this->error('货号已存在');
            else
                //生成唯一
                $post_data['goods_sn'] = strtoupper('SHOP'.uniqid());
            
        }
        else
            //生成唯一
            $post_data['goods_sn'] = strtoupper('SHOP'.uniqid());
    }

}