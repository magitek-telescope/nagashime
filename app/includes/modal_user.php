
	<div class="modal-user">
		<h1>
			Settings<i class="fa fa-close fa-lg close"></i>
		</h1>

		<form>
			<div class="modal-left">
				<ul>
					<li class="active" data-name="user">User</li>
					<li data-name="feed">Feed</li>
					<li data-name="about">About</li>
				</ul>
			</div>

			<div class="modal-right user">
				<dl>
					<dt>メールアドレス</dt>
					<dd><?php echo $user["email"]?></dd>
				</dl>

				<dl>
					<dt>パスワード(変更時のみ入力)</dt>
					<dd><input type="password" name="password" value=""></dd>
				</dl>

				<dl>
					<dt>メール配信</dt>
					<dd>
						<input type="checkbox" name="allow_send_email" value="1" checked="checked" style="width:auto;">許可する<br>
					</dd>
				</dl>

				<input type="submit" class="button" value="Update User Setting">
			</div>

			<div class="modal-right feed">
				<dl>
					<dt>Speed</dt>
					<dd><input type="text" name="feed" placeholder="スクロール間隔(1000=1秒)"></dd>
				</dl>

				<input type="submit" class="button" value="Update Feed Setting">
			</div>

			<div class="modal-right about">
						<img src="//nagashi.me/app/res/images/logo_inverse.png" width="150" height="150"><br>
					</p>
					ナガシミ
				</h2>

				<p>
					Version 1.6.0<br>
					<span style="font-size:14px;">&copy; 2015 HANATANI TAKUMA(<a href="//twitter.com/potato4d" target="_blank">Potato4d</a>)</span>
				</p>
			</div>

			
		</form>
	</div>
