<div class="row">
	<div class="box box-solid">
	  	<div class="box-header with-border" dir="<?php echo $lang['dir'] ?>">
	    	<h3 class="box-title" ><b><?php echo $lang['category'] ?></b></h3>
	  	</div>
	  	<div class="box-body">
	  		<ul  dir="<?php echo $lang['dir'] ?>">
	  		<?php

	  			$conn = $pdo->open();

	  			$stmt = $conn->prepare("SELECT * FROM category");
	  			$stmt->execute();
	  			foreach($stmt as $row){
	  				echo "<li><a style='font-size: 17px;' href='category.php?category=".$row['cat_slug']."'>".$row['ar-name']."</a></li>";
	  			}

	  			$pdo->close();
	  		?>
	    	<ul>
	  	</div>
	</div>
</div>

<!-- <div class="row">
	<div class="box box-solid">
	  	<div class="box-header with-border">
	    	<h3 class="box-title"><b>Become a Subscriber</b></h3>
	  	</div>
	  	<div class="box-body">
	    	<p>Get free updates on the latest products and discounts, straight to your inbox.</p>
	    	<form method="POST" action="">
		    	<div class="input-group">
	                <input type="text" class="form-control">
	                <span class="input-group-btn">
	                    <button type="button" class="btn btn-info btn-flat"><i class="fa fa-envelope"></i> </button>
	                </span>
	            </div>
		    </form>
	  	</div>
	</div>
</div>

<div class="row">
	<div class='box box-solid'>
	  	<div class='box-header with-border'>
	    	<h3 class='box-title'><b>Follow us on Social Media</b></h3>
	  	</div>
	  	<div class='box-body'>
	    	<a class="btn btn-social-icon btn-facebook"><i class="fa fa-facebook"></i></a>
	    	<a class="btn btn-social-icon btn-twitter"><i class="fa fa-twitter"></i></a>
	    	<a class="btn btn-social-icon btn-instagram"><i class="fa fa-instagram"></i></a>
	    	<a class="btn btn-social-icon btn-google"><i class="fa fa-google-plus"></i></a>
	    	<a class="btn btn-social-icon btn-linkedin"><i class="fa fa-linkedin"></i></a>
	  	</div>
	</div>
</div> -->

<div class="row">
	<div class="box box-solid">
	<div class='box-body '>
		   <img src='images/gallery_1238643393.jpg' width='100%' height='230px' class='thumbnail'>			
	</div>
</div>
</div>

<div class="row">
	<div class="box box-solid">
	<div class='box-body '>
		   <img src='images/gallery_1238643393.jpg' width='100%' height='230px' class='thumbnail'>			
	</div>
</div>
</div>