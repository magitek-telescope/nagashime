<?php
	require_once __DIR__."/../autoload.php";
	session_write_close();
	?>
Welcome to nagashi.me api.<br>
<?php var_dump($_SESSION);?>