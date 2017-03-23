$(function(){
	$(".time-date").click(function(){
		$(this).addClass("on").siblings(".time-date").removeClass("on");
		if (typeof clickafter == "function") {
			clickafter($(this));
		}
	});
})
