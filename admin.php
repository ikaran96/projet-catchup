
<?php
session_start();
if($_SESSION['Admin'] ==1){

?>

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
		<link type="text/css" rel="stylesheet" href="assets/css/bootstrap.min.css"/>

		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">

		<!-- Custom stlylesheet -->
        <link type="text/css" rel="stylesheet" href="assets/css/style.css"/>
        <link rel="stylesheet" type="text/css" href="pell-master/dist/pell.css">
        <style>
      body {
        margin: 0;
        padding: 0;
      }

      .content {
        box-sizing: border-box;
        margin: 0 auto;
        max-width: 600px;
        padding: 20px;
      }

      #html-output {
        white-space: pre-wrap;
      }
    </style>

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
    <div class="main">

<section class="signup">
    <!-- <img src="images/signup-bg.jpg" alt=""> -->
    <div class="container">
        <div class="signup-content">
            <form method="POST" id="signup-form" action="traitement/add-article.php">
                <h2 class="form-title">Ajouter un article</h2>
                <div class="form-group">
                    <input type="text" class="form-input" name="article-title" id="article-title" placeholder="Titre"/>
                </div>
                <div class="form-group">
                    <textarea name="contenu-article" id="contenu-article" cols="30" rows="10"></textarea>
                </div>
                <label for="pp-profil">Photo article</label>
                <div class="form-group">
                    <input type="file" class="form-input" name="article-photo" id="article-photo"/>
            
                </div>            
               
                <div class="form-group">
                    <input type="submit" name="submit" id="submit" class="form-submit" value="Poster"/>
                </div>
            </form>
        </div>
    </div>
</section>

</div>
<?php include 'include/footer.php';?>
</body>
</html>

    <?php }else{
      header('location:index.php');} ?>