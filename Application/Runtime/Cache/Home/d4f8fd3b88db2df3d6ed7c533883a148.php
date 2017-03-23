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
		<div class="city-head">
			<div>
			<form action="<?php echo U('Index/school');?>" method="post">
				<input type="search" name="city" placeholder="输入城市搜索"/>
			</form>
			</div>
			<p>当前定位<span class="yellow city0"></span></p>
		</div>
		<div class="city-already">
			<p>已开通城市</p>
			<ul class="findcity">
				<?php if(is_array($citylist)): $i = 0; $__LIST__ = $citylist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$city): $mod = ($i % 2 );++$i;?><li><?php echo ($city['city']); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
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

		$(".findcity li").on('click',function () {
			var city = $(this).text();
			if (city) {
				window.location.href = "<?php echo U('Index/school');?>/city/"+city;
			}
		})
	</script>

    </body>
</html>