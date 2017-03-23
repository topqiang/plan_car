<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no,maximum-scale=1,minimum-scale=1"/>
        <link rel="stylesheet" href="/plancar/Public/Home/css/car.css" />
        <script type="text/javascript" src="/plancar/Public/Home/js/jquery.min.js"></script>
        <script type="text/javascript" src="/plancar/Public/Home/js/car.js"></script>
        <script type="text/javascript" src="/plancar/Public/Home/js/public.js"></script>
        <script type="text/javascript" src="/plancar/Public/Home/js/public.js"></script>
        <script type="text/javascript" src="/plancar/Public/Admin/js/layer/layer.js"></script>

        <title>驾校</title>
        <style type="text/css">
        </style>
    </head>
    <body>
    
	<div class="person-head pad0-3 bgw">
		<div class="ovh pad10-0 borb1 pore">
			<span class="fl">头像</span>
			<img src="<?php echo ($user['head_pic']); ?>" class="fr viewhead"/>
			<input type="file" / class="per-img">
		</div>
		<div class="ovh">
			<span class="fl">昵称</span>
			<span class="fr color-gray blurdiv" type="nick_name" contenteditable="true"><?php echo ($user['nick_name']); ?></span>
		</div>
	</div>
	<div class="person-check ovh pad0-3">
		<p class="fl color-gray">审核状态</p>
		<p class="fr yellow"><?php if($user['istrue'] == 0): ?>未审核<?php else: ?>已审核<?php endif; ?></p>
	</div>
	<div class="mab50">
		<div class="person-item pad0-3 bgw">
			<div class="borb1 h40-lh40">
				<span class="fl">姓名</span>
				<span class="fr color-gray blurdiv" type="name" <?php if($user['istrue'] == 0): ?>contenteditable="true"<?php endif; ?>><?php if(empty($user['name'])): ?>无<?php else: echo ($user['name']); endif; ?></span>
			</div>			
		</div>
		<div class="person-item pad0-3  bgw">
			<div class="borb1 h40-lh40">
				<span class="fl">手机号</span>
				<span class="fr color-gray blurdiv" type="phone" <?php if($user['istrue'] == 0): ?>contenteditable="true"<?php endif; ?>><?php if(empty($user['phone'])): ?>无<?php else: echo ($user['tel']); endif; ?></span>
			</div>			
		</div>
		<div class="person-item pad0-3 bgw">
			<div class="h40-lh40" <?php if($user['istrue'] == 0): ?>linkto="<?php echo U('Index/list');?>"<?php endif; ?>>
				<span class="fl">驾校</span>
				<span class="person-next fr"></span>
				<span class="fr color-gray"><?php if(empty($user['sname'])): ?>无<?php else: echo ($user['city']); ?>&nbsp;&nbsp;<?php echo ($user['sname']); endif; ?></span>
			</div>			
		</div>
	</div>
	<div class="coach-foot">
		<span class="bgyellow disi fs15 subbtn">提交审核</span>
		<p class="fs12">提交前请您仔细核对您的信息，确保无误后提交</p>
	</div>

    
	<script type="text/javascript">
	$(".blurdiv").on('blur',function(){
		var value = $(this).text();
		var clum = $(this).attr('type');
		if (clum=="phone" && !/^1[3|4|5|7|8]\d{9}$/.test(value)) {
			layer.msg("手机号输入不合法！");
			return;
		}
		if (!value) {
			layer.msg("内容不能为空！");
			$(this).text("无");
			return;
		}
		$.ajax({
			"url": "<?php echo U('User/change');?>",
			"data": {"value":value,"clum": clum},
			"dataType": "json",
			"type":"post",
			"success": function( res ){
				if ( res.flag == "success") {

				}
				layer.msg(res.message);
			}
		});

	});

	$(".subbtn").on('click',function () {
		layer.msg("请耐心等待吧！");
	});


	function ajax(){
        var filesize = this.files[0].size;
        if (filesize > 10000*1024) {
            alert("请上传大小在500k以下的图片");
            return false;
        }
        var files = this.files;
        var picname = files[0].name;
        var reader = new FileReader();
        reader.onload = function(e){
            var src = e.target.result;
            $.ajax({
                type:"post",
                url:"<?php echo U('User/uploadPic');?>",
                data: {"pic":src,"pic_name":picname},
                dataType : "json",
                success : function(data){
                    //var data = JSON.parse(data);
                    console.log(data.message);
                    if(data['flag'] == "success"){
                        $(".viewhead").attr("id",data['data']['id']);
                        $(".viewhead").attr("src",data['data']['path']);
                    }
                }
            });
        }
        reader.readAsDataURL(files[0]);
    }
    $("input[type='file']").on('change',ajax);
	</script>

    </body>
</html>