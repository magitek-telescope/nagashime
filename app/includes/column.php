<?php
/**
 * $categoryについて
 * 
 * $category["id"] -> id
 * $category["sort"] -> sort id
 * $category["feeds"] -> array
 * $category["feeds"][?] -> string(URL)
**/
/*
		<section class="column container" data-id="<?php echo $category["id"];?>" data-sort="<?php echo $category["sort"]; ?>">
			<header>
				<h1 data-name="<?=h($name)?>"><?php
				if (mb_strlen($name, "UTF-8") >= 9) {
					print(h(mb_substr($name, 0, 8, "UTF-8") . "…"));
				}else{
					print(h($name));	
				}
				?></h1>

				<a class="more"><i class="fa fa-chevron-down fa-lg"></i></a>

			</header>

			<main>
				<nav class="column-menu">
					<i class="fa fa-chevron-left  fa-lg left "></i>
					<i class="fa fa-chevron-right fa-lg right"></i>

					<i class="fa fa-close fa-lg close"></i>
					<i class="fa fa-pencil-square-o edit"></i>
				</nav>
				<ul data-timer="0">
					<?php 
					foreach ($category["feeds"] as $key => $site):
						$feed = simplexml_load_file($site["url"], 'SimpleXMLElement', LIBXML_NOCDATA);
						include __DIR__."/articles.php";
					endforeach;
					?>
				</ul>
			</main>
		</section>*/