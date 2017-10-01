<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, maximum-scale=1.0, minimum-scale=1.0, initial-scale=1.0,minimal-ui">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">

  <link rel="shortcut icon" href="/res/images/icon.png">
  <link rel="apple-touch-icon" href="/res/images/icon.png">
  
  <title>ナガシミ</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.css">
  <link rel="stylesheet" type="text/css" href="res/css/style.css">
</head>
<body>
  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-63818166-5', 'auto');
    ga('send', 'pageview');
  </script>
  <header>
    <a href="/app/">
      <img src="res/images/logo.png" width="32"><span>ナガシミ</span>
    </a>

    <nav>
      <ul>
        <li class="menu-button add-feed">
          <span id="button-feed"></span>

          <p class="description">
            購読したいWebサイトのRSSから<br>
            フィードの追加を行います。
          </p>
        </li>

        <li class="menu-button add-category">
          <span id="button-folder"></span>

          <p class="description">
            新規カテゴリを追加します。
          </p>
        </li>

        <li class="drawer-button">
          <span id="hamburger"></span>
        </li>
      </ul>
    </nav>
  </header>
