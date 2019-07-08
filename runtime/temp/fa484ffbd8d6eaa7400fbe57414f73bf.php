<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:86:"D:\phpStudy\PHPTutorial\WWW\php34\shop\public/../application/index\view\pay\check.html";i:1561813774;s:87:"D:\phpStudy\PHPTutorial\WWW\php34\shop\public/../application/index\view\public\nav.html";i:1561789868;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>填写核对订单信息</title>
	<link rel="stylesheet" href="__HOME__style/base.css" type="text/css">
	<link rel="stylesheet" href="__HOME__style/global.css" type="text/css">
	<link rel="stylesheet" href="__HOME__style/header.css" type="text/css">
	<link rel="stylesheet" href="__HOME__style/fillin.css" type="text/css">
	<link rel="stylesheet" href="__HOME__style/footer.css" type="text/css">

	<script type="text/javascript" src="__HOME__js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="__HOME__js/cart2.js"></script>
	<style>
	body, div, dl, dt, dd, ul, ol, li, h1, h2, h3, h4, h5, h6, pre, form, fieldset, input, textarea, p, blockquote, th, td{
		margin:1px;
	}
	.address label{
		width:80px;
	}
	.btn{
		width:100px;
		height: 40px;
		border-radius: 10px;
		background: #e33d3f;
		margin: 5px 10px;
		cursor: pointer;
	}
	</style>
</head>
<body>
	<!-- 顶部导航 start -->
		<!-- 顶部导航 start -->
	<div class="topnav">
            <div class="topnav_bd w1210 bc">
                <div class="topnav_left">
                    
                </div>
                <div class="topnav_right fr">
                    <ul>
                        <?php if(empty(\think\Session::get('user_info')) || ((\think\Session::get('user_info') instanceof \think\Collection || \think\Session::get('user_info') instanceof \think\Paginator ) && \think\Session::get('user_info')->isEmpty())): ?>
                        <li>您好，欢迎来到京西！[<a href="<?php echo url('user/login'); ?>">登录</a>] [<a href="<?php echo url('user/regist'); ?>">免费注册</a>] </li>
                        <?php else: ?>
                        <li>♔<?php echo \think\Session::get('user_info.username'); ?>　欢迎您! | <a href="<?php echo url('user/logout'); ?>">退出登录</a> </li>
                        <?php endif; ?>
                        <li class="line">|</li>
                        <li>我的订单</li>
                        <li class="line">|</li>
                        <li>客户服务</li>
    
                    </ul>
                </div>
            </div>
        </div>
    <!-- 顶部导航 end -->
        
	<!-- 顶部导航 end -->
	
	<div style="clear:both;"></div>
	
	<!-- 页面头部 start -->
	<div class="header w990 bc mt15">
		<div class="logo w990">
			<h2 class="fl"><a href="<?php echo url('index/index'); ?>"><img src="__HOME__images/logo.png" alt="京西商城"></a></h2>
			<div class="flow fr flow2">
				<ul>
					<li>1.我的购物车</li>
					<li class="cur">2.填写核对订单信息</li>
					<li>3.成功提交订单</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- 页面头部 end -->
	
	<div style="clear:both;"></div>

	<!-- 主体部分 start -->
	<form action="<?php echo url('pay'); ?>" name="address_form" method="POST">
		<input type="hidden" name="total" value="<?php echo $total; ?>">
		<div class="fillin w990 bc mt15">
			<div class="fillin_hd">
				<h2>填写并核对订单信息</h2>
			</div>

			<div class="fillin_bd">
				<!-- 收货人信息  start-->
				<div class="address">
					<h3>收货人信息</h3>
					<div class="address_select">
						<ul>
							<li>
								<label for=""><span>*</span>收 货 人：</label>
								<input type="text" name="people" class="txt" />
							</li>
							<li>
								<label for=""><span>*</span>详细地址：</label>
								<input type="text" name="address" class="txt address"  />
							</li>
							<li>
								<label for=""><span>*</span>手机号码：</label>
								<input type="text" name="phone" class="txt" />
							</li>
						</ul>
					</div>
				</div>
				<!-- 收货人信息  end-->

				<!-- 配送方式 start -->
				<div class="delivery">
					<h3>送货方式 </h3>
					<div class="delivery_info">
						<p>普通快递送货上门</p>
						<p>送货时间不限</p>
					</div>

					<div class="delivery_select none">
						<table>
							<thead>
								<tr>
									<th class="col1">送货方式</th>
									<th class="col2">运费</th>
									<th class="col3">运费标准</th>
								</tr>
							</thead>
							<tbody>
								<tr class="cur">	
									<td>
										<input type="radio" checked="checked" />普通快递送货上门
										<select name="" id="">
											<option value="">时间不限</option>
											<option value="">工作日，周一到周五</option>
											<option value="">周六日及公众假期</option>
										</select>
									</td>
									<td>￥10.00</td>
									<td>每张订单不满499.00元,运费15.00元, 订单4...</td>
								</tr>
								<tr>
									
									<td><input type="radio" name="delivery" />特快专递</td>
									<td>￥40.00</td>
									<td>每张订单不满499.00元,运费40.00元, 订单4...</td>
								</tr>
								<tr>
									
									<td><input type="radio" name="delivery" />加急快递送货上门</td>
									<td>￥40.00</td>
									<td>每张订单不满499.00元,运费40.00元, 订单4...</td>
								</tr>
								<tr>

									<td><input type="radio" name="delivery" />平邮</td>
									<td>￥10.00</td>
									<td>每张订单不满499.00元,运费15.00元, 订单4...</td>
								</tr>
							</tbody>
						</table>
						<a href="" class="confirm_btn"><span>确认送货方式</span></a>
					</div>
				</div> 
				<!-- 配送方式 end --> 

				<!-- 支付方式  start-->
				<div class="pay">
					<h3>支付方式</h3>

					<div class="pay_select">
						<table> 
								<td class="col1"><input type="radio" name="pay_way" checked="checked" value="1"/>支付宝</td>
								<td class="col2">悔创阿里杰克马</td>
							</tr>
							<tr>
								<td class="col1"><input type="radio" name="pay_way" value="2"/>微信</td>
								<td class="col2">老马快没钱坐公交了</td>
							</tr>
						</table>
					</div>
				</div>
				<!-- 支付方式  end-->

				<!-- 商品清单 start -->
				<div class="goods">
					<h3>商品清单</h3>
					<table>
						<thead>
							<tr>
								<th class="col1">商品</th>
								<th class="col2">规格</th>
								<th class="col3">价格</th>
								<th class="col4">数量</th>
								<th class="col5">小计</th>
							</tr>	
						</thead>
						<tbody>
							<?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
							<tr>
								<td class="col1"><a href=""><img src="/<?php echo $vo['goods']['goods_thumb']; ?>" alt="" /></a>  <strong><a href="<?php echo url('goods/detail','id='.$vo['goods_id']); ?>"><?php echo $vo['goods']['goods_name']; ?></a></strong></td>
								<td class="col2"> 
									<?php if(is_array($vo['attrs']) || $vo['attrs'] instanceof \think\Collection || $vo['attrs'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['attrs'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
									<p><?php echo $v['attr_name']; ?>：<?php echo $v['attr_value']; ?></p>  
									<?php endforeach; endif; else: echo "" ;endif; ?>
								</td>
								<td class="col3">￥<?php echo $vo['goods']['shop_price']; ?></td>
								<td class="col4"> <?php echo $vo['goods_count']; ?></td>
								<td class="col5"><span>￥<?php echo $vo['goods']['shop_price']*$vo['goods_count']; ?></span></td>
							</tr>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="5">
									<ul>
										<li>
											<span><?php echo $sum; ?> 件商品，总商品金额：</span>
											<em>￥<?php echo $total; ?></em>
										</li>
										<!-- <li>
											<span>返现：</span>
											<em>-￥240.00</em>
										</li> -->
										<li>
											<span>运费：</span>
											<em>00.00</em>
										</li>
										<li>
											<span>应付总额：</span>
											<em name="total">￥<?php echo $total; ?></em>
										</li>
									</ul>
								</td>
							</tr>
						</tfoot>
					</table>
				</div>
				<!-- 商品清单 end -->
			
			</div>

			<div class="fillin_ft">
				<input type="submit" value="提交订单" class="btn">
				<p>应付总额：<strong>￥<?php echo $total; ?></strong></p>
				
			</div>
		</div>
	</form>
	<!-- 主体部分 end -->

	<div style="clear:both;"></div>
	<!-- 底部版权 start -->
	<div class="footer w1210 bc mt15">
		<p class="links">
			<a href="">关于我们</a> |
			<a href="">联系我们</a> |
			<a href="">人才招聘</a> |
			<a href="">商家入驻</a> |
			<a href="">千寻网</a> |
			<a href="">奢侈品网</a> |
			<a href="">广告服务</a> |
			<a href="">移动终端</a> |
			<a href="">友情链接</a> |
			<a href="">销售联盟</a> |
			<a href="">京西论坛</a>
		</p>
		<p class="copyright">
			 © 2005-2013 京东网上商城 版权所有，并保留所有权利。  ICP备案证书号:京ICP证070359号 
		</p>
		<p class="auth">
			<a href=""><img src="__HOME__images/xin.png" alt="" /></a>
			<a href=""><img src="__HOME__images/kexin.jpg" alt="" /></a>
			<a href=""><img src="__HOME__images/police.jpg" alt="" /></a>
			<a href=""><img src="__HOME__images/beian.gif" alt="" /></a>
		</p>
	</div>
	<!-- 底部版权 end -->
</body>
</html>
