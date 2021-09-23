<?php 
	session_start();
	error_reporting(0);
	include('includes/config.php');

    if(strlen($_SESSION['login'])==0)
    {
        header('location:login.php');
    }

    $amount = $_GET['amount'];
    $ref_type = $_GET['ref_type'];
    $ref_id = $_GET['ref_id'];
    $remark = $_GET['remark'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>E Med | My accout</title>
 	<?php include('includes/links.php')?>

</head>

<body id="top">	
	<?php include('includes/header.php')?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12 mt-100" style="text-align:center; padding:50px;">
                    <h1>Payment <span style="color:#E12454">Method</span></h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-2">

            </div>
            <div class="col-md-8">
                <div class="card text-center">
                    <div class="card-header">
                        Select Your Payment Method
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <img src="https://www.logo.wine/a/logo/BKash/BKash-Icon2-Logo.wine.svg"
                                class="rounded float-left" alt="..." height="200px" width="200px" ;>
                            <input type="radio" name="paymethod" value="bkash" checked="checked"> Bkash

                            <img src="https://www.logo.wine/a/logo/Nagad/Nagad-Vertical-Logo.wine.svg" class="rounded"
                                alt="..." height="200px" width="200px">
                            <input type="radio" name="paymethod" value="Nagad"> Nagad


                            <hr>

                            <img src="https://5.imimg.com/data5/NX/QH/SF/SELLER-78615388/cash-on-delivery-jpg-500x500.jpg"
                                class="rounded" alt="..." height="200px" width="200px">
                            <input type="radio" name="paymethod" value="Cash on Delivery"> COD

                            <img src="https://cdn4.iconfinder.com/data/icons/money-filled-outline/64/money-colored-15-512.png"
                                class="rounded" alt="..." height="200px" width="200px">
                            <input type="radio" name="paymethod" value="Your Point"> Your Point
                            <br>
                            <input type="submit" name="submit" class="btn btn-primary">
                        </form>
                    </div>
                    <div class="card-footer text-muted">

                    </div>
                </div>
            </div>
            <div class="col-md-2">

            </div>
        </div>
    </div>

    <br>
    <br>

<!-- Footer Start -->
<?php include('includes/footer.php')?>   
<!-- Footer End -->

 <!--     Essential Scripts    -->
 <?php include('includes/scripts.php')?> 
    

</body>
</html>