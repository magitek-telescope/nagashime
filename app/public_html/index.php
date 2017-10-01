<?php
	require_once __DIR__."/../autoload.php";

	if(!loginManager::checkIsLogin()){
		header("Location: /app/register/");
	}else{
		loginManager::writeLoginLog($_SESSION["email"]);
	}

	$user = loginManager::getUserDetailFromAddress($_SESSION["email"]);

	$categoryManager = new categoryManager();
	$feedManager     = new feedManager();

	$getCategories = $categoryManager->getCategories(
		"user_id = :id", 
		array(
			"id"=>loginManager::getUserIdFromAddress($_SESSION["email"])
		)
	);

	$categories = array();
	foreach ($getCategories as $category) {
		$categories[$category["name"]]["id"] = $category["id"];
		$categories[$category["name"]]["sort"] = $category["sort"];
		$categories[$category["name"]]["feeds"] = array();

		$feeds = $feedManager->getFeeds(
			"category = :category and user = :user",
			array("category" => $category["id"], "user"=>$category["user"])
		);
		foreach ($feeds as $feed) {
			$categories[$category["name"]]["feeds"][] = $feed;
		}
	}
	
	include __DIR__."/../includes/header.php";
?>

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
	
	<main id="main"></main>

	<div class="modal">
		<?php include __DIR__."/../includes/modal_add_feed.php";?>
		<?php include __DIR__."/../includes/modal_add_category.php";?>
		<?php include __DIR__."/../includes/modal_edit_category.php";?>
		<?php include __DIR__."/../includes/modal_user.php";?>
		<?php include __DIR__."/../includes/modal_settings.php";?>
	</div>

	<div class="modal-background"></div>
	<script src="res/js/jquery.js"></script>
	<script src="res/js/jquery.easing.js"></script>
	<script src="res/js/functions.js"></script>
	<script src="res/js/load.js"></script>
	<script src="res/js/columns.js"></script>
	<script src="res/js/drawer.js"></script>
	<script src="res/js/modal.js"></script>
	<script src="res/js/iphone.js"></script>

	<?php if($_REQUEST["debug"] == "1"){print("<script src='res/js/debug.js'></script>");};?>

<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 938896764;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/938896764/?value=0&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

</body>
</html>