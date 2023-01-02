<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	 
	  <div class="content-wrapper">
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-9">
	        		<?php
	        			if(isset($_SESSION['error'])){
	        				echo "
	        					<div class='alert alert-danger'>
	        						".$_SESSION['error']."
	        					</div>
	        				";
	        				unset($_SESSION['error']);
	        			}
	        		?>
					<style>
						.image-size{
							width: 1200px;
							height:500px;
							border:solid black 1px;
							border-radius:10px;
							margin-top:100px;
						}
						.tapsilog{
							margin-top:50px;
							height:500px;
							width:270px;
							margin-left:20px;
							border:solid black 1px;
							border-radius:10px;
							
						}
						p{
							text-align:center;
							font-size:25px;
						}
						
					</style>
	        		<div class="container">
						<div class="row">

							<div class="col-4">
								<a href=""><img src="images/tias.jpg" alt="" class="img-responsive image-size"></a>
							</div>

							<div style="margin-top:80px;">
								<h1><b>We Offer:</b></h1>
							</div>
							<div style="display:inline-block">
								<img src="images/tapsilog.jpg" alt="" class="tapsilog"><p>Foods</p>
							</div>

							<div style="display:inline-block">
								<img src="images/chocolate-coffee.jpg" alt="" class="tapsilog"><p>Coffee</p>
							</div>

							<div style="display:inline-block">
								<img src="images/dener.jpg" alt="" class="tapsilog"><p>Dinner</p>
							</div>

							<div style="display:inline-block">
								<img src="images/dessert.jpg" alt="" class="tapsilog"><p>Desert</p>
							</div>
							<!-- <div class="col-3 mt-3">
                				<div class="card" style="width: 18rem;">
                    				<img class="card-img-top" src="images/tapsilog.jpg" alt="Card image cap" >
                    					<div class="card-body">
                      						<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    					</div>
                				</div>
            				</div>

							<div class="col-3 mt-3">
                				<div class="card" style="width: 18rem;">
                    				<img class="card-img-top" src="images/tapsilog.jpg" alt="Card image cap" >
                    					<div class="card-body">
                      						<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    					</div>
                				</div>
            				</div>

							<div class="col-3 mt-3">
                				<div class="card" style="width: 18rem;">
                    				<img class="card-img-top" src="images/tapsilog.jpg" alt="Card image cap" >
                    					<div class="card-body">
                      						<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    					</div>
                				</div>
            				</div> -->

						</div>
					</div>

					
					<div style="margin-top:70px;">
						<h1><b>Shop Location:</b></h1>
					</div>
					<div style="margin-top: 50px; border:solid black .5px; border-radius:15px; height:500; width:1404px;margin-right:800px;">
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3870.2280861187737!2d121.31068991518185!3d14.063704390146214!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd5cd331db1e2d%3A0xb407071b7055d358!2sTia&#39;s%20Caf%C3%A9!5e0!3m2!1sen!2sph!4v1661258557000!5m2!1sen!2sph" width="1400" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" style="margin-right:50px;"></iframe>
					</div>
		           
		       		<?php
		       			$month = date('m');
		       			$conn = $pdo->open();

		       			try{
		       			 	$inc = 3;	
						    $stmt = $conn->prepare("SELECT *, SUM(quantity) AS total_qty FROM details LEFT JOIN sales ON sales.id=details.sales_id LEFT JOIN products ON products.id=details.product_id WHERE MONTH(sales_date) = '$month' GROUP BY details.product_id ORDER BY total_qty DESC LIMIT 6");
						    $stmt->execute();
						    foreach ($stmt as $row) {
						    	$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
						    	$inc = ($inc == 3) ? 1 : $inc + 1;
	       						if($inc == 1) echo "<div class='row'>";
	       						echo "
	       							<div class='col-sm-4'>
	       								<div class='box box-solid'>
		       								<div class='box-body prod-body'>
		       									<img src='".$image."' width='100%' height='230px' class='thumbnail'>
		       									<h5><a href='product.php?product=".$row['slug']."'>".$row['name']."</a></h5>
		       								</div>
		       								<div class='box-footer'>
		       									<b>&#36; ".number_format($row['price'], 2)."</b>
		       								</div>
	       								</div>
	       							</div>
	       						";
	       						if($inc == 3) echo "</div>";
						    }
						    if($inc == 1) echo "<div class='col-sm-4'></div><div class='col-sm-4'></div></div>"; 
							if($inc == 2) echo "<div class='col-sm-4'></div></div>";
						}
						catch(PDOException $e){
							echo "There is some problem in connection: " . $e->getMessage();
						}

						$pdo->close();

		       		?> 
	        	</div>
	        	<div class="col-sm-3">
	        		<?php include 'includes/sidebar.php'; ?>
	        	</div>
	        </div>
	      </section>
	     
	    </div>
	  </div>
  
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
</body>
</html>