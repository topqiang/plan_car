<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no,maximum-scale=1,minimum-scale=1"/>
        <link rel="stylesheet" href="/plancar/Public/Home/css/car.css" />
        <script type="text/javascript" src="/plancar/Public/Home/js/jquery.min.js"></script>
        <script type="text/javascript" src="/plancar/Public/Home/js/car.js"></script>
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
		<div class="driverss-per  examine-per">
			<span class="fl">
				我的驾校
				<i>国泰驾校</i>
			</span>
			<img src="/plancar/Public/Home/img/logo1.png"/ class="fr">
		</div>
		<div class="driverss-cont mab50">
			<div class="site-head">
				<p class="driverss-site fl">
					当前定位
					<span class="yellow city0">天津</span>
				</p>
				<i class="fr iconright"></i>
			</div>
			<div class="driverss-item">

				<?php if(is_array($schlist)): $i = 0; $__LIST__ = $schlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$school): $mod = ($i % 2 );++$i;?><div class="img">
						<img src="<?php echo ($school['logo']); ?>"/>
						<p><?php echo ($school['name']); ?></p>
						<span sid="<?php echo ($school['id']); ?>">预约</span>
					</div><?php endforeach; endif; else: echo "" ;endif; ?>
					
			</div>
		</div>
		<div class="driverss-foot">
			<div class="fl on">
				<img src="/plancar/Public/Home/img/car2.png"/>
				<p>驾校</p>
			</div>
			<div class="fl">
				<img src="/plancar/Public/Home/img/wallet.png"/>
				<p>预约报名</p>
			</div>
			<div class="fl">
				<img src="/plancar/Public/Home/img/mine.png"/>
				<p>我的</p>
			</div>
		</div>
		<div class="hid0" id="container"></div>

    
<script charset="utf-8" src="http://map.qq.com/api/js?v=2.exp"></script>
	<script>
		$(function () {
			var citylocation,map,marker = null;
            var init = function() {
                var center = new qq.maps.LatLng(39.916527,116.397128);
                map = new qq.maps.Map(document.getElementById('container'),{
                    center: center,
                    zoom: 13
                });
                //获取  城市位置信息查询 接口  
                citylocation = new qq.maps.CityService({
                    //设置地图
                    map : map,

                    complete : function(results){
                        console.log(results);
                        $(".city0").text(results.detail.name);
                    }
                });
            }
            init();
            citylocation.searchCityByIP("<?php echo ($ip); ?>");
		});
	</script>

    </body>
</html>