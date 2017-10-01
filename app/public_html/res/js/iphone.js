$(function (){
  if ((navigator.userAgent.indexOf('iPhone') > 0 && navigator.userAgent.indexOf('iPad') == -1) || navigator.userAgent.indexOf('iPod') > 0) {
      $("#main").wrap("<div class='sp'></div>");
      $("#main").css("padding-bottom", "20px");
      $("#main").css("padding-top", "50px");
      $("#main").css("overflow-y", "hidden");
  }
});