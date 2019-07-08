<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:86:"D:\phpStudy\PHPTutorial\WWW\php34\shop\public/../application/admin\view\rule\edit.html";i:1561336962;s:88:"D:\phpStudy\PHPTutorial\WWW\php34\shop\public/../application/admin\view\public\base.html";i:1561305948;}*/ ?>
<!-- $Id: category_info.htm 16752 2009-10-20 09:59:38Z wangleisvn $ -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ECSHOP 管理中心 - 编辑权限</title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__ADMIN__Styles/general.css" rel="stylesheet" type="text/css" />
<link href="__ADMIN__Styles/main.css" rel="stylesheet" type="text/css" />

</head>
<body>
<h1>

<h1>
    <span class="action-span"><a href="<?php echo url('index'); ?>">权限列表</a></span>
    <span class="action-span1"><a href="">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 编辑权限 </span>
    <div style="clear:both"></div>
</h1>

</h1>

<div class="main-div">
    <form action="" method="post" name="theForm" enctype="multipart/form-data">
        <table width="100%" id="general-table">
            <tr>
                <td class="label">权限名称:</td>
                <td>
                    <input type='text' name='rule_name' maxlength="20" value="<?php echo $rule_info['rule_name']; ?>" size='27' /><font color="red">*</font>
                </td>
            </tr>
            <tr>
                <td class="label">控制器名:</td>
                <td>
                    <input type='text' name='controller_name' maxlength="20" value="<?php echo $rule_info['controller_name']; ?>" size='27' /><font color="red">*</font>
                </td>
            </tr>
            <tr>
                <td class="label">方法名:</td>
                <td>
                    <input type='text' name='action_name' maxlength="20" value="<?php echo $rule_info['action_name']; ?>" size='27' /><font color="red">*</font>
                </td>
            </tr>
            <tr>
                <td class="label">上级权限:</td>
                <td>
                    <select name="parent_id">
                        <option label="顶级分类" value="0"></option>
                        <?php if(is_array($rules) || $rules instanceof \think\Collection || $rules instanceof \think\Paginator): $i = 0; $__LIST__ = $rules;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo $vo['id']; ?>" <?php if($rule_info['parent_id'] == $vo['id']): ?> selected ="selected"<?php endif; if(in_array(($vo['id']), explode(',',""))): ?> disabled<?php endif; if($vo['parent_id'] == $rule_info['id']): ?> disabled<?php endif; if($vo['id'] == $rule_info['id']): ?>disabled<?php endif; ?>
                            > 
                            <?php echo str_repeat('&nbsp;&nbsp;--',$vo['lev']); ?><?php echo $vo['rule_name']; ?>
                        </option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </td>
            </tr>


            <tr>
                <td class="label">是否显示:</td>
                <td>
                    <input type="radio" name="is_show" value="1" <?php if($rule_info['is_show'] == '1'): ?>checked="checked"<?php endif; ?> /> 是
                    <input type="radio" name="is_show" value="0"  <?php if($rule_info['is_show'] == '0'): ?>checked="checked"<?php endif; ?> /> 否
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
