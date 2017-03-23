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
    
	<?php if(is_array($schlist)): $i = 0; $__LIST__ = $schlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$school): $mod = ($i % 2 );++$i;?><div class="list-item pad0-3 h40-lh40 borb1 bgw color-gray" linkto="<?php echo U('User/bindsc',array('sid'=>$school['id']));?>">
			<?php echo ($school['name']); ?>
			<span class="fr">(<?php echo ($school['city']); ?>)</span>
		</div><?php endforeach; endif; else: echo "" ;endif; ?>

    
    </body>
</html>