<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>后台管理系统</title>
	<link rel="stylesheet" href="/elem/Public/Admin/css/reset.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="/elem/Public/Admin/css/style.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="/elem/Public/Admin/css/invalid.css" type="text/css" media="screen" />
	<script type="text/javascript" src="/elem/Public/Admin/js/jquery-1.9.1.min.js"></script>
</head>
<body>
<div id="main-content">
	<div class="content-box">
		<!--头部切换-->
		<div class="content-box-header">
			<h3>上传门店轮播图</h3>
		</div>
		<div class="content-box-content">
			<div class="tab-content default-tab">
				<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div>
						<div><img src="<?php echo ($vo["picsrc"]); ?>" style="width:250px;height:170px" /></div>
						<input class="text-input small-input" type="file" id="<?php echo ($vo["id"]); ?>" name="pic"/>
						<a href="<?php echo U('Shop/picdel',array('id'=>$vo['id']));?>" title="删除">
                            <img src="/elem/Public/Admin/images/icons/cross.png" alt="Delete" />
                        </a>
					</div><?php endforeach; endif; else: echo "" ;endif; ?>
				<div class="btnpic">
					<input class="button addpic" value="添加图片" />
					<span style="margin-right:10px;color:red">请上传宽高比为3:2的图片，不然图片会失真。（上传前将名称改为英文或数字哦）</span>
				</div>
			<div class="clear"></div>
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
		var id = self.attr("id");
		var picname = files[0].name;
		var reader = new FileReader();
		reader.onload = function(e){
			var src = e.target.result;
			self.prev().find("img").attr("src",src);
			$.ajax({
				type:"post",
				url:"<?php echo U('Shop/uploadshop');?>",
				data: {"pic":src,"picname":picname,"id": id},
				dataType : "json",
				success : function(data){
					if(data != "error"){
						self.attr("id",data);
						self.after('<a href="<?php echo U('Shop/picdel');?>/id/'+data+'" title="删除"><img src="/elem/Public/Admin/images/icons/cross.png" alt="Delete" /></a>');
					}
				}
			});
		}
		reader.readAsDataURL(files[0]);
	}
	$("input[type='file']").on('change',ajax);
	$(".addpic").on("click",function(){
		var self = $("<div/>").html('<div><img src=""/></div><input class="text-input small-input" type="file" id="" name="pic"/>').insertBefore(".btnpic");
		self.find("input[type='file']").on('change',ajax);
	});
</script>
</body>
</html>