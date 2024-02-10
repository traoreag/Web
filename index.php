<?php

include 'core/core.php';

$_TITRE_PAGE = 'Accueil projet RS ESEO';

//session_start();

if (isset($_POST['connexion_submit']) && $_POST['connexion_submit'] == 1) { //on détecte que l'action vient du bouton de la connexion
	//si mail et pwd sont renseignés
	if (!empty($_POST['mail']) && !empty($_POST['password'])) {
		//créer la requête pour avoir l'étudiant
		$mail_escaped = $mysqli->real_escape_string(trim($_POST['mail']));
		$password_escaped = $mysqli->real_escape_string(trim($_POST['password']));

		$sql = "SELECT	id
				FROM	Etudiant
				WHERE	email 		= '" . $mail_escaped . "'
				AND		motDePasse	= '" . $password_escaped . "'";

		// $sql_insert =   "INSERT INTO Etudiant(prenom) VALUES ('".$prenom."')";

		//exécuter la requête
		$result = $mysqli->query($sql);

		//vérifier qu'il y a un résultat et si oui compte = id de l'étudiant
		if (!$result) {
			exit($mysqli->error);
		}
		$nb = $result->num_rows;

		if ($nb) {
			//récupération de l'id de l'étudiant
			$row = $result->fetch_assoc();

			$_SESSION['compte'] = $row['id'];
		}
	}
}

$ERR_INS = "";

// inscription
if (!empty($_POST['inscription_submit'])) {

	if (
		!empty($_POST['inscription_email']) &&
		!empty($_POST['inscription_nom']) &&
		!empty($_POST['inscription_prenom']) &&
		!empty($_POST['inscription_password']) &&
		!empty($_POST['inscription_anneeScolaire']) &&
		!empty($_POST['inscription_password_confirmation'])
	) {

		// test mdp et confirm identique
		if ($_POST['inscription_password'] != $_POST['inscription_password_confirmation'])
			$ERR_INS = "Le mot de passe et sa confirmation sont différents.";

		if (!$ERR_INS) {

			$sql = "  SELECT	*
							FROM	Etudiant
							WHERE	email = '" . $mysqli->real_escape_string(trim($_POST['inscription_email'])) . "'
						";
			//exécuter la requête
			$result = $mysqli->query($sql);

			//vérifier qu'il y a un résultat et si oui compte = id de l'étudiant
			if (!$result) {
				exit($mysqli->error);
			}

			// si déjà un résultat on génère l'erreur à afficher
			if ($result->num_rows)
				$ERR_INS = "Cet email est déjà pris.";
			else {


				$sql = "  INSERT INTO	Etudiant
							SET			email 			= '" . $mysqli->real_escape_string(trim($_POST['inscription_email'])) . "',
										moytDePasse		= '" . $mysqli->real_escape_string(trim($_POST['inscription_password'])) . "',
										nom				= '" . $mysqli->real_escape_string(trim($_POST['inscription_nom'])) . "',
										prenom			= '" . $mysqli->real_escape_string(trim($_POST['inscription_prenom'])) . "',
										anneeScolaire	= '" . $mysqli->real_escape_string(trim($_POST['inscription_anneeScolaire'])) . "',
										description		= '',	
										dateIns			= NOW(),
										dateModif		= NOW()
						";
				//var_dump($sql);
				$mysqli->query($sql);

				if($mysqli->error)	exit($mysqli->error);

				$id_compte = mysqli_insert_id($mysqli);
				if ($id_compte) {

					$_SESSION['compte'] = $id_compte;
				} // si compte cree

			} // email pas déjà pris

		} // ! ERR

	} elseif (count($_POST)) {
		$ERR_INS = "Vous devez saisir obligatoirement tous les champs pour vous inscrire.";
	}
}


/* if (!empty($_GET['logout']) && $_GET['logout'] == 1) {
		unset($_SESSION['compte']);
		header('Location: ./');
	}*/
?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Rajdhani:wght@300;400;500;600;700&display=swap');
	</style>

	<title><?php echo $_TITRE_PAGE; ?></title>
</head>

<body>
	<!-- HEADER -->
	<div class="">
		<?php include('_header.php') ?>
	</div>


	<?php
	if (empty($_SESSION['compte'])) {
	?>
		<div class="section-summary  text-white">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h2 class="text-center mt-5 mb-5">Bienvenue sur RS ESEO</h2>
						<div class="row">
							<div class="col-lg-6 col-md-12 mb-3">
								<div class="section-light block" id="login">

									<form class="text-center p-4" method="post">
										<p class="h4 mb-4">Connexion</p>
										<p class="mb-0">
											<label for="mail">Email</label>
											<input id="mail" name="mail" type="text" class="form-control mb-4">

										</p>
										<p class=" mb-0">
											<label for="defaultLoginFormPassword">Mot de passe</label>
											<input name="password" type="password" id="defaultLoginFormPassword" class="form-control mb-4">

										</p>
										<button name="connexion_submit" value="1" class="btn  btn-mdb-color btn-block mt-4 mb-0" type="submit">Connexion</button>
									</form>
								</div>
							</div>
							<div class="col-lg-6 col-md-12 ">
								<div class="section-light-secondary block">
									<?php if ($ERR_INS) { ?>
										<div class="p-4">
											<p class="alert red text-white"><?php echo $ERR_INS ?></p>
										</div>
									<?php } ?>
									<form class="text-center  p-4" method="post" name="form_inscription">
										<p class="h4 mb-4">Inscription</p>
										<p class=" mb-0">
											<label for="inscription_nom">Nom</label>
											<input name="inscription_nom" id="inscription_nom" type="text" required class="form-control mb-4" value="" autocomplete="new-nom">

										</p>
										<p class=" mb-0">
											<input name="inscription_prenom" id="inscription_prenom" type="text" required class="form-control mb-4" value="" autocomplete="new-prenom">
											<label for="inscription_prenom">Prenom</label>
										</p>

										<p class=" mb-0">
											<label for="inscription_anneeScolaire" class="active">Année Scolaire</label>
											<select name="inscription_anneeScolaire" id="inscription_anneeScolaire" required class="mb-4">
												<?php
												$query_as = $mysqli->query("SELECT * FROM AnneeScolaire ORDER BY idAnneeScolaire ASC");
												while ($anneScolaire = $query_as->fetch_object()) {
												?>
													<option value="<?php echo $anneScolaire->idAnneeScolaire ?>"><?php echo $anneScolaire->nom ?></option>
												<?php
												}
												?>
											</select>

										</p>
										<p class=" mb-0">
											<input name="inscription_email" id="inscription_email" type="email" required class="form-control mb-4" value="" autocomplete="new-email">
											<label for="inscription_email">Email</label>
										</p>
										<p class=" mb-0">
											<input name="inscription_password" id="inscription_password" required type="password" class="form-control mb-4" value="" autocomplete="new-password">
											<label for="inscription_password">Mot de passe</label>
										</p>
										<p class=" mb-0">
											<input name="inscription_password_confirmation" type="password" required id="inscription_password_confirmation" class="form-control mb-4" value="" autocomplete="new-password">
											<label for="inscription_password_confirmation">Confirmez votre password</label>
										</p>

										<button name="inscription_submit" class="btn btn-mdb-color btn-block mt-4 mb-0" type="submit" value="1">Inscription</button>
									</form>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>

	<?php
	} else {
	?>
		<div>
			<!--<h2>Vous êtes connecté ! <?php echo $_SESSION['compte']; ?></h2>-->
			<?php include('article.php'); ?>
			
		</div>
		<!--//TODO afficher nom etu - cf core.php-->
		<!--<a href="http://192.168.56.80/pwnd?logout=1">Se déconnecter</a>-->
		<!--<a href="http://192.168.56.80/pwnd/notifications.php">notification</a>-->
	<?php
	}
	?>

</body>
<footer>
	<?php $mysqli->close();
	?>
</footer>

</html>