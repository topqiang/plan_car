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
    
		<!--<div class="driverss-head">
			<a href="#"></a>
			<i></i>
			<span>车辆预约</span>
		</div>-->
		<div class="school-head">

			<img src="<?php echo ($carlist[0]['logo']); ?>"/>
			<p><?php echo ($carlist[0]['sname']); ?></p>

		</div>
		<div class="school-select bgyellow">选择车辆</div>
		<div class="school-cont">
			<?php if(is_array($carlist)): $i = 0; $__LIST__ = $carlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$car): $mod = ($i % 2 );++$i;?><div class="school-item" linkto="<?php echo U('Car/paycar',array('id'=>$car['id']));?>">
					<img src="<?php echo ($car['pic']); ?>"/ class="fl">
					<div class="fl">
						<p><?php echo ($car['name']); ?></p>
						<p>车牌号&nbsp;&nbsp;<?php echo ($car['carcode']); ?>学</p>
					</div>			
					<span class="fr <?php if($car["istrue"]): ?>on<?php endif; ?>">可预约</span>
				</div><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>

    

    </body>
</html>