<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>后台管理系统</title>
	<link rel="stylesheet" href="/plancar/Public/Admin/css/reset.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="/plancar/Public/Admin/css/style.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="/plancar/Public/Admin/css/invalid.css" type="text/css" media="screen" />
	<script type="text/javascript" src="/plancar/Public/Admin/js/jquery-1.9.1.min.js"></script>
</head>
<body>
<div id="main-content">
	<div class="content-box">
		<!--头部切换-->
		<div class="content-box-header">
			<h3>编辑学校</h3>
			<div class="clear"></div>
		</div>
		<div class="content-box-content">
			<div class="tab-content default-tab">
				<form action="<?php echo U('School/schooledit');?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="id" value="<?php echo ($info["id"]); ?>" />
					<fieldset>
						<p>
							<label>门店名称(ID:<?php echo ($info["id"]); ?>)</label>
						</p>
						<p>
							<label>校名</label>
							<input class="text-input small-input" type="text" name="name" required value="<?php echo ($info["name"]); ?>"/>
						</p>
						<p>
							<label>城市</label>
							<input class="text-input small-input" type="text" name="city" required value="<?php echo ($info["city"]); ?>"/>
						</p>
						<p>
							<label>门店</label>
							
							<input type="file" name="pic"/>
						</p>
						<p>
							<label>用户名</label>
							<input class="text-input small-input" type="text" name="username" required value="<?php echo ($info["username"]); ?>"/>
						</p>
						<p>
							<label>电话</label>
							<input class="text-input small-input" type="tel" name="tel" required value="<?php echo ($info["tel"]); ?>"/>
						</p>
						<?php if(!empty($_SESSION['s_id'])): ?><p>
							<label>密码</label>
							<input class="text-input small-input" type="password" name="password"/>
						</p><?php endif; ?>
						<p>
							<label>地址</label>
							<input class="text-input small-input" type="text" name="address" value="<?php echo ($info["address"]); ?>"/>
						</p>
						<p>
							<input class="button" type="submit" value="保存" />
						</p>
					</fieldset>
					<div class="clear"></div>
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>