<h2>menüü</h2>
<ul>

	<?php if($page_file_name == "home.php"){ ?>
	<li>
		Home
	</li>
	<?php } else { ?>
	<li>
		<a href="home.php">Home</a>
	</li>
	<?php } ?>
	
	<?php
	//kontrollin mis lehega on tegu ja vastavalt kas trükin lingi või mitte
		if($page_file_name == "login.php"){
			echo '<li>Login</li>';
		}else{
			echo '<li><a href="login.php">Login</a></li>';
		}
	?>
</ul>