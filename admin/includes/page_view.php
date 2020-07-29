<?php

class visitor_counter 
{
	
	 public function counter($pdo)
	{
      //include '../includes/conn.php';	

      $conn = $pdo->open();
	  $visitor_ip=$_SERVER['REMOTE_ADDR'];
       try{
      	$stmt = $conn->prepare("SELECT COUNT(*) AS numrows  FROM counter where ip_address =:visitor_ip  ");
      	$stmt->execute(['visitor_ip'=>$visitor_ip]);
      	$row = $stmt->fetch();
      	if($row['numrows'] < 1){
        $new_visitor = $conn->prepare("INSERT INTO counter (ip_address) value(:visitor) ");     
	    $new_visitor->execute(['visitor'=>$visitor_ip]);
      	}

      }
      	catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
	 }



	 $pdo->close();	
     		
	}
}






?>


<!-- <!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		.wrapper{
			height: :300px;
			width: 300px;
			background-color: skyblue;
			margin: auto;
			text-align: center;
			border: 1px solid white;
			box-shadow: 2px 2px 10px gray;
		}
		h1{
			background-color: mediumseagreen;
			color: white;
			border-bottom: 2px solid white;
		}

		h3{
			font-size: 5em;
		}
		h1,h3{
			padding: 20px;
			margin: 0px;
		}
	</style>
</head>
<body>
	<div class="wrapper">
		<h1>
			Vistor Counter
		</h1>
		<h3></h3>
	</div>
</body>
</html> -->