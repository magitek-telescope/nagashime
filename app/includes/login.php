<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>ナガシミ</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="/res/css/style.css">
	<link rel="stylesheet" type="text/css" href="/app/res/css/login.css">
	<meta name="viewport" content="width=device-width">
	<style>#send_email{display: none;};</style>
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
		<nav>
			<a href="/" class="logoZone">
				<img src="/res/images/logo.png" width="32"><span>ナガシミ</span>
			</a>
			
			<a href="/app/register" class="login">ログイン</a>
		</nav>
	</header>

	<main>
		<section class="first-view">
			<video src="/res/images/video.mp4" autoplay loop></video>
			<img src="/res/images/video_image.png" class="spImage">
			<div class="main">
				<form method='post' action='./'>
				<table>
					<thead>
						<tr>
							<th colspan="2">
								<h1>ログイン</h1>
							</th>
						</tr>
					</thead>
					<tbody>

						<tr>
							<th>メールアドレス</th>
							<td><input type='email' name='email'></td>
						</tr>

						<tr>
							<th>パスワード</th>
							<td><input type='password' name='password'></td>
						</tr>

						<tr>
							<th>Login or Register</th>
							<td>
								<select name="type">
									<option selected="selected" value="login">ログイン</option>
									<option value="email">新規登録</option>
								</select>
							</td>
						</tr>

						<tr id="send_email">
							<th>お知らせメール受信</th>
							<td>
								<label><input type="checkbox" name="allow_send_email" value="1" checked="checked">許可する</label>
							</td>
						</tr>

						<tr>
							<td colspan="2">
								<?php if($error):?><span style="color:#ff8;display:block;"><?=$error?></span><br><?php endif;?>
								<input type='submit' value="Login">
							</td>
						</tr>
						
					</tbody>
				</table>
				</form>
			</div>
		</section>
	</main>

	<script src="/res/js/jquery.js"></script>
	<script src="/res/js/jquery.easing.js"></script>
	<script src="/app/res/js/login.js"></script>
</body>
</html>