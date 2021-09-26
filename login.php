<?php 
    session_start();
    error_reporting(0);
	include('includes/config.php');

    // Login Code
    if(isset($_POST['login']))
    {
        $email=$_POST['email'];
        $password=md5($_POST['password']);
        $query=mysqli_query($con,"SELECT * FROM user WHERE email='$email' and password='$password' and status='0'");
        $num=mysqli_fetch_array($query);

        if($num>0)
        {
            $_SESSION['login']=$_POST['email'];
            $_SESSION['id']=$num['id'];
            $_SESSION['name']=$num['name'];
            $_SESSION['p']=$num['point'];
                      
            header("location:index.php");
            exit();
        }else{
            $email=$_POST['email'];
            $_SESSION['errmsg']="Invalid email id or password";
            header("location:login.php");

            // Email Check
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL))
                {
                $emailErr = "Invalid email format";
                }
                                    
            header("location:index.php");
            exit();
        }

    }


?>

<!DOCTYPE html>
<html lang="en">
<head>    
    <title>E Med - User Login</title>
    <?php include('includes/links.php')?>    
</head>
<body>
    <!-- Header Start-->
    <header>
	<div class="header-top-bar">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-8">
					<ul class="top-bar-info list-inline-item pl-0 mb-0">

						<?php if(strlen($_SESSION['login']))
							{
						?>
						<li class="list-inline-item">
							<!-- User Name Will be shown here -->
							| Welcome - <?php echo $_SESSION['name']?>
						</li>
						<?php } ?>
						<li class="list-inline-item">
							| <a href="mycart.php"><i class="icofont-cart"></i> My cart</a>
						</li>
						<li class="list-inline-item">
							| <a href="wishlist.php"> <i class="icofont-heart"></i> Wishlist</a>
						</li>
						<?php if(strlen($_SESSION['login'])==0) 
							{   ?>
						<li class="list-inline-item">
							| <a href="doc/"><i class="icofont-login"></i> Doctors login</a>
						</li>
                        <li class="list-inline-item">
							| <a href="pharma/login.php"><i class="icofont-login"></i> Pharma Company login</a>
						</li>
                        <li class="list-inline-item">
							| <a href="admin/"><i class="icofont-login"></i> Admin login</a>
						</li>
						<?php }
							else{ ?>
						<li class="list-inline-item">
							| <a href="my-account.php"><i class="icofont-user"></i> My Account
							</a>
						</li>
						<li class="list-inline-item">
							| <a href="logout.php"><i class="icofont-logout"></i> Logout </a>
						</li>
						<?php } ?>
					</ul>
				</div>
				<div class="col-lg-4">
					<div class="text-lg-right">
						<?php if(strlen($_SESSION['login']))
								{
									$query=mysqli_query($con,"SELECT user.point AS balance
									FROM prescriptions JOIN user ON user.id = prescriptions.user_id
									WHERE prescriptions.status=1 AND user.id='".$_SESSION['id']."'");
									$row=mysqli_fetch_array($query);
							?>
						<span><i class="icofont-money"></i> Current Balance: &nbsp; </span>
						<?php echo $row['balance'] ? $row['balance'] : 0 ?> <span>BDT</span>
						<?php }
								
							?>
					</div>
				</div>

			</div>
		</div>
	</div>
	<nav class="navbar navbar-expand-lg" id="navbar">
		<div class="container">
			<a class="navbar-brand" href="index.php">
				<h1><span style="color:#E12454">E</span> MED</h1>
			</a>
			
			

			<div class="navbar">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a class="nav-link" href="index.php">Home</a>
					</li>
					<li class="nav-item"><a class="nav-link" href="#">About Us</a></li>
					<li class="nav-item"><a class="nav-link" href="prescription.php">Upload Prescription</a></li>
					<li class="nav-item"><a class="nav-link" href="#">Buy Prescription</a></li>
					<li class="nav-item"><a class="nav-link" href="doc.php">Doctors</a></li>		 
					<li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
				</ul>
			</div>

			<form class="form-inline" name="search" method="post" action="product_search.php">
					<input class="form-control mr-sm-2" type="search" name="medicine" placeholder="Search"
						aria-label="Search">
					<button class="btn btn-outline-primary my-2 my-sm-0 sr" type="submit">
						<i class="icofont icofont-search"></i>
					</button>
			</form>	
		</div>
	</nav>
</header>
    <!-- Header End -->




    <!-- Login Form -->
    <div class="global-container">
        <div class="card login-form">
        <div class="card-body">
            <h3 class="card-title text-center">Login To E Med</h3>
            <div class="card-text">                
              
                <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post">
                    <div class="" role="alert" style="background-color: #F8D7DA; color:black; padding:5px 5px 5px 5px;">
                        <?php
                            echo htmlentities($_SESSION['errmsg']);
                        ?>
                        <?php
                            echo htmlentities($_SESSION['errmsg']="");
                        ?>
                    </div>
                    <!-- to error: add class "has-danger" -->
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control form-control-sm" id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <a href="recover_email.php" style="float:right;font-size:12px;">Forgot password?</a>
                        <input type="password" name="password" class="form-control form-control-sm" id="exampleInputPassword1">
                    </div>
                    <button type="submit" style="background-color: #223A66; color: aliceblue;" class="btn btn-block" name="login">Sign in</button>
                    
                    <div class="sign-up">
                        Don't have an account? <a href="signup.php">Create One</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    

    <!-- Login Form End -->

    
    <?php include('includes/scripts.php')?>
    
</body>
<!-- Footer  -->
<?php include('includes/footer.php')?> 
<!-- Footer End -->
</html>