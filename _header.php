<div class="home ">
	<nav class="mb-1 navbar navbar-expand-lg navbar-dark header-color">
		<!-- Navbar brand -->

		<a class="navbar-brand" href="my.eseo.fr"><img src="img/medias/eseo_logo_white.png" height="50" /> </a>
		<!-- Collapse button -->
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav" aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
		<!-- Collapsible content -->
		<div class="collapse navbar-collapse" id="basicExampleNav">
			<!-- Links -->
			<?php
			if (!empty($_SESSION['compte'])) {
			?>
			<ul class="navbar-nav mr-auto ml-md-4">
				<li class="nav-item active"> <a class="rounded py-3 px-4 nav-link" href="/pwnd"> Accueil</a></li>
				
				<!--<a class="navbar-brand" href="http://192.168.56.80/pwnd/notifications.php"><img src="img/medias/Notification.png" height="35" /> </a>
				
				<li class="nav-item"> <a class="rounded py-3 px-4 nav-link" href="http://192.168.56.80/pwnd?logout=1"> Se Déconnecter</a></li>-->
			</ul>
			<ul class="navbar-nav ml-auto ml-md-4">
				<a class="rounded py-3 px-4 nav-link" href="http://192.168.56.80/pwnd/notifications.php"><img src="img/medias/notification.png" height="35" /></a>
				<a class="rounded py-3 px-4 nav-link" href="http://192.168.56.80/pwnd/profil.php"><img src="img/medias/profil.png" height="35" /></a>
				<a class="rounded py-3 px-4 nav-link" href="http://192.168.56.80/pwnd?logout=1"><img src="img/medias/sortir.png" height="35" /></a>
			</ul>
			<?php
			}
			?>
		</div>
	</nav>
</div>