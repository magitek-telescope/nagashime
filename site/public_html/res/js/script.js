$(function (){
	var flag = false;

	$(".jump-to-register").click(function (){
		if(flag == true) return;
		$(".register-form").animate(
			{
				top:""+(window.innerHeight/2 - 150)+"px"
			},
			{
				duration: "2000",
				easing: 'easeOutBack'
			}
		);
		setTimeout(function (){flag = true}, 500);
	});


	$(document).click(function(event) {
	    if (!$.contains($(".register-form")[0], event.target)) {
	        if(flag == false) return;
			$(".register-form").animate(
				{
					top:"-400px"
				},
				{
					duration: "2000",
					easing: 'easeOutBack'
				}
			);
			setTimeout(function (){flag = false}, 500);
	    }
	});

    $(window).scroll(function () {
        if($(window).scrollTop() > 0) {
            $('.page-top').fadeIn();
        } else {
            $('.page-top').fadeOut();
        }
    });

	$(".page-top").click(function (){
		$("html,body").animate({scrollTop:0},"500");
	});

});