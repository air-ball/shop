<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:87:"D:\phpStudy\PHPTutorial\WWW\php34\shop\public/../application/admin\view\role\index.html";i:1561337228;s:88:"D:\phpStudy\PHPTutorial\WWW\php34\shop\public/../application/admin\view\public\base.html";i:1561305948;}*/ ?>
<!-- $Id: category_info.htm 16752 2009-10-20 09:59:38Z wangleisvn $ -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ECSHOP 管理中心 - 所有角色</title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__ADMIN__Styles/general.css" rel="stylesheet" type="text/css" />
<link href="__ADMIN__Styles/main.css" rel="stylesheet" type="text/css" />

</head>
<body>
<h1>

    <span class="action-span"><a href="/index.php/admin/role/add.html">添加角色</a></span>
    <span class="action-span1"><a href="__GROUP__">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 角色分类 </span>
    <div style="clear:both"></div>

</h1>

<form method="post" action="" name="listForm">
    <div class="list-div" id="listDiv">
        <table width="100%" cellspacing="1" cellpadding="2" id="list-table">
            <tr>
                <th>ID</th>
                <th>角色名称</th>
                <th>操作</th>
            </tr>
            <?php if(is_array($role_info) || $role_info instanceof \think\Collection || $role_info instanceof \think\Paginator): $i = 0; $__LIST__ = $role_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <tr align="center" class="0">
                <td align="left" class="first-cell" >
                    <?php echo $vo['id']; ?>
                </td>
                <td align="left" class="first-cell" >
                    <?php echo $vo['role_name']; ?>
                </td>
                <td width="30%" align="center">
                    <?php if($vo['id'] > '1'): ?>
                    <a href="<?php echo url('disfetch','id='.$vo['id']); ?>">分配权限</a> |
                    <a href="<?php echo url('edit','id='.$vo['id']); ?>">编辑</a> |
                    <a href="<?php echo url('remove','id='.$vo['id']); ?>" title="移除" onclick="">移除</a>
                    <?php endif; ?>
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