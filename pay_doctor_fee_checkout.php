<?php 
	session_start();
	error_reporting(0);
	include('includes/config.php');

    if(strlen($_SESSION['login'])==0)
    {
        header('location:login.php');
    }

    $amount = $_GET['amount'];
    $id = $_GET['id'];
    $userid = $_GET['user_id'];

    if(isset($_POST['submit'])){
        $id = $_POST['id'];
        $amount = $_POST['amount'];
        $ref_id = $_POST['ref_id'];
        $ref_type = 'user';
        $remark = ' User Doctor Fee';
        $date = date('Y-m-d');
        $sql = "INSERT INTO `fees`(`fee_amount`, `ref_type`, `ref_id`, `remark`) VALUES ('$amount','$ref_type','$ref_id','$remark')";
        print($sql);
        
        $query = mysqli_query($con,$sql);
        print_r($query);
        if($query){
            $sql = "UPDATE `appointment` SET `status`='paid' WHERE `id`='$id'";
            $query = mysqli_query($con,$sql);
            echo "<script>alert('Fee added successfully');</script>";
            header('location:pay_doctor_fee.php');
        }
    }

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
                        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post">
                            <input type = "hidden" name = "amount" value = "<?php echo $amount;?>">
                            <input type = "hidden" name = "id" value = "<?php echo $id;?>">
                            <input type = "hidden" name = "ref_id" value = "<?php echo $userid;?>">
                            <img src="https://www.logo.wine/a/logo/BKash/BKash-Icon2-Logo.wine.svg"
                                class="rounded float-left" alt="..." height="200px" width="200px" ;>
                            <input type="radio" name="paymethod" value="bkash" checked="checked"> Bkash

                            <img src="https://www.logo.wine/a/logo/Nagad/Nagad-Vertical-Logo.wine.svg" class="rounded"
                                alt="..." height="200px" width="200px">
                            <input type="radio" name="paymethod" value="Nagad"> Nagad


                            <hr>

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