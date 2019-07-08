<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:87:"D:\phpStudy\PHPTutorial\WWW\php34\shop\public/../application/admin\view\type\index.html";i:1561029911;s:88:"D:\phpStudy\PHPTutorial\WWW\php34\shop\public/../application/admin\view\public\base.html";i:1561305948;}*/ ?>
<!-- $Id: category_info.htm 16752 2009-10-20 09:59:38Z wangleisvn $ -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ECSHOP 管理中心 - 所有类型</title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__ADMIN__Styles/general.css" rel="stylesheet" type="text/css" />
<link href="__ADMIN__Styles/main.css" rel="stylesheet" type="text/css" />

</head>
<body>
<h1>

    <span class="action-span"><a href="/index.php/admin/type/add.html">添加类型</a></span>
    <span class="action-span1"><a href="__GROUP__">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 商品分类 </span>
    <div style="clear:both"></div>

</h1>

<form method="post" action="" name="listForm">
    <div class="list-div" id="listDiv">
        <table width="100%" cellspacing="1" cellpadding="2" id="list-table">
            <tr>
                <th>类型名称</th>
                <th>操作</th>
            </tr>
            <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <tr align="center" class="0">
                <td align="left" class="first-cell" style="font-size: 16px">
                    <?php echo $vo['type_name']; ?>
                </td>
                <td width="30%" align="center">
                <a href="<?php echo url('edit','id='.$vo['id']); ?>">编辑</a> |
                <a href="<?php echo url('remove','id='.$vo['id']); ?>" title="移除" onclick="">移除</a>
                </td>
            </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            
        </table>
    </div>
</form>

<div id="footer">
共执行 3 个查询，用时 0.162348 秒，Gzip 已禁用，内存占用 2.266 MB<br />
版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>

</body>
</html>
<script type="text/javascript" src="__ADMIN__/JS/jquery-1.8.3.min.js"></script>
