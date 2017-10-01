$(function (){
  $(".modal-background").click(function(event) {
      hiddenModal();
  });

  $(document).on('click',".modal h1 i",function(){
    hiddenModal();
  });

  /**
   * Feed追加フォーム
   * 
   * フォームがsubmitされると、裏でajaxが動きapiサーバーに。
   * 取得してきた結果によりリアルタイムでcolumnを更新。
  **/
  $("#add-feed").submit(function(event) {
        event.preventDefault();

    $.ajax({
      url: '//api.nagashi.me/feed/add/',
      type: 'POST',
      data: {
        url       : $("#add-feed [name=url]").val(),
        category  : $("#add-feed [name=category]").val(),
        email     : $("#user-info").attr("data-email"),
        token     : $("#user-info").attr("data-token")
      },
      success: function(feed){
        $.ajax({
          url: '//api.nagashi.me/feed/get/articles/',
          type: 'POST',
          data: {
            email     : $("#user-info").attr("data-email"),
            token     : $("#user-info").attr("data-token"),
            feed      : $("#add-feed [name=url]").val()
          }
        })
        .done(function(articles) {

          $(".column[data-id="+$("#add-feed [name=category]").val()+"] main ul").html("");
          $.each(articles, function() {
            var article = this;
            var template = feedHtml
              .replace( /%%articleLink%%/g , $.htmlspecialchars(article.link ) )
              .replace( /%%feedId%%/g      , $.htmlspecialchars(feed.id      ) )
              .replace( /%%articleTitle%%/g, $.htmlspecialchars(article.title) );
            $(".column[data-id="+$("#add-feed [name=category]").val()+"] main ul").append(template);
          });

          // $("#main > .column[data-id='" + $("#add-feed [name=category]").val() + "'] main ul").prepend(data);
          $("#add-feed [name=url]").val("");
          hiddenModal();
          loadArticleImage();
        });
      }
    })
    return false;
  });

  /**
   * Category追加フォーム
   * 
   * フォームがsubmitされると、裏でajaxが動きapiサーバーに。
   * 取得してきた結果によりリアルタイムでcolumnを更新。
  **/
  $("#add-category").submit(function(event) {
        event.preventDefault();

    $.ajax({
      url: '//api.nagashi.me/category/add/',
      type: 'POST',
      data: {
        name      : $("#add-category [name='name']").val(),
        email     : $("#user-info").attr("data-email"),
        token     : $("#user-info").attr("data-token")
      },
      success: function(data){
        console.log($(".column").length)
        $("#main").css({width: (312 * ($(".column").length+1)) + "px"});

        $("#main").append(columnHtml);
        $(".column[data-id=-1] " + "> header h1").attr("data-name", data.name).text(data.name);

        $(".column[data-id=-1] ").attr({
          "data-sort": data.sort,
          "data-id"  : data.id
        });

        $("#add-category [name='name']").val("");

        var id   = $("#main .column:last-child").attr("data-id");
        var name = $("#main .column:last-child > header h1").text();
        $("#add-feed > div:nth-child(1) > select").append("<option value='" + id +"'>" + name + "</option>");
        hiddenModal();
      }
    })

    return false;
  });

  /**
   * Category編集フォーム出現
   * 
  **/
  $(document).on('click',".column-menu .edit",function(){
    var $target       = $(this).parents(".column");
    var $editCategory = $(".modal-edit-category");
    var categoryName  = $target.children("header").children("h1").attr("data-name");
    
    var names   = ["add-feed", "add-category", "edit-category", "help", "user", "settings"];
    for (name of names){
      $(".modal-"+name).css("display", "none");
    }

    $(".modal").fadeIn();
    $editCategory.children("form").css("display", "none");
    $editCategory.css("display", "block");
    $(".modal-background").css("display", "block");

    $editCategory.children("h1").html("Loading...<i class='fa fa-close fa-lg close'></i>");

    $.ajax({
      url: '//api.nagashi.me/feed/get/',
      type: 'GET',
      dataType: 'json',
      cache   : false, 
      data: {
        id        : $target.attr("data-id"),
        email     : $("#user-info").attr("data-email"),
        token     : $("#user-info").attr("data-token")
      },
      success: function(data){
        $("#edit-category ul").html("");
        var site;
        for(site of data.feeds){
          $("#edit-category ul").append("<li data-id='"+site.id+"'>"+$.htmlspecialchars(site.url)+"<i class='fa fa-close fa-lg remove-feed'></i></li>");
        }

        $editCategory.children("h1").html("Edit " + $target.children("header").children("h1").text() + "<i class='fa fa-close fa-lg close'></i>");
        $editCategory.children("form").css("display", "block");
        $editCategory.attr("data-id", $target.attr("data-id"));
        $("#edit-category > div.nameZone > input[type='text']").val(categoryName);
      }
    });
  });

  /**
   * Category名称変更フォーム
   * 
  **/
  $(document).on('click',"#edit-category > div.nameZone > input.button",function(){
    var $editCategory = $(this).parents(".modal-edit-category");
    var updateName = $("#edit-category > div.nameZone > input[type='text']").val();

    $(".column[data-id='"+$editCategory.attr("data-id")+"'] header h1").attr("data-name", updateName);
    if(updateName.length >= 9){
      updateName = updateName.slice(0, 8) + "…";
    }
    $(".column[data-id='"+$editCategory.attr("data-id")+"'] header h1").text(updateName);

    $("#add-feed select option[value='"+$editCategory.attr("data-id")+"']").text(updateName);
    hiddenModal();

    $.ajax({
      url: '//api.nagashi.me/category/update/',
      type: 'POST',
      cache   : false, 
      data: {
        id        : $editCategory.attr("data-id"),
        name      : updateName,
        email     : $("#user-info").attr("data-email"),
        token     : $("#user-info").attr("data-token")
      }
    });
  });

  /**
   * Feed削除フォーム
   * 
  **/
  $(document).on('click',"#edit-category div.ListView ul li i",function(){
    var $target = $(this).parent();
    var id = $target.attr("data-id");

    $(".column main ul li[data-feed-id='"+id+"']").remove();
    $target.remove();
    
    $.ajax({
      url: '//api.nagashi.me/feed/delete/',
      type: 'POST',
      data: {
        id        : id,
        email     : $("#user-info").attr("data-email"),
        token     : $("#user-info").attr("data-token")
      }
    })
  });
  

  /**
   * ユーザー設定フォームタブ
   * 
  **/
  $(document).on('click',".modal-user .modal-left li",function(){
    var name = $(this).attr("data-name");
    $(".modal-user h1").html("User Settings<i class='fa fa-close fa-lg close'></i>");
    $(".modal-user > form > .modal-left > ul > li").removeClass('active');
    $(this).addClass('active');
    $(".modal-user > form > .modal-right").hide();
    $(".modal-user > form > ."+name).show();
  });
  

  /**
   * スクロール設定反映
   * 
  **/
  $(document).on('submit',".modal-user form",function(event) {
        event.preventDefault();
  });

  $(document).on('click',".modal-user .user input[type='submit']",function(event){
        event.preventDefault();
        var allow = $(".modal-user .user input[name='allow_send_email']:checked").val();
        if(!allow) allow = 0;

        
    $.ajax({
      url: '//api.nagashi.me/user/update/general/',
      type: 'POST',
      data: {
        password         : $(".modal-user .user input[name='password']").val(),
        allow_send_email : allow,
        email            : $("#user-info").attr("data-email"),
        token            : $("#user-info").attr("data-token")
      }
    })
    .done(function (){
      hiddenModal();
    })

  });

  $(document).on('click',".modal-user .feed input[type='submit']",function(event){
        event.preventDefault();
        var getSpeed = parseInt($(".modal-user input[name='feed']").val());

    delay = getSpeed;
    hiddenModal();
    
    $.ajax({
      url: '//api.nagashi.me/user/update/scroll/',
      type: 'POST',
      data: {
        speed     : getSpeed,
        email     : $("#user-info").attr("data-email"),
        token     : $("#user-info").attr("data-token")
      }
    })
    .done(function (){
      hiddenModal();
    })
    
  });

});