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
    
		<div class="coach-item pad3 bgw mab10">
			<div class="coach-per ovh" linkto="<?php echo U('User/userinfo');?>">
				<img src="/plancar/<?php echo ($user['head_pic']); ?>"/ class="fl">
				<div class="coach-word fl">
					<p class="fs16"><?php echo ($user['name']); ?></p>
					<p class="fs13"><?php echo ($user['phone']); ?></p>
				</div>
				<div class="record-next fr"></div>
			</div>
			<div class="coach-time ovh">
				<span class="fl"><?php if($user['istrue'] == 0): ?>未审核<?php else: ?>已审核<?php endif; ?></span>
				<p class="fr"><?php echo ($user['city']); ?>&nbsp;&nbsp;<?php echo ($user['sname']); ?></p>
			</div>
		</div>
		<div class="record-record fs16 color-gray">预约记录</div>
		<div class="mab50">

			<?php if(is_array($orderlist)): $i = 0; $__LIST__ = $orderlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order): $mod = ($i % 2 );++$i;?><div class="record-item pad0-3 bgw mab10">
					<div class="borb1 ovh">
						<span class="fl yellow"><?php echo ($order['date']); ?>&nbsp;&nbsp;<?php echo ($order['time']); ?></span>
						<span class="fr"><?php echo ($order['sname']); ?></span>
					</div>
					<div class="pad10-0">
						<p><?php echo ($order['cname']); ?></p>
						<p class="fs14 color-gray"><?php echo ($order['carcode']); ?></p>
					</div>			
				</div><?php endforeach; endif; else: echo "" ;endif; ?>

		</div>
		<div class="driverss-foot">
			<div class="fl" linkto="<?php echo U('Index/school');?>">
				<img src="/plancar/Public/Home/img/car4.png"/>
				<p>驾校</p>
			</div>
			<div class="fl" linkto="<?php echo U('Index/introduce');?>">
				<img src="/plancar/Public/Home/img/wallet.png"/>
				<p>预约报名</p>
			</div>
			<div class="fl on">
				<img src="/plancar/Public/Home/img/mine1.png"/>
				<p>我的</p>
			</div>
		</div>

    
    </body>
</html>