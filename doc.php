<?php 
	session_start();
	error_reporting(0);
	include('includes/config.php');
	if(strlen($_SESSION['login'])==0)
		{   
		header('location:login.php');
	}

	if(isset($_GET['doctor_id'])){
		$doctor_id = $_GET['doctor_id'];
		$user_id = $_GET['user_id'];
		$sql = "INSERT into appointment(`doctor_id`,`user_id`) VALUES('$doctor_id','$user_id')";
		// echo $sql;
		// exit();
		$result = mysqli_query($con,$sql);
		echo $result;
		if($result){
			echo "<script>alert('Appointment successfully booked');</script>";
			header('location:doc.php');
		}
		else{
			echo "<script>alert('Appointment not booked');</script>";
			header('location:doc.php');
		}
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>E Med</title>
	<?php include('includes/links.php')?>
</head>

<body>
	<?php include('includes/header.php')?>

	<!-- Banner Start -->
	<section class="banner">
		<div class="container">
			<div class="row">
				<div class=" col-md-6 ">
					<div class="block">
						<h1 style="margin-top:50px; font-size:60px;">Upload Your Prescription And
							<span style="color:white; text-weight:bold;">Earn Money</span></h1>

						<p style="color:black;">We are providing you this opportunity to earn some money from online, if
							you have any prescription please upload it to our site and earn money.</p>

						<div class="btn-container mt-5">
							<a href="prescription.php" class="btn btn-primary">Upload Prescription <i
									class="icofont-simple-right "></i></a>
						</div>
					</div>
				</div>

			</div>
		</div>
	</section>
	<!-- Banner End -->

    <!-- Featured -->
	<section class="shop">
		<div class="col-md-12 mt-100" style="text-align:center; padding:50px;">
			<h1>Featured <span style="color:#E12454">Doctors</span></h1>
		</div>


		<div class="col-md-12">
			<div class="container">
				<div class="row">
					<?php
						$get_product="select * from doctors where 	featured='yes' order by featured_date DESC LIMIT 0,6 ";
						$run_products=mysqli_query($con,$get_product);
						
						while($row_product=mysqli_fetch_array($run_products)){
							
							$pro_id=$row_product['id'];
							$pro_title=$row_product['name'];
							$pro_price=$row_product['visit_fee'];
							$pro_company=$row_product['speciality'];
							$pro_img1=$row_product['imgpath'];
							$id = $_SESSION["id"];
						?>

					<div class='col-md-4' style='margin-bottom:30px;'>
						<div class='card' style='width: 18rem; text-align:center;'>
							<?php echo "<img class='card-img-top' src='doc/images/$pro_img1'  alt='Card image cap' style='width:250px; height:220px'>"
									 ?>
							<div class='card-body'>
								<h5 class='card-title'><?php echo $pro_title?></h5>
								<p> BDT <?php echo $pro_price?> </p>
								<?php
									echo "<a href='doctor_details.php?pid=$pro_id' class='btn btn-primary'>More Details</a>";
									echo"<a href='doc.php?doctor_id=$pro_id&user_id=$id' class='btn btn-primary' style='background-color:#222222'>Get Appointment</a>";
								?>
							</div>
						</div>
					</div>

					<?php	
						}							
					?>

				</div>
			</div>
		</div>

		<!-- Featured End -->


		<!-- New Products -->
		<div class="col-md-12 mt-100" style="text-align:center; padding:50px;">
			<h1>New <span style="color:#E12454">Doctors</span> </h1>
		</div>

		<div class="col-md-12">
			<div class="container">
				<div class="row">
					<?php
						$get_product="select * from doctors order by 1 DESC LIMIT 0,3 ";
						$run_products=mysqli_query($con,$get_product);
						
						while($row_product=mysqli_fetch_array($run_products)){
							
							$pro_id=$row_product['id'];
							$pro_title=$row_product['name'];
							$pro_price=$row_product['visit_fee'];
							$pro_company=$row_product['speciality'];
							$pro_img1=$row_product['imgpath'];
							$id = $_SESSION["id"];
						?>

					<div class='col-md-4' style='margin-bottom:30px;'>
						<div class='card' style='width: 18rem; text-align:center;'>
							<?php echo "<img class='card-img-top' src='doc/images/$pro_img1'  alt='Card image cap' style='width:250px; height:220px'>"
									 ?>
							<div class='card-body'>
								<h5 class='card-title'><?php echo $pro_title?></h5>
								<p> BDT <?php echo $pro_price?> </p>
								<?php
									echo "<a href='doctor_details.php?pid=$pro_id' class='btn btn-primary'>More Details</a>";
									echo"<a href='doc.php?doctor_id=$pro_id&user_id=$id' class='btn btn-primary' style='background-color:#222222'>Get Appointment</a>";
								?>


							</div>
						</div>
					</div>

					<?php	
						}							
					?>

				</div>
			</div>
		</div>
		<!-- NEW End -->
	</section>

	<!-- Shop End -->

	<!--Scripts -->
	<?php include('includes/scripts.php')?>


</body>

</html>