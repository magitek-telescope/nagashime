$(function (){

  /**
   * カラムトップボタン
  **/
  $(document).on('click', '#main .column header h1', function (){
    var $target = $(this).parents('.column').children("main").children("ul");

    $target.animate(
      {
        scrollTop: 0
      },
      {
        duration: $target.scrollTop() * 0.5,
        easing: "easeOutQuad"
      }
    );
  });

  /**
   * カラムメニュー開閉
  **/
  $(document).on('click',".more",function(){
    if($(this).children("i").hasClass('fa-chevron-down')){
      $(this).children(".fa-chevron-down").addClass("fa-chevron-up");
      $(this).children(".fa-chevron-down").removeClass("fa-chevron-down");

      //console.log($(this).parent().parent().children("main").children(".column-menu"));
      $(this).parent().parent().children("main").children(".column-menu").animate(
        {
          top:"0px"
        },
        {
          duration: "800",
          easing: 'easeOutQuint'
        }
      );

      $(this).parent().parent().children("main").children("ul").animate(
        {
          paddingTop:"39px"
        },
        {
          duration: "800",
          easing: 'easeOutQuint'
        }
      );
    }else{
      $(this).children(".fa-chevron-up").addClass("fa-chevron-down");
      $(this).children(".fa-chevron-up").removeClass("fa-chevron-up");

      //console.log($(this).parent().parent().children("main").children(".column-menu"));
      $(this).parent().parent().children("main").children(".column-menu").animate(
        {
          top:"-39px"
        },
        {
          duration: "800",
          easing: 'easeOutQuint'
        }
      );

      $(this).parent().parent().children("main").children("ul").animate(
        {
          paddingTop:"0"
        },
        {
          duration: "800",
          easing: 'easeOutQuint'
        }
      );
    }
  });

  /**
   * Category削除
  **/
  $(document).on('click',".column-menu .close",function(){
    if(window.confirm("削除しますか？")){

      var $target = $(this).parents(".column");
      var columnId = $target.attr("data-id");

      $("#add-feed > div:nth-child(1) > select option[value='"+columnId+"']").remove();

      $target.animate({
        opacity:"0.0"
      }, 500);

      setTimeout(function (){
        $target.animate({
          width:"0px"
        }, 250);
        setTimeout(function (){
          $target.remove();
          $("#main").css("width", (312 * $(".column").length) + "px");
        }, 250);
      }, 500);

      $.ajax({
        url: "//api.nagashi.me/category/delete/",
        type: "GET",
        cache: true,
        data : {
          id   : columnId,
          email: $("#user-info").attr("data-email"),
          token: $("#user-info").attr("data-token")
        }
      });
    }
  });

  /**
   * カラム移動左
  **/
  $(document).on('click','.column-menu .left',function(){
    var $parent = $(this).parents(".column");
    var index  = $(".column").index(parent);

    var prev_element = $parent.prev(".column");
    var next_element = $parent;
    
    $parent.before(next_element);
    $parent.after(prev_element);

    if(prev_element.attr("data-sort") != undefined){
      $.ajax({
        url: '//api.nagashi.me/category/sort/',
        type: 'POST',
        data: {
          elementA  : next_element.attr("data-id"),
          elementB  : prev_element.attr("data-id"),
          email     : $("#user-info").attr("data-email"),
          token     : $("#user-info").attr("data-token")
        }
      });
    }
  });

  /**
   * カラム移動右
  **/
  $(document).on('click','.column-menu .right',function(){
    var $parent = $(this).parents(".column");
    var index  = $(".column").index($parent);

    var prev_element = $parent;
    var next_element = $parent.next(".column");

    $parent.before(next_element);
    $parent.after(prev_element);

    if(next_element.attr("data-sort") != undefined){

      $.ajax({
        url: '//api.nagashi.me/category/sort/',
        type: 'POST',
        data: {
          elementA  : next_element.attr("data-id"),
          elementB  : prev_element.attr("data-id"),
          email     : $("#user-info").attr("data-email"),
          token     : $("#user-info").attr("data-token")
        }
      });
    }
  });

  /**
   * 少し特殊なカラム内の記事リンク処理
  **/
  $(document).on('click','.column main ul li',function(){
    window.open($(this).find(".article-link").attr('data-articleURL'), '_blank');
  });

  /**
   * ソーシャル共有関連。
  **/
  $(document).on('click','#main > .column > main > ul > li > div > p a .fa-facebook-square',function(){
    var $article = $(this).parents("div").find(".article-link");
    window.open("https://www.facebook.com/sharer/sharer.php?u="+ $article.attr('data-articleURL'), '_blank');
    return false;
  });

  $(document).on('click','#main > .column > main > ul > li > div > p a .fa-twitter-square',function(){
    var $article = $(this).parents("div").find(".article-link");
    window.open("https://twitter.com/intent/tweet?text="+ $article.text() + " " + $article.attr('data-articleURL') + " - http://nagashi.me から &hashtags=ナガシミ", '_blank');
    return false;
  });

  $(document).on('click','#main > .column > main > ul > li > div > p a .fa-get-pocket',function(){
    var $article = $(this).parents("div").find(".article-link");
    window.open("http://getpocket.com/edit?title="+ $article.text() + " - ナガシミから&url=" + $article.attr('data-articleURL'), '_blank');
    return false;
  });

  $(document).on('click','#main > .column > main > ul > li > div > p a .fa-envelope',function(){
    var $article = $(this).parents("div").find(".article-link");
    window.open("mailto:?body="+ $article.text() + " " + $article.attr('data-articleURL') + " ナガシミから", '_blank');
    return false;
  });
});