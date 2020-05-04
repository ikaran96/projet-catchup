
<!-----------------------------BIG POST ------------------------------>
<?php $req = $bdd ->prepare("SELECT * FROM T_Article");
            					$req->execute();
           						while($donnees = $req->fetch()){?>				
				<!-- row -->
				<div class="row">
					<div class="col-md-8">
						<div class="row">
							<!-- post -->
							<div class="col-md-12">
								<div class="post post-thumb">
									<a class="post-img" href="blog-post.php?id=<?php echo $donnees['id_article'];?> "><img src="assets/img/<?php echo $donnees['Images'];?>" alt=""></a>
									<div class="post-body">
										<div class="post-meta">
											<a class="post-category cat-3" href="category.html">Jquery</a>
											<span class="post-date"><?php echo $donnees['Date_article'];?></span>
										</div>
										<h3 class="post-title"><a href="blog-post.php?id=<?php echo $donnees['id_article'];?>"><?php echo $donnees['Titre'];?></a></h3>
									</div>
								</div>
							</div>
								   <?php }?>
							<!-- /post -->