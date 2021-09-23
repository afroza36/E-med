<?php 
	session_start();
	error_reporting(0);
	include('includes/config.php');

    if(strlen($_SESSION['login'])==0)
    {
        header('location:login.php');
    }

    $doctor_id = $_GET['pid'];
    $user_id = $_SESSION['id'];


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
                <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Doctor Name</th>
                            <th>Appointment DateTime</th>
                            <th>Serial</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $doc_id = $_SESSION['id'];
                            $date = date('Y-m-d');
                            // echo $doc_id;
                            $query = "SELECT * FROM appointment WHERE user_id = '$user_id' AND date(date_time) = '$date' ORDER BY date_time DESC";
                            // echo $query;
                            $result = mysqli_query($con, $query);
                            // print_r($result);
                            while($row = mysqli_fetch_array($result)){
                                $id = $row['id'];
                                $patient_id = $row['user_id'];
                                $doctor_id = $row['doctor_id'];
                                // echo $patient_id . " " . $doctor_id . " " . $id;
                                $appointment_date_time = $row['date_time'];
                                $serial = $row['serial'];
                                $query1 = "SELECT * FROM user WHERE id = '$patient_id'";
                                $result1 = mysqli_query($con, $query1);
                                $row1 = mysqli_fetch_array($result1);
                                $patient_name = $row1['name'];
                                $query2 = "SELECT * FROM doctors WHERE id = '$doctor_id'";
                                $result2 = mysqli_query($con, $query2);
                                $row2 = mysqli_fetch_array($result2);
                                $doctor_name = $row2['name'];
                                ?>
                        <tr>
                            <td><?php echo $patient_name;?></td>
                            <td><?php echo $doctor_name;?></td>
                            <td><?php echo $appointment_date_time;?></td>
                            <td><?php echo $serial;?></td>
                            <td><?php if($row['status']=='unpaid'){?>
                                <a href="pay_doctor_fee_checkout.php?id=<?php echo $id;?>&amount=<?php echo $row2['visit_fee']; ?>&user_id=<?php echo $id;?>">Pay Now</a>
                                <?php } else {?>
                                    <a href="<?php echo $row2['meet_link'];?>">Meet Link</a>
                                <?php }?>
                                </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table> 
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