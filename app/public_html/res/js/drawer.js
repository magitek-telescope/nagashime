$(function (){
	$(".drawer-button").click(function (){
		if($(".drawer-menu").attr("data-open") == "0" && $(".drawer-menu").css("right") == "-300px" && $(".modal").css("display") != "block"){
			$(".drawer-menu").attr("data-open", "1");
			$(".drawer-menu").animate(
				{
					right:"0px"
				},
				{
					duration: "1500",
					easing: 'easeOutQuint'
				}
			);
		}
	});

	$("*").not(".drawer-menu, .drawer-menu *").click(function (){
		if($(".drawer-menu").attr("data-open") == "1" && $(".drawer-menu").css("right") == "0px"){
			$(".drawer-menu").attr("data-open", "0");
			$(".drawer-menu").animate(
				{
					right:"-300px"
				},
				{
					duration: "800",
					easing: 'easeOutQuint'
				}
			);
		}
	});


	$(".menu-button, .drawer-menu li a:not(.logout)").click(function (){
		var names = ["add-feed", "add-category", "edit-category", "help", "user", "settings"];

		for (name of names){
			$(".modal-"+name).css("display", "none");
		}

		if($(this).hasClass("add-feed")){
			$(".modal-add-feed").css("display", "block");
		}

		if($(this).hasClass("add-category")){
			$(".modal-add-category").css("display", "block");
		}

		if($(this).hasClass("help")){
			$(".modal-help").css("display", "block");
		}

		if($(this).hasClass("user")){
			$(".modal-user").css("display", "block");
		}

		if($(this).hasClass("settings")){
			$(".modal-settings").css("display", "block");
		}

		$(".modal").fadeIn();
		$(".modal-background").css("display", "block");
	});

})