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
			<h3>编辑车辆</h3>
			<div class="clear"></div>
		</div>
		<div class="content-box-content">
			<div class="tab-content default-tab">
				<form action="<?php echo U('Car/carEdit',array('id'=>$info['id']));?>" method="post" enctype="multipart/form-data">
					<fieldset>
						<p>
							<label>车辆名称(ID:<?php echo ($info["id"]); ?>)</label>
							<input value="<?php echo ($info["name"]); ?>" class="text-input small-input" type="text" id="small-input" name="name" />
						</p>
						<p>
							<label>车牌</label>
							<input class="text-input small-input" type="text" id="small-input" name="carcode" value="<?php echo ($info["carcode"]); ?>" />
						</p>
						<p>
							<label>所属学校</label>
							<select name="sid">
								<?php if(is_array($schoollist)): $i = 0; $__LIST__ = $schoollist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo['id'] == $info['sid']): ?><option value="<?php echo ($vo["id"]); ?>" selected="selected"><?php echo ($vo["name"]); ?></option>
										<?php else: ?>
										<option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
							</select>
						</p>
						<p>
							<label>缩略图</label>
							<img src="/plancar/<?php echo ($info["pic"]); ?>" width="100" height="100"/>
							<input type="file" name="pic"/>
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
<script type="text/javascript">
	function ajax(){
		var filesize = this.files[0].size;
		if (filesize > 500*1024) {
			alert("请上传大小在500k以下的图片");
			return false;
		};
		var self = $(this);
		var files = this.files;
		var reader = new FileReader();
		reader.onload = function(e){
			var src = e.target.result;
			self.prev().attr("src",src);
		}
		reader.readAsDataURL(files[0]);
	}
	$("input[type='file']").on('change',ajax);
</script>
</body>
</html>