<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php
  include'includes/pageview.php';
  $visitors= new visitor_counter($pdo);
    $visitors->counter($pdo);
?>
<style>


	.text,  textarea {
		width: 100%;
		padding: 12px;
		border: 1px solid #ccc;
		border-radius: 4px;
		box-sizing: border-box;
		margin-top: 6px;
		margin-bottom: 16px;
		resize: vertical;
	}

	input[type=submit] {
		background-color: #4CAF50;
		color: white;
		padding: 12px 20px;
		border: none;
		border-radius: 4px;
		cursor: pointer;
	}

	input[type=submit]:hover {
		background-color: #45a049;
	}

	.contact {
		border-radius: 5px;

		padding: 20px;
	}
</style>
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
		<div class="content-wrapper">
			<div class="container contact" style="padding-top: 0px;">
				<!-- Main content -->
				<section class="content">
				   <form action="action_page.php">
				   	<div class="row">
				   		<div class="col-sm-8" style="margin-right: 30px;padding-top: 10px;padding-bottom: 10px;background-color: white; margin-bottom: 10px;">
					<div class="row">
						<div class="col-md-6 offset-md-3">
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


								<label for="fname">First Name</label>
								<input type="text" id="fname" name="firstname" placeholder="Your name.." class="text" required>


						</div>
						<div class="col-md-6 offset-md-3">
								<label for="lname">Last Name</label>
								<input type="text" id="lname" name="lastname" placeholder="Your last name.." class="text" required>						
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 offset-md-3">
								<label for="email">Email</label>
								<input type="email" id="email" name="email" placeholder="Your Email" class="text" required>
	
						</div>	
						<div class="col-md-6 offset-md-3">
								<label for="country">City</label>
								<input type="text" id="city" name="city" placeholder="Your City" class="text" required>
	
						</div>	
					</div>	
					<div class="row">
						<div class="col-md-6 offset-md-3">
								<label for="subject">Subject</label>
								<textarea id="subject" name="subject" placeholder="Write something.." style="height:200px" required></textarea>

							
						</div>
					    <div class="col-md-6 offset-md-3">
								<label for="email">Phone</label>
								<input type="text" id="phone" name="phone" placeholder="phone" class="text" required>						
					     </div>							
					</div>	
													<input type="submit" value="Submit">			   			
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

							</form>			
				</section>
			</div>	
		</div>  

		<?php include 'includes/footer.php'; ?>	  	
	</div>	
	<?php include 'includes/scripts.php'; ?>
</body>
</html>