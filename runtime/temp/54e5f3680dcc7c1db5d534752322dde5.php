<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:90:"D:\phpStudy\PHPTutorial\WWW\php34\shop\public/../application/admin\view\role\disfetch.html";i:1561357790;s:88:"D:\phpStudy\PHPTutorial\WWW\php34\shop\public/../application/admin\view\public\base.html";i:1561305948;}*/ ?>
<!-- $Id: category_info.htm 16752 2009-10-20 09:59:38Z wangleisvn $ -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ECSHOP 管理中心 - 分配权限</title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__ADMIN__Styles/general.css" rel="stylesheet" type="text/css" />
<link href="__ADMIN__Styles/main.css" rel="stylesheet" type="text/css" />

</head>
<body>
<h1>

    <span class="action-span"><a href="<?php echo url('add'); ?>">添加角色</a></span>
    <span class="action-span1"><a href="__GROUP__">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 分配权限 </span>
    <div style="clear:both"></div>

</h1>

<form method="post" action="" name="listForm">
    <div class="list-div" id="listDiv">
        <table width="100%" cellspacing="1" cellpadding="2" id="list-table">
            <tr>
                <th>顶级权限</th>
                <th>子权限</th>
            </tr>
            <?php if(is_array($rule_info) || $rule_info instanceof \think\Collection || $rule_info instanceof \think\Paginator): $i = 0; $__LIST__ = $rule_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <tr align="center" class="0">
                <td align="left" class="first-cell" >
                    <?php if($vo['parent_id'] == '0'): ?>
                    <input type="checkbox" name="role_ids[]" value="<?php echo $vo['id']; ?>" <?php if(in_array(($vo['id']), is_array($hasRules)?$hasRules:explode(',',$hasRules))): ?>checked="checked<?php endif; ?>">
                    <?php echo $vo['rule_name']; endif; ?>
                </td>
                <td align="left" class="first-cell" >
                    <?php if(is_array($rule_info) || $rule_info instanceof \think\Collection || $rule_info instanceof \think\Paginator): $i = 0; $__LIST__ = $rule_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;if($v['parent_id'] == $vo['id']): ?>
                    <input type="checkbox" name="role_ids[]" value="<?php echo $v['id']; ?>"  <?php if(in_array(($vo['id']), is_array($hasRules)?$hasRules:explode(',',$hasRules))): ?>checked="checked<?php endif; ?>" ><?php echo $v['rule_name']; ?>&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                </td>
            </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
                <td colspan="3" align="center" class="first-cell"><input type="submit" ></td>
        </table>
    </div>
</form>

<div id="footer">
共执行 3 个查询，用时 0.162348 秒，Gzip 已禁用，内存占用 2.266 MB<br />
版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>

</body>
</html>
<script type="text/javascript" src="__ADMIN__/JS/jquery-1.8.3.min.js"></script>
