$(function(){
	$(".time-date").click(function(){
		var ref=$(this);
		var name=ref.attr("name");
		$(this).addClass("on").siblings(".time-date").removeClass("on");
		$(".time-item[forname="+name+"]").show().siblings().hide();
	})
//选择时间页面切换

	
})
