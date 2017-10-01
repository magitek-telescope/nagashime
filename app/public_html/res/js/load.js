var feedHtml = (function () {/*
    <li data-feed-id="%%feedId%%">
      <span width="80" height="80" alt="eyecatch" class="loadingArticleImage" data-getURL="%%articleLink%%"></span>

      <div>
        <a data-articleURL="%%articleLink%%" target="_blank" class="article-link">%%articleTitle%%</a>

        <p class="social">
          <a><i class="fa fa-facebook-square fa-sm"></i></a>
          <a><i class="fa fa-twitter-square fa-sm"></i></a>
          <a><i class="fa fa-get-pocket fa-sm"></i></a>
          <a><i class="fa fa-envelope fa-sm"></i></a>
        </p>
      </div>
    </li>
  */}).toString().replace(/(\n)/g, '').split('*')[1];

var columnHtml = (function () {/*
    <section class="column container" data-id="-1" data-sort="-1">
      <header>
        <h1 data-name=""></h1>
        <a class="more"><i class="fa fa-chevron-down fa-lg"></i></a>
      </header>

      <main>
        <nav class="column-menu">
          <i class="fa fa-chevron-left  fa-lg left "></i>
          <i class="fa fa-chevron-right fa-lg right"></i>

          <i class="fa fa-close fa-lg close"></i>
          <i class="fa fa-pencil-square-o edit"></i>
        </nav>
        
        <ul data-timer="0" data-ishover="0"></ul>
      </main>
    </section>
  */}).toString().replace(/(\n)/g, '').split('*')[1];

  function makeColumn(data){
    
    $("#main").css({
      opacity:"1.0",
      width: "10px"
    });

    $.each(data, function(categoryName, val) {
      var category = this;
      var categorySelector = ".column[data-id=-1] ";

      $("#main").append(columnHtml);
      $(categorySelector + "> header h1").attr("data-name", categoryName).text(categoryName);

      $(categorySelector).attr({
        "data-sort": category.sort,
        "data-id"  : category.id
      });

      $("#main").css({
        width: (parseInt($("#main").width()) + 312) + "px"
      });

      $.each(category.feeds, function(index, val) {
        var feed = this;
        (function (feed) {
          $.ajax({
            url: '//api.nagashi.me/feed/get/articles/',
            type: 'POST',
            data: {
              email     : $("#user-info").attr("data-email"),
              token     : $("#user-info").attr("data-token"),
              feed      : feed.url
            }
          })
          .done(function(articles) {
            $.each(articles, function() {
              var article = this;
              var template = feedHtml
                .replace( /%%articleLink%%/g , $.htmlspecialchars(article.link ) )
                .replace( /%%feedId%%/g      , $.htmlspecialchars(feed.id      ) )
                .replace( /%%articleTitle%%/g, $.htmlspecialchars(article.title) );
              $(".column[data-id="+category.id+"] main ul").append(template);
            });

          });
        }(feed));
      });
    });

    setTimeout( "loadArticleImage()", 1000);
    // setInterval("loadArticleImage()", 5000);
  }

  $(document).ready(function (){
    $.ajax({
      url: '//api.nagashi.me/category/get/',
      type: 'POST',
      data: {
        email     : $("#user-info").attr("data-email"),
        token     : $("#user-info").attr("data-token")
      }
    }).done(function (data){
      makeColumn(data);
    });

  });