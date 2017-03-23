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
    
		<div class="mab50">
			<div class="person-item pad0-3 bgw">
				<div class="borb1 h40-lh40">
					<span class="fl">姓名</span>
					<input class="fr color-gray name" placeholder="请输入姓名"/>
				</div>			
			</div>
			<div class="person-item pad0-3  bgw">
				<div class="borb1 h40-lh40">
					<span class="fl">手机号</span>
					<input class="fr color-gray tel" placeholder="请填写手机号"/>
				</div>			
			</div>
			<div class="person-item pad0-3 bgw">
				<div class="h40-lh40">
					<span>理想练车区域</span>
				</div>
				<textarea class="intro-txt text"></textarea>
			</div>
			<div class="intro-intro">
			<div class="pad20-3 fs14">介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍</div>
			<p><span class="bgyellow subbtn">提交介绍</span></p>
		</div>
		</div>
		<div class="driverss-foot">
			<div class="fl" linkto="<?php echo U('Index/school');?>">
				<img src="/plancar/Public/Home/img/car4.png"/>
				<p>驾校</p>
			</div>
			<div class="fl on">
				<img src="/plancar/Public/Home/img/wallet1.png"/>
				<p>预约报名</p>
			</div>
			<div class="fl" linkto="<?php echo U('User/user');?>">
				<img src="/plancar/Public/Home/img/mine.png"/>
				<p>我的</p>
			</div>
		</div>

    
	<script type="text/javascript">
		$(".subbtn").on('click',function () {
			var name = $(".name").val();
			var tel = $(".tel").val();
			var text = $(".text").val();
			console.log(name+"==");
			if (!name || name.length<2 || name.length>5) {
				layer.msg("名字请输入2-5个字符");
				return;
			}
			if (!/^1[3|4|5|7|8]\d{9}$/.test(tel)) {
				layer.msg("请输入合法的手机号");
				return;
			}
			if (!text) {
				layer.msg("请输入想要练车的区域！");
				return;
			}

			$.ajax({
				"url":"<?php echo U('Index/addmsg');?>",
				"type" :"post",
				"dataType":"json",
				"data": {"name":name,"tel":tel,"text":text},
				"success":function (res) {
					if (res.flag=="success") {
						window.location.href = "<?php echo U('Index/school');?>";
					}else{
						layer.msg(res.message);
					}
				}
			});
		});
	</script>

    </body>
</html>