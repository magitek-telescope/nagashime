var delay = parseInt($("#user-info").attr("data-scroll"));

function scrollArticles(){

	// $(".column main ul").each(function (i){
	// 	var $e = $(this);
	// 	if($e.attr("data-isHover") != "1"){
	// 		$e.attr("data-timer", +$e.attr("data-timer")+100);
	// 	}
	// 	if($e.attr("data-timer") > delay){
	// 		$e.attr("data-timer", "0");
	// 		if($e.scrollTop() < 100) newArticle($e.children('li:last-child').prependTo($e));
	// 	}
	// });
}

function newArticle($element, delay){
	$element.css({
		marginTop:-$element.outerHeight()
	});

	$element.animate(
		{
			marginTop: "0"
		},
		{
			duration: "300",
			easing: "easeOutQuad"
		}
	);
}

function hiddenModal(){
	$(".modal").fadeOut();
	$(".modal-background").fadeOut();
}

function loadArticleImage(){
	console.log("wei");
	$(".loadingArticleImage").each(function() {

		console.log("http://api.nagashi.me/feed/getArticleImage/?url=" + $(this).attr("data-getURL") + ")");
		$(this).css({
			'background-image': "url(" + "http://api.nagashi.me/feed/getArticleImage/?url=" + $(this).attr("data-getURL") + ")",
			"background-size" : "cover",
			"-webkit-background-size": "cover"
		});
		$(this).removeClass("loadingArticleImage");
	});
}

(function($) {
    $.extend({
		htmlspecialchars: function htmlspecialchars(ch){
			ch = ch.replace(/&/g,"&amp;");
			ch = ch.replace(/"/g,"&quot;");
			ch = ch.replace(/'/g,"&#039;");
			ch = ch.replace(/</g,"&lt;");
			ch = ch.replace(/>/g,"&gt;");
			return ch ;
		}
	});
})(jQuery);


$(function (){
	$(document).ready(function (){

		/*
		$("#main").css({
			opacity:"1.0",
			width: (301 * $(".column").length)+ + "px"
		});
		*/

		$(".column main ul").attr("data-timer", "0");
		setInterval("scrollArticles()", 100);
	});

	$(".column main ul").hover(
		function () {
			$(this).attr("data-isHover", "1");
		},
		function () {
			$(this).attr("data-isHover", "0");
		}
	);
})