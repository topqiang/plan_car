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
    
	<div class="time-head">
		<div class="school-item">
			<img src="<?php echo ($car["pic"]); ?>"/ class="fl">
			<div class="fl">
				<p><?php echo ($car["name"]); ?></p>
				<p>车牌号&nbsp;&nbsp;<?php echo ($car["carcode"]); ?></p>
			</div>			
			<span class="fr on">可预约</span>
		</div>
	</div>
	<div class="school-select bggreen time-select">选择时间</div>
	<div class="time-cont">
		<div class="fl">
			<?php if(is_array($datelist)): $i = 0; $__LIST__ = $datelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$date): $mod = ($i % 2 );++$i;?><div class="time-date <?php if($i == 1): ?>on<?php endif; ?>" name="1" date="<?php echo ($date['y']); ?>/<?php echo ($date['m']); ?>/<?php echo ($date['d']); ?>" week="<?php echo ($date['w']); ?>">
					<p><?php echo ($date['m']); ?>月<?php echo ($date['d']); ?></p>
					<p><?php echo ($date['w']); ?></p>
				</div><?php endforeach; endif; else: echo "" ;endif; ?>	
		</div>
		<div class="fr">
			<div class="time-item">
				<?php if(is_array($timelist)): $i = 0; $__LIST__ = $timelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$time): $mod = ($i % 2 );++$i;?><span timeid="<?php echo ($time['id']); ?>" <?php if($time["istrue"]): ?>class="on"<?php endif; ?>><?php echo ($time['time']); ?></span><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
		</div>
	</div>
	<div class="time-foot">
		<span class="bgyellow submitorder">预约</span>
	</div>

    
	<script type="text/javascript">

		function bindclick() {
			$(".time-item span.on").on('click',function(){
				$(this).addClass("bor1yel").siblings().removeClass("bor1yel");
			});
		}
		bindclick();
		var cid = "<?php echo ($car["id"]); ?>";
		var sid = "<?php echo ($car["sid"]); ?>";

		function clickafter( self ) {
			var date = self.attr("date");	
			if (date && cid) {
				$.ajax({
					"url" : "<?php echo U('Car/getTime');?>",
					"type" : "post",
					"dataType" : "json",
					"data" : {date:date,cid:cid},
					"success" : function( res ){
						if ( res.flag == "success") {
							var timelist = res.data;
							var str = "";
							for(var index in timelist){
								var time = timelist[index];
								str += '<span timeid="'+time['id']+'" class="'+(time['istrue'] ? 'on' : '')+'">'+time['time']+'</span>';
							}
							$(".time-item").html(str);
							bindclick();
						}else{
							layer.msg( res.message );
						}
					}
				})
			}
		}
		$(".submitorder").on('click',function(){
			var date = $(".time-date.on").attr("date");
			var time = $(".bor1yel.on").text();
			if (cid && sid && date && time) {
				$.ajax({
					"url" : "<?php echo U('Order/addOrder');?>",
					"type" : "post",
					"dataType" : "json",
					"data" : {cid:cid,sid:sid,date:date,time:time},
					"success" : function ( res ) {
						if ( res.flag == "success" ) {
							console.log(res);
							window.location.href = "<?php echo U('User/userinfo');?>/id/"+res.data;
						}else{
							layer.msg(res.message);
						}
					}
				})
			}else{
				layer.msg("系统有误！");
			}
		});
	</script>

    </body>
</html>