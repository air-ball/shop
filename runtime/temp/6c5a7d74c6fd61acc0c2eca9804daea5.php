<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:90:"D:\phpStudy\PHPTutorial\WWW\php34\shop\public/../application/admin\view\category\edit.html";i:1560955490;s:88:"D:\phpStudy\PHPTutorial\WWW\php34\shop\public/../application/admin\view\public\base.html";i:1561305948;}*/ ?>
<!-- $Id: category_info.htm 16752 2009-10-20 09:59:38Z wangleisvn $ -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ECSHOP 管理中心 - 编辑分类</title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__ADMIN__Styles/general.css" rel="stylesheet" type="text/css" />
<link href="__ADMIN__Styles/main.css" rel="stylesheet" type="text/css" />

</head>
<body>
<h1>

<h1>
    <span class="action-span"><a href="<?php echo url('goods/index'); ?>">商品分类</a></span>
    <span class="action-span1"><a href="">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 编辑分类 </span>
    <div style="clear:both"></div>
</h1>

</h1>

<div class="main-div">
    <form action="" method="post" name="theForm" enctype="multipart/form-data">
        <table width="100%" id="general-table">
            <tr>
                <td class="label">分类名称:</td>
                <td>
                    <input type='text' name='cate_name' maxlength="20" value="<?php echo $info['cate_name']; ?>" size='27' /><font color="red">*</font>
                </td>
            </tr>
            <tr>
                <td class="label">上级分类:</td>
                <td>
                    <select name="parent_id">
                        <option label="顶级分类" value="0"></option>
                        <!-- <?php if($info['parent_id'] == '0'): ?><option label="已是顶级分类了" value="0"></option><?php endif; ?> -->
                        <?php if(is_array($category) || $category instanceof \think\Collection || $category instanceof \think\Paginator): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo $vo['id']; ?>" <?php if($info['parent_id'] == $vo['id']): ?> selected ="selected"<?php endif; if($info['id'] == $vo['id']): ?> disabled<?php endif; if(in_array(($vo['id']), is_array($me_and_son)?$me_and_son:explode(',',$me_and_son))): ?> disabled<?php endif; ?>  > 
                            <!-- 
                                上面部分 
                                    1、如果选中的  id  等于 下拉选项中的 id  则设置为禁选状态   不能将自身设为自身的父元素
                                    2、如果选中的等级 $info.lev  小于或者等于选项中的分层等级lev  则不能将该选项选为父级
                            -->

                            <?php echo str_repeat('&nbsp;&nbsp;&nbsp;',$vo['lev']); ?>---<?php echo $vo['cate_name']; ?>
                        </option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </td>
            </tr>


            <tr>
                <td class="label">是否推荐:</td>
                <td>
                    <input type="radio" name="isrec" value="1"  checked="true"/> 是 
                    <input type="radio" name="isrec" value="0"  /> 否
                </td>
            </tr>

        </table>
        <div class="button-div">
            <input type="submit" value=" 确定 " />
            <input type="reset" value=" 重置 " />
        </div>
    </form>
</div>

<div id="footer">
共执行 3 个查询，用时 0.162348 秒，Gzip 已禁用，内存占用 2.266 MB<br />
版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>

</body>
</html>
<script type="text/javascript" src="__ADMIN__/JS/jquery-1.8.3.min.js"></script>
