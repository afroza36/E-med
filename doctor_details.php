<?php 
	session_start();
	error_reporting(0);
	include('includes/config.php');	

    $pid=intval($_GET['pid']);
    // echo $pid;
?>
<style>
    h5 {
        font-family: Helvetica, sans-serif !important;
    }
</style>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>E Med</title>
    <?php include('includes/links.php')?>
</head>

<body>
    <?php include('includes/header.php')?>

    <div class="container">
        <div class="row">
            <br>
            <div class="col-md-12 mt-100" style="text-align:center; padding:20px; margin-bottom:20px;">
                <h1>Doctor <span style="color:#E12454">Details</span></h1>
            </div>
            <hr>
            <div class="clear"></div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <?php 
                $get_product="select * from doctors where id='$pid'";
                $run_products=mysqli_query($con,$get_product);
                
                while($row_product=mysqli_fetch_array($run_products)){
                    $pro_id=$row_product['id'];
                    $pro_title=$row_product['name'];
                    $pro_price=$row_product['visit_fee'];
                    $pro_company=$row_product['speciality'];
                    $pro_img1=$row_product['imgpath'];
                    $visiting_start=$row_product['chamber_time_start'];
                    $visiting_end=$row_product['chamber_time_end'];
                    $meet_link = $row_product['meet_link'];
                    $id = $_SESSION["id"];       
                ?>

            <div class="col-md-5" style="border: 1px solid #E5E5E5">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <?php echo "<img class='d-block w-100' src='doc/images/$pro_img1'  alt='First slide'>"?>
                        </div>
                    </div>
                </div>
            </div>
            

            <div class="col-md-6" style="border: 1px solid #E5E5E5; margin-left:10px;  padding:20px;">
                <h2 style="text-align:center; color: #223A66;"><?php echo $pro_title?></h2>
                <div class="row">
                    <div class="col-md-5">
                        <h5 style="color:#666666">Speciality:</h5>
                    </div>
                    <div class="col-md-7">
                        <?php 
                            echo "$pro_company";
                        ?>
                    </div>

                    <div class="col-md-5">
                        <h5 style="color:#666666">Visiting Fee:</h5>
                    </div>
                    <div class="col-md-7">
                        <?php 
                            echo "$pro_price BDT";
                        ?>
                    </div>

                    <div class="col-md-12">
                        <hr style="color:#666666">
                    </div>

                    <div class="col-md-5">
                        <h5 style="color:#666666">Chember Time:</h5>
                    </div>
                    <div class="col-md-7">
                        <?php 
                            echo "$visiting_start - $visiting_end";
                        ?>
                    </div>

                    <div class="col-md-5">
                        <h2 style="color:#E12454; margin-top:30px;">
                            <?php 
                                echo "$pro_price BDT";
                            ?>
                        </h2>
                    </div>

                    <div class="col-md-12">
                        <a href='pay_doctor_fee.php?pid=<?php echo $pro_id;?>&&action=getlink' class='btn btn-primary' style='background-color:#E12454'> Get Link </a> 
                    </div>

                </div>
            </div>

            <?php } ?>
        </div>
    </div>

    <!--Scripts -->
    <?php include('includes/scripts.php')?>


</body>

</html>
