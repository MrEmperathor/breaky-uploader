$(document).ready(function(){
	$(".main_background_form").click(function(){
		$(".main_main_background").animate({left:"0%"},300);
		$(".main_main_background").animate({left:"28%"},300);
		$(".main_main_background").animate({left:"0%"},300);
		$(".main_main_background").animate({left:"39%"},400);
		$(".main_main_background").animate({left:"15%"},400);
		$(".main_main_background").animate({left:"38%"},400);
		$(".main_main_background").animate({left:"30%"},500);
		$(".main_main_background").animate({left:"37%"},500);
		$(".main_background").animate({left:"63%"});
		$(".arrow_up").animate({left:"60%"});

	});
});

$(document).ready(function(){
	$(".login_btn").click(function(){
		$(".main_background").animate({left:"50%"});
		$(".main_main_background").animate({left:"50%"},300);
		$(".arrow_up").animate({left:"0%"},300);
	});
});