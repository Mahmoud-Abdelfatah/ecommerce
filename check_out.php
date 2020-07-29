<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php
  if(!isset($_SESSION['user'])){
    header('location: login.php');
  }

 
?>

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

	@media
	  only screen 
    and (max-width: 760px), (min-device-width: 768px) 
    and (max-device-width: 1024px)  {

		/* Force table to not be like tables anymore */
		table, thead, tbody, th, td, tr {
			display: block;
		}

		/* Hide table headers (but not display: none;, for accessibility) */
		thead tr {
			position: absolute;
			top: -9999px;
			left: -9999px;
		}

    tr {
      margin: 0 0 1rem 0;
    }
      
    tr:nth-child(odd) {
      background: #ccc;
    }
    
		td {
			/* Behave  like a "row" */
			border: none;
			border-bottom: 1px solid #eee;
			position: relative;
			padding-left: 50%;
		}

		td:before {
			/* Now like a table header */
			position: absolute;
			/* Top/left values mimic padding */
			top: 0;
			left: 6px;
			width: 45%;
			padding-right: 10px;
			white-space: nowrap;
		}
	 </style>
	  <div class="content-wrapper">
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-9">
	        		<h1 class="page-header" dir="<?php echo $lang['dir'] ?>"><?php echo $lang['your cart'] ?></h1>
	        		<div class="box box-solid">
	        			<div class="box-body">
		        		<table class="table table-bordered">
		        			<thead >
		        				<th></th>
		        				<th style="text-align: center;"><?php echo $lang['Photo'] ?></th>
		        				<th style="text-align: center;"><?php echo $lang['Name'] ?></th>
		        				<th style="text-align: center;"><?php echo $lang['Price'] ?></th>
		        				<th width="20%" style="text-align: center;"><?php echo $lang['Quantity'] ?></th>
		        				<th style="text-align: center;"><?php echo $lang['Subtotal'] ?></th>
		        			</thead>
		        			<tbody id="tbody">
		        			</tbody>
		        		</table>
	        			</div>
							<div class="box box-solid" >
							  	<div class="box-header with-border" dir="<?php echo $lang['dir'] ?>">
							    	<h3 class="box-title"><b><?php echo $lang['Shipping Address'] ?></b></h3>
							  	</div>
							  	<div class="box-body" dir="<?php echo $lang['dir'] ?>">
							  		<p><label> <?php echo $lang['city']?> : </label></label><?php if (isset($_SESSION['user']))
							    	{
							    		echo $user['user_city'];
							    	}
							    	?></p>
							    	<p><label> <?php echo $lang['address']?> : </label></label><?php if (isset($_SESSION['user']))
							    	{
							    		echo $user['address'];
							    	}
							    	?></p>
							    	<p><label> <?php echo $lang['phone']?> : </label></label><?php if (isset($_SESSION['user']))
							    	{
							    		echo $user['contact_info'];
							    	}
							    	?></p>							    	
							  	</div>
							</div>        			
	        		</div>
	        		<?php
	        			if(isset($_SESSION['user'])){
	        				 $id = 'OR-'.time().uniqid();
	        				echo "
	        						        		<div style='margin-bottom: 10px;'><a href='sales.php?pay=".$id."' class='btn btn-success' value='' id='checkout-btn'>".$lang['Check Out']."</a>
	        						        		<a href='cart_view.php' class='btn btn-primary' value=''>".$lang['Back']."</a></div>	        						        		
	        				";
	        			}
	        			else{
	        				echo "
	        					<h4>You need to <a href='login.php'>Login</a> to checkout.</h4>
	        				";
	        			}
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
  	<?php $pdo->close(); ?>
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
<script>
var total = 0;
$(function(){
	$(document).on('click', '.cart_delete', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		$.ajax({
			type: 'POST',
			url: 'cart_delete.php',
			data: {id:id},
			dataType: 'json',
			success: function(response){
				if(!response.error){
					getDetails();
					getCart();
					getTotal();
				}
			}
		});
	});

	$(document).on('click', '.minus', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		var qty = $('#qty_'+id).val();
		if(qty>1){
			qty--;
		}
		$('#qty_'+id).val(qty);
		$.ajax({
			type: 'POST',
			url: 'cart_update.php',
			data: {
				id: id,
				qty: qty,
			},
			dataType: 'json',
			success: function(response){
				if(!response.error){
					getDetails();
					getCart();
					getTotal();
				}
			}
		});
	});

	$(document).on('click', '.add', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		var qty = $('#qty_'+id).val();
		qty++;
		$('#qty_'+id).val(qty);
		$.ajax({
			type: 'POST',
			url: 'cart_update.php',
			data: {
				id: id,
				qty: qty,
			},
			dataType: 'json',
			success: function(response){
				if(!response.error){
					getDetails();
					getCart();
					getTotal();
				}
			}
		});
	});

	getDetails();
	getTotal();

});

function getDetails(){
	$.ajax({
		type: 'POST',
		url: 'cart_details.php',
		dataType: 'json',
		success: function(response){
			$('#tbody').html(response);
			getCart();

			if (response) {
				$('#checkout-btn').unbind('click')
			}else
			{
				response+='<tr><td colspan="5" align="right"><b><?php echo $lang['total'] ?></b></td><td><b>00.00 EGP</b></td><tr>';
				$('#checkout-btn').removeAttr('href');

			}
						$('#tbody').html(response);
		}
	});
}

function getTotal(){
	$.ajax({
		type: 'POST',
		url: 'cart_total.php',
		dataType: 'json',
		success:function(response){
			total = response;
		}
	});
}
</script>
<!-- Paypal Express -->
<script>
paypal.Button.render({
    env: 'sandbox', // change for production if app is live,

	client: {
        sandbox:    'ASb1ZbVxG5ZFzCWLdYLi_d1-k5rmSjvBZhxP2etCxBKXaJHxPba13JJD_D3dTNriRbAv3Kp_72cgDvaZ',
        //production: 'AaBHKJFEej4V6yaArjzSx9cuf-UYesQYKqynQVCdBlKuZKawDDzFyuQdidPOBSGEhWaNQnnvfzuFB9SM'
    },

    commit: true, // Show a 'Pay Now' button

    style: {
    	color: 'gold',
    	size: 'small'
    },

    payment: function(data, actions) {
        return actions.payment.create({
            payment: {
                transactions: [
                    {
                    	//total purchase
                        amount: { 
                        	total: total, 
                        	currency: 'USD' 
                        }
                    }
                ]
            }
        });
    },

    onAuthorize: function(data, actions) {
        return actions.payment.execute().then(function(payment) {
			window.location = 'sales.php?pay='+payment.id;
        });
    },

}, '#paypal-button');
</script>
</body>
</html>	