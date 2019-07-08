<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:87:"D:\phpStudy\PHPTutorial\WWW\php34\shop\public/../application/admin\view\goods\edit.html";i:1561431622;s:88:"D:\phpStudy\PHPTutorial\WWW\php34\shop\public/../application/admin\view\public\base.html";i:1561305948;}*/ ?>
<!-- $Id: category_info.htm 16752 2009-10-20 09:59:38Z wangleisvn $ -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ECSHOP 管理中心 -  添加分类 </title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__ADMIN__Styles/general.css" rel="stylesheet" type="text/css" />
<link href="__ADMIN__Styles/main.css" rel="stylesheet" type="text/css" />

</head>
<body>
<h1>

    <span class="action-span"><a href="<?php echo url('index'); ?>">商品列表</a>
    </span>
    <span class="action-span1"><a href="">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 编辑商品信息 </span>
    <div style="clear:both"></div>

</h1>

<div class="tab-div">
    <div id="tabbar-div" style="padding-left:27%">
        <p>
            <span class="tab-front">通用信息</span>
            <span class="tab-front">商品描述</span>
            <span class="tab-front">商品属性</span>
            <span class="tab-front">上传相册</span>
        </p>
    </div>
    <div id="tabbody-div">
        <form enctype="multipart/form-data" action="" method="post">
            <?php echo token(); ?>
            <table width="90%" align="center" class="table">
                <tr>
                    <td class="label">商品名称：</td>
                    <td><input type="text" name="goods_name" value="<?php echo $goods_info['goods_name']; ?>"size="30" />
                    <span class="require-field">*</span></td>
                </tr>
                <tr>
                    <td class="label" >商品货号： </td>
                    <td>
                        <input type="text" disabled='disabled' name="goods_sn" value="<?php echo $goods_info['goods_sn']; ?>" size="20"/>
                        <span id="goods_sn_notice"></span><br />
                        <span class="notice-span"id="noticeGoodsSN">如果您不输入商品货号，系统将自动生成一个唯一的货号。</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">商品分类：</td>
                    <td>
                        <select name="cate_id">
                            <option value="">请选择...</option>
                            <?php if(is_array($category) || $category instanceof \think\Collection || $category instanceof \think\Paginator): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $vo['id']; ?>}" <?php if($vo['id'] == $goods_info['cate_id']): ?>selected="selected"<?php endif; ?> label="<?php echo str_repeat('&nbsp;&nbsp;&nbsp;',$vo['lev']); ?><?php echo $vo['cate_name']; ?>"><?php echo $vo['cate_name']; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                        <span class="require-field">*</span>
                    </td>
                </tr>

                <tr>
                    <td class="label">本店售价：</td>
                    <td>
                        <input type="text" name="shop_price" value="<?php echo $goods_info['shop_price']; ?>" size="20"/>
                        <span class="require-field">*</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">加入推荐：</td>
                    <td>
                        <input type="checkbox" name="is_hot" <?php if($goods_info['is_hot'] == '1'): ?>checked="checked"<?php endif; ?> value="1"/> 热卖 
                        <input type="checkbox" name="is_new" <?php if($goods_info['is_new'] == '1'): ?>checked="checked"<?php endif; ?> value="1"/> 新品 
                        <input type="checkbox" name="is_rec" <?php if($goods_info['is_rec'] == '1'): ?>checked="checked"<?php endif; ?> value="1"/> 新品 
                    </td>
                </tr>

                <tr>
                    <td class="label">市场售价：</td>
                    <td>
                        <input type="text" name="market_price" value="<?php echo $goods_info['market_price']; ?>" size="20" />
                    </td>
                </tr>

                <tr>
                    <td class="label">商品图片：</td>
                    <td>
                        <input type="file" name="goods_img" size="35" />
                        <img style="display: block;margin-top:5px" src="/<?php echo $goods_info['goods_thumb']; ?>" alt="">
                    </td>
                </tr>
            </table>

            <!-- 商品描述 -->
            <table width="90%" align="center" class="table" style="display:none">
                <tr>
                    <td class="label">商品描述：</td>
                    <td id="tab">
                        <!-- 加载编辑器的容量 -->
                        <script id="container" name="goods_body" type="text/plain"></script>
                        <!-- 配置文件 -->
                        <script type="text/javascript" src="__STATIC__/ueditor/ueditor.config.js"></script>
                        <!-- 编辑器源码文件 -->
                        <script type="text/javascript" src="__STATIC__/ueditor/ueditor.all.js"></script>
                        <!-- 实例化编辑器 -->
                        <script type="text/javascript">
                            var ue = UE.getEditor('container');
                        </script>
                    </td>
                </tr>
            </table>
            <!-- 商品属性 -->
            <table width="90%" class="table" align="center" style="display: none">
                    <tr>
                        <td class="label">商品类型：</td>
                        <td>
                           <select name="type_id" id="type_id">
                                <option value="0">选择类型</option>
                                <?php if(is_array($type) || $type instanceof \think\Collection || $type instanceof \think\Paginator): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <option value="<?php echo $vo['id']; ?>" <?php if($goods_info['type_id'] == $vo['id']): ?>selected="selected"<?php endif; ?>><?php echo $vo['type_name']; ?></option>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                           </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" id="showAttr">
                            <table width="90%" align="center">
                                <?php if(is_array($attrs) || $attrs instanceof \think\Collection || $attrs instanceof \think\Paginator): $i = 0; $__LIST__ = $attrs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <tr>
                                    <td class="label">
                                        <?php if($vo['attr_type'] == '2'): ?>
                                            <a href="javascript:;" onclick="cloneThis(this)">[+]</a>
                                        <?php endif; ?>
                                        <?php echo $vo['attr_name']; ?>：</td>
                                    <td>
                                        <!-- 隐藏域保存属性ID -->
                                        <input type="hidden" name="attr_ids[]" value=<?php echo $vo['attr_id']; ?>>
                                        <?php if($vo['attr_input_type'] == '1'): ?>
                                        <input type="text" name="attr_values[]" value="<?php echo $vo['attr_value']; ?>">
                                        <?php else: ?>
                                        <select name="attr_values[]">
                                            <!-- $attrs 里面还嵌套着一层$attr_values 数组 保存着属性值 -->
                                            <?php if(is_array($vo['attr_values']) || $vo['attr_values'] instanceof \think\Collection || $vo['attr_values'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['attr_values'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                                            <option <?php if($vo['attr_value'] == $v): ?>selected="selected"<?php endif; ?>><?php echo $v; ?></option>
                                            <?php endforeach; endif; else: echo "" ;endif; ?>
                                        </select>
                                        <?php endif; ?>
                                        
                                    </td>
                                </tr>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </table>
                        </td>
                    </tr>
                </table>
                <!-- 商品相册 -->
                <table width="90%" class="table" align="center" style="display: none">
                        <tr>
                            <td class="label">多上传</td>
                            <td>
                                <input class="button" type="button" value="增加文本框" id="addBtn">
                            </td>
                        </tr>
                        <tr>
                            <td class="label">上传相册:</td>
                            <td>
                                <input type="file" name="imgs[]" >
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

<script src="__ADMIN__JS/jquery-1.8.3.min.js"></script>
<!-- 实现点击切换商品信息和商品描述 -->
<script>
    //隐藏所有选项卡
    $('#tabbar-div span').click(function(){
        //将当前点击的table显示
        $('.table').hide();
        // 获取当前点击的span的序号
        var index = $(this).index();
        $('.table').eq(index).show();
    });

    //类型切换事件
    $('#type_id').change(function(){
        //获取所需要的参数
        var type_id = $(this).val();
        if(type_id === '0'){
            $('#showAttr').html('选择类型');
            return false;
        }
        $.ajax({
            url:"<?php echo url('showAttr'); ?>",
            type:'post',
            data:{type_id:type_id},
            success:function(response){
                $('#showAttr').html(response);
            }
        })
    });
    function cloneThis(obj){
        if($(obj).html()=='[+]'){
            //复制新的tr标签 结果为对象
            var newTr = $(obj).parent().parent().clone();
            //将新的标签a标签的符号修改为[-]
            newTr.find('a').html('[-]');
            //将新的tr加入到html中
            $(obj).parent().parent().after(newTr);
        }else{
            //删去一个
            $(obj).parent().parent().remove();
        }
    }
    
    $('#addBtn').click(function(){
        var newTr = $(this).parent().parent().next().clone();
        $(this).parent().parent().parent().append(newTr);
    })
</script>
