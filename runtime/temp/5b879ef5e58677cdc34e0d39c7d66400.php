<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:90:"D:\phpStudy\PHPTutorial\WWW\php34\shop\public/../application/admin\view\goods\recycle.html";i:1560993360;s:88:"D:\phpStudy\PHPTutorial\WWW\php34\shop\public/../application/admin\view\public\base.html";i:1561305948;}*/ ?>
<!-- $Id: category_info.htm 16752 2009-10-20 09:59:38Z wangleisvn $ -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ECSHOP 管理中心 -  商品回收站 </title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__ADMIN__Styles/general.css" rel="stylesheet" type="text/css" />
<link href="__ADMIN__Styles/main.css" rel="stylesheet" type="text/css" />

<style>
  *{
    text-decoration: none;

  }
    #pag li{
        list-style: none;
        float:left;
        margin: 10px;
        padding: 0 8px;
        font-size: 15px;
        border: 1px solid skyblue;

    }
    #pag li:hover{
        background:skyblue;
        color:white;
    }
</style>

</head>
<body>
<h1>

    <span class="action-span"><a href="index.html">商品首页</a></span>
    <span class="action-span1"><a href="">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 商品列表 </span>
    <div style="clear:both"></div>

</h1>

    <div class="form-div">
    <form action="" name="searchForm">
        <img src="__ADMIN__Images/icon_search.gif" width="26" height="22" border="0" alt="search" />
        <!-- 分类 -->
        <select name="cate_id">
            <option value="0">所有分类</option>
            <?php if(is_array($category) || $category instanceof \think\Collection || $category instanceof \think\Paginator): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <option value="<?php echo $vo['id']; ?>" <?php if(\think\Request::instance()->get('cate_id') == $vo['id']): ?>selected='selected'<?php endif; ?>><?php echo str_repeat( '&nbsp;&nbsp;&nbsp;--',$vo['lev']); ?><?php echo $vo['cate_name']; ?></option>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </select>

        <!-- 推荐 -->
        <select name="intro_type">
            <option value="0">全部</option>
            <option value="is_rec">推荐</option>
            <option value="is_new">新品</option>
            <option value="is_hot">热销</option>
        </select>
        <!-- 上架 -->
        <select name="is_sale">
            <option value='0'>全部</option>
            <option value="1">上架</option>
            <option value="2">下架</option>
        </select>
        <!-- 关键字 -->
        关键字 <input type="text" name="keyword" size="15" />
        <input type="submit" value=" 搜索 " class="button" />
    </form>
    </div>

<!-- 商品列表 -->

    <div class="list-div" id="listDiv">
        <table cellpadding="3" cellspacing="1">
            <tr>
                <th>编号</th>
                <th>商品名称</th>
                <th>货号</th>
                <th>价格</th>
                <th>推荐</th>
                <th>新品</th>
                <th>热销</th>
                <th>操作</th>
            </tr>

            <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <tr>
                <td align="center"><?php echo $vo['id']; ?></td>
                <td align="center"><?php echo $vo['goods_name']; ?></td>
                <td align="center"><?php echo $vo['goods_sn']; ?></td>
                <td align="center"><?php echo $vo['shop_price']; ?></td>
                <td align="center"><img style="cursor: pointer;" onclick="changeStatus(<?php echo $vo['id']; ?>,'is_rec',this)" src="__ADMIN__Images/<?php if($vo['is_rec'] == '1'): ?>yes<?php else: ?>no<?php endif; ?>.gif "/></td>
                <td align="center"><img style="cursor: pointer;" onclick="changeStatus(<?php echo $vo['id']; ?>,'is_new',this)" src="__ADMIN__Images/<?php if($vo['is_new'] == '1'): ?>yes<?php else: ?>no<?php endif; ?>.gif "/></td>
                <td align="center"><img style="cursor: pointer;" onclick="changeStatus(<?php echo $vo['id']; ?>,'is_hot',this)" src="__ADMIN__Images/<?php if($vo['is_hot'] == '1'): ?>yes<?php else: ?>no<?php endif; ?>.gif "/></td>
                <td align="center">
                <a href="<?php echo url('rollback','id='.$vo['id']); ?>" title="还原">还原</a>
                <a href="<?php echo url('del','id='.$vo['id']); ?>" onclick="" title="彻底删除">彻底删除</a></td>
            </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>

        </table>

        <!-- 分页开始 -->
        <table id="page-table" cellspacing="0">
            <tr>
                <td width="80%">&nbsp;</td>
                <td align="center" nowrap="true" id="pag">
                    <?php echo $data->render(); ?>
                </td>
            </tr>
        </table>
    <!-- 分页结束 -->
    </div>

<div id="footer">
共执行 3 个查询，用时 0.162348 秒，Gzip 已禁用，内存占用 2.266 MB<br />
版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>

</body>
</html>
<script type="text/javascript" src="__ADMIN__/JS/jquery-1.8.3.min.js"></script>

<script type="text/javascript" src="__ADMIN__/JS/jquery-1.8.3.min.js"></script>

<script type="text/javascript">
    function changeStatus(goods_id,field,obj)
    {
        $.ajax({
            url:'<?php echo url("changeStatus"); ?>',
            type:'post',
            data:{goods_id:goods_id,field:field},
            dataType:'json',
            success:function(response){
                if(response.code == 0)
                {
                    alert(response.msg);
                    return false;
                }
                if(response.status == 1)
                {
                    //显示yes 图片
                    $(obj).attr('src','__ADMIN__/Images/yes.gif');
                }
                else{
                    $(obj).attr('src','__ADMIN__/Images/no.gif');
                }
            }
        })
    }
</script>
