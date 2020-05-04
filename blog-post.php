<?php
session_start();
include('include/bdd.php');?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>CATCH UP</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:700%7CNunito:300,600" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="assets/css/bootstrap.min.css" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="assets/css/style.css" />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>

<body>
	<?php
include 'include/header.php';?>

	<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- Post content -->
				<div class="col-md-8">
					<div class="section-row sticky-container">
						<div class="main-post">
							<?php
							$id=$_GET['id'];
							$req = $bdd ->prepare("SELECT * FROM T_Article WHERE id_article=" . $id);
            					$req->execute();
           						while($donnees = $req->fetch()){?>
							<h3><?php echo $donnees['Titre'];?></h3>
							<figure class="figure-img">
								<img class="img-responsive" src="assets/img/<?php echo $donnees['Images'];?>" alt="">
							</figure>
							<p><?php echo $donnees['Contenue'];?></p>
						</div>
						<div class="post-shares sticky-shares">
							<a href="#" class="share-facebook"><i class="fa fa-facebook"></i></a>
							<a href="#" class="share-twitter"><i class="fa fa-twitter"></i></a>
							<a href="#" class="share-google-plus"><i class="fa fa-google-plus"></i></a>
							<a href="#" class="share-pinterest"><i class="fa fa-pinterest"></i></a>
							<a href="#" class="share-linkedin"><i class="fa fa-linkedin"></i></a>
							<a href="#"><i class="fa fa-envelope"></i></a>
						</div>
					</div>

					<!-- ad -->
					<div class="section-row text-center">
						<a href="#" style="display: inline-block;margin: auto;">
							<img class="img-responsive" src="./img/ad-2.jpg" alt="">
						</a>
					</div>
					<!-- ad -->

					<!-- author -->
					<div class="section-row">
						<div class="post-author">
							<div class="media">
								<div class="media-left">
									<img class="media-object" src="assets/img/author.png" alt="">
								</div>
								<div class="media-body">
									<div class="media-heading">
									<?php

							$pseudo = $bdd ->prepare("SELECT * FROM T_User WHERE id_user=" . $donnees['id_user']);
            				$pseudo->execute();
           					while($auteur = $pseudo->fetch()){?>
										<h3><?php echo $auteur['Pseudo'];?></h3>
							   <?php } ?>
							   <?php } ?>
									</div>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
										incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
										nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
									</p>
									<ul class="author-social">
										<li><a href="#"><i class="fa fa-facebook"></i></a></li>
										<li><a href="#"><i class="fa fa-twitter"></i></a></li>
										<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
										<li><a href="#"><i class="fa fa-instagram"></i></a></li>
									</ul>
								</div>
							</div>
						</div>
						<?php if(isset($_SESSION['Admin'])){?>
						<a href="traitement/archiver-art.php?id=<?php echo $_GET['id'];?>">Archiver l'article</a><?php } ?>
					</div>
					<!-- /author -->

					<!-- comments -->
					<div class="section-row">
						<div class="section-title">
							<h2>Commentaires</h2>
						</div>

						<div class="post-comments">
							<!-- comment -->
							<div class="media">
								<div class="media-left">
									<img class="media-object" src="assets/img/avatar.png" alt="">
								</div>
								<div class="media-body">
									<div class="media-heading">
									<?php 
									$req2=$bdd->prepare("SELECT*FROM T_Commentaires");
									$req2->execute();
									$comm=$req2->fetch();
									$auteur=$bdd->prepare("SELECT * FROM T_User WHERE id_user=" . $comm['id_user']);
									$auteur->execute();
									$pseudo=$auteur->fetch();
									?>
										<h4><?php echo $pseudo['Pseudo'];?></h4>
										<span class="time"><?php echo $comm['Date_comm'];?></span>
										<?php 
										if(isset($_SESSION['Admin'])){?>
										<a href="#" class="reply">Supprimer</a><?php }?>
										<?php 
										if(isset($_SESSION['Mod'])){?>
										<a href="#" class="reply">Supprimer</a><?php }?>
									</div>
									<p><?php echo $comm['Commentaire'];?>
									</p>
									<!-- /comment -->
								</div>
							</div>
							<!-- /comment -->


						</div>
					</div>
					<!-- /comments -->
					<!-- reply -->
					<div class="section-row">
						<div class="section-title">
							<h2>Leave a reply</h2>
							<?php if(isset($_SESSION['Pseudo'])) { ?>
						</div>
						<form method ="POST" class="post-reply" action="traitement/commentaire.php">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<textarea class="input" name="commentaire" placeholder="Message"></textarea>
									</div>
									<button class="primary-button">Submit</button>
								</div>
							</div>
						</form>
					</div>
					<!-- /reply -->
				</div>
				<!-- /Post content -->

				<?php } else{
					echo "<a href='signin/signin.php'>Se connecter </a> pour commenter";
				} ?>


			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->

	<?php include 'include/footer.php';?>

	<!-- jQuery Plugins -->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/main.js"></script>

</body>

</html>