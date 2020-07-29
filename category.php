
<?php include 'includes/session.php'; ?>
<?php
	$slug = $_GET['category'];

	$conn = $pdo->open();

	try{
		$stmt = $conn->prepare("SELECT * FROM category WHERE cat_slug = :slug");
		$stmt->execute(['slug' => $slug]);
		$cat = $stmt->fetch();
		$catid = $cat['id'];
	}
	catch(PDOException $e){
		echo "There is some problem in connection: " . $e->getMessage();
	}

	$pdo->close();

?>

<?php
  include'includes/pageview.php';
  $visitors= new visitor_counter($pdo);
    $visitors->counter($pdo);
?>

<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	<?php
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
<style type="text/css">
@import url(http://fonts.googleapis.com/earlyaccess/lateef.css);
.arabicfont{
font-family: ‘ Lateef’, serif;
}
</style>	 
	  <div class="content-wrapper" >
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-9" >
	        		<?php
	        		 if ($_SESSION['lang']=="en") {
	        		 	echo '<h1 class="page-header">'.$cat['name'].'</h1>';
	        		 }
                   else if($_SESSION['lang']=="ar")
                   {
                        echo '<h1 class=" arabicfont" dir="rtl">'.$cat['ar-name'].'</h1>';
                   }	        		 
	        		?>
		            
		       		<?php
		       			
		       			$conn = $pdo->open();

		       			try{
		       			 	$inc = 3;	
						    $stmt = $conn->prepare("SELECT * FROM products WHERE category_id = :catid");
						    $stmt->execute(['catid' => $catid]);
						    foreach ($stmt as $row) {

                              if($row['stoke']>0){
						    	$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
						    	$inc = ($inc == 3) ? 1 : $inc + 1;
	       						if($inc == 1) echo "<div class='row'>";
	       						echo "
	       							<a href='product.php?product=".$row['slug']."'><div class='col-sm-4' style='float: ".$lang['float'].";'>
	       								<div class='box box-solid'>
		       								<div class='box-body prod-body'>
		       									<img src='".$image."' width='100%' height='230px' class='thumbnail'>
		       									<h5><a href='product.php?product=".$row['slug']."'>".$row['name']."</a></h5>
		       								</div>
		       								<div class='box-footer'>
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