<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>

<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	<?php


// if($detact_mobile)
// {
// 	include 'includes/navbar-ar.php';
             
//  }
 //else
// {
// include 'includes/navbar.php';
// }


         if(isset($_SESSION['lang']))
               {
                   if ($_SESSION['lang']=="en") {
                      include 'includes/navbar.php';
                   }
                   else if($_SESSION['lang']=="ar")
                   {
                   	if($detact_mobile)
						{
						include 'includes/nav-ar-mob.php';
						     
						}else
						{
                      include 'includes/navbar-ar.php';							
						}

                   }
                }   


	  ?>
	 
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
	        		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		                <ol class="carousel-indicators">
		                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
		                  <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
		                  <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
		                </ol>
		                <div class="carousel-inner">
		                  <div class="item active">
		                  	<a href="category.php?category=Womens Fashion">
		                    <img src="images/wemens fashons.png" alt="Second slide">
		                    </a>
		                  </div>		                	
		                  <div class="item ">
		                  	<a href="category.php?category=Mens Fashion">
		                    <img src="images/mens fashons.png" alt="First slide">
		                    </a>
		                  </div>
		                  <div class="item">
		                  	<a href="category.php?category=Kids Fashion">
		                    <img src="images/kids fashons.png" alt="Third slide">
		                    </a>
		                  </div>
		                </div>
		                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
		                  <span class="fa fa-angle-left"></span>
		                </a>
		                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
		                  <span class="fa fa-angle-right"></span>
		                </a>
		            </div>
		            <h2 dir="<?php echo $lang['dir'] ?>"> <?php echo $lang['last added items'] ?></h2>
<?php
  include'includes/pageview.php';
  $visitors= new visitor_counter();
  $visitors->counter($pdo);
?>		            
		       		<?php
		       			$month = date('m');
		       			$conn = $pdo->open();

		       			try{
		       			 	$inc = 3;	
						    // $stmt = $conn->prepare("SELECT *, SUM(quantity) AS total_qty FROM details LEFT JOIN sales ON sales.id=details.sales_id LEFT JOIN products ON products.id=details.product_id WHERE MONTH(sales_date) = '$month' GROUP BY details.product_id ORDER BY total_qty DESC LIMIT 6");
                            $stmt = $conn->prepare("SELECT * FROM `products` WHERE stoke>0 ORDER BY id DESC LIMIT 6");						    
						    $stmt->execute();
						    foreach ($stmt as $row) {

                             if($row['stoke']>0){						    	
						    	$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
						    	$inc = ($inc == 3) ? 1 : $inc + 1;
	       						if($inc == 1) echo "<div class='row'>";
	       						echo "
	       							<a href='product.php?product=".$row['slug']."'><div class='col-sm-4'>
	       								<div class='box box-solid'>
		       								<div class='box-body prod-body'>
		       									<img src='".$image."' width='100%' height='230px' class='thumbnail'>
		       									<h5 dir='".$lang['dir']."'><a href='product.php?product=".$row['slug']."'>".$row['name']."</a></h5>
		       								</div>
		       								<div class='box-footer' dir='".$lang['dir']."'>
		       									<b>".number_format($row['price'], 2)." EGP</b>
		       								</div>
	       								</div>
	       							</div></a>
	       						";
	       						if($inc == 3) echo "</div>";

                               }
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
	        		<?php
				         if(isset($_SESSION['lang']))
				               {
				                   if ($_SESSION['lang']=="en") {
				        	          include 'includes/sidebar.php';
				                   }
				                   else if($_SESSION['lang']=="ar")
				                   {
				                      include 'includes/sidebar-ar.php';
				                   }
				                } 

	        		  ?>
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