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
    
	<div class="coach-head">
		<p class="yellow"><?php echo ($order['cname']); ?></p>
		<p>车牌号&nbsp;&nbsp;<?php echo ($order['carcode']); ?></p>
		<p>若您预约了此车，请您在预约时间内准时到达训练场。若临时有事，请致电（<?php echo ($order['tel']); ?>）取消预约</p>
	</div>
	<div class="coach-cont">
		<div class="coach-item pad3 bgw mab10">
			<div class="coach-per ovh">
				<img src="/plancar<?php echo ($order['head_pic']); ?>"/ class="fl">
				<div class="coach-word fl">
					<p class="fs16"><?php echo ($order['uname']); ?></p>
					<p class="fs13"><?php echo ($order['phone']); ?></p>
				</div>
				<div class="coach-check fr centen">
					<img src="/plancar/Public/Home/img/check.png"/>
					<p class="fs13"><?php echo ($order['sname']); ?></p>
				</div>
			</div>
			<div class="coach-time fs14">
				<span class="fs16">预约时间</span>
				<?php echo ($order['date']); ?>&nbsp;&nbsp;<?php echo ($order['time']); ?>
			</div>
		</div>
		<div class="coach-remark bgw">
			<textarea placeholder="请填写备注" class="fs16 remark"></textarea>
		</div>
	</div>
	<div class="coach-foot">
		<span class="bgyellow disi fs15 subbtn">立即预约</span>
		<p class="fs12">提交前请您仔细核对您的信息，确保无误后提交</p>
	</div>

    
	<script type="text/javascript">
	$(".subbtn").on('click',function(){
		var id = "<?php echo ($order['id']); ?>";
		var remark = $(".remark").val();
		if (id && remark) {
			$.ajax({
				"url": "<?php echo U('Order/addremark');?>",
				"type": "post",
				"dataType": "json",
				"data" : {id:id,remark:remark},
				"success":function ( res ) {
					layer.msg( res.message );
					if ( res.flag == "success") {
						window.location.href = "<?php echo U('User/user');?>";
					}
				}
			});
		}
	});
	</script>

    </body>
</html>