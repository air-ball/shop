<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:90:"D:\phpStudy\PHPTutorial\WWW\php34\shop\public/../application/admin\view\attribute\add.html";i:1561034705;s:88:"D:\phpStudy\PHPTutorial\WWW\php34\shop\public/../application/admin\view\public\base.html";i:1561305948;}*/ ?>
<!-- $Id: category_info.htm 16752 2009-10-20 09:59:38Z wangleisvn $ -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ECSHOP 管理中心 - 添加属性</title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__ADMIN__Styles/general.css" rel="stylesheet" type="text/css" />
<link href="__ADMIN__Styles/main.css" rel="stylesheet" type="text/css" />

</head>
<body>
<h1>

    <span class="action-span"><a href="index.html">属性列表</a>
    </span>
    <span class="action-span1"><a href="">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 添加属性 </span>
    <div style="clear:both"></div>

</h1>

<div class="tab-div">
    <div id="tabbody-div">
        <form enctype="multipart/form-data" action="" method="post">
            <?php echo token(); ?>
            <table width="90%" align="center" class="table">
                <tr>
                    <td class="label">属性名称：</td>
                    <td><input type="text" name="attr_name" value="" size="30" />
                    <span class="require-field">*</span></td>
                </tr>
                <tr>
                    <td class="label">所属类型：</td>
                    <td>
                        <select name="type_id">
                            <option value="0">请选择...</option>
                            <?php if(is_array($type) || $type instanceof \think\Collection || $type instanceof \think\Paginator): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $vo['id']; ?>}" label="<?php echo $vo['type_name']; ?>"></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                        <span class="require-field">*</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">属性类型：</td>
                    <td>
                        <input type="radio" name="attr_type" value="1" checked="checked" /> 唯一属性
                        <input type="radio" name="attr_type" value="2"/> 单选属性
                    </td>
                </tr>
                <tr>
                    <td class="label">属性录入方式：</td>
                    <td>
                        <input type="radio" name="attr_input_type" value="1" checked="checked" /> input输入
                        <input type="radio" name="attr_input_type" value="2"/> select选择
                    </td>
                </tr>
                <tr>
                    <td class="label">默认值:</td>
                    <td>
                        <textarea name="attr_values" id="" cols="30" rows="10"></textarea>
                    </td>
                </tr>
            </table>
            <div class="button-div">
                <input type="submit" value=" 确定 " class="button"/>
                <input type="reset" value=" 重置 " class="button" />
            </div>
        </form>
    </div>
</div>

<div id="footer">
共执行 3 个查询，用时 0.162348 秒，Gzip 已禁用，内存占用 2.266 MB<br />
版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>

</body>
</html>
<script type="text/javascript" src="__ADMIN__/JS/jquery-1.8.3.min.js"></script>
