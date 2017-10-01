
	<nav class="drawer-menu" data-open="0">
		<ul>
			<li>
				<a><img src="res/images/logo.png" width="32"><span>ナガシミ</span></a>
			</li>

			<li>
				<a class="add-feed">Add Feed</a>
			</li>

			<li>
				<a class="add-category">Add Category</a>
			</li>

			<li>
				<a class="user"><?=h($user["email"])?></a>
				<div id="user-info" data-token="<?=$user["token"]?>" data-email="<?=h($user["email"])?>" style="display:none" data-scroll="<?=h($user["scroll"])?>"></div>
			</li>
			
			<li>
				<a class="logout" href="register/?type=logout">Logout</a>
			</li>
		</ul>
	</nav>