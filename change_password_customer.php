<?php 
session_start();
include '_inc/dbconn.php';
        
if(!isset($_SESSION['customer_login'])) 
    header('location:index.php');   
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Change Password</title>
        
        <link rel="stylesheet" href="newcss.css">
        <style>
        .content_customer table,th,td {
    padding:6px;
    border: 1px solid #2E4372;
   border-collapse: collapse;
   text-align: center;
}
</style>
    </head>
        <?php include 'header.php' ?>
        <div class='content_customer'>
           <?php include 'customer_navbar.php'?>
            <div class="customer_top_nav">
             <div class="text">Welcome <?php echo $_SESSION['name']?></div>
            </div>

    <br><br><br><br>
    <h3 style="text-align:center;color:#2E4372;"><u>Change Password</u></h3>
            <form action="" method="POST">
                <table align="center">
                    <tr>
                        <td>Enter old password:</td>
                        <td><input type="password" name="old_password" required=""/></td>
                    </tr>
                    <tr>
                        <td>Enter new password:</td>
                        <td><input type="password" name="new_password" required=""/></td>
                    </tr>
                    <tr>
                        <td>Enter password again:</td>
                        <td><input type="password" name="again_password" required=""/></td>
                    </tr>
                    </table>
                    
                       <table align="center"><tr>
                        <td><input type="submit" name="change_password" value="Change Password" class="addstaff_button"/></td>
                    </tr>
                </table>
            </form>
            <?php
            $change=$_SESSION['login_id'];
            if(isset($_REQUEST['change_password'])){
            $sql="SELECT * FROM customer WHERE id='$change'";
            $result=mysqli_query($conn,$sql);
            $rws=  mysqli_fetch_array($result);
            
            $old=  mysqli_real_escape_string($conn,$_REQUEST['old_password']);
            $new=  mysqli_real_escape_string($conn,$_REQUEST['new_password']);
            $again=mysqli_real_escape_string($conn,$_REQUEST['again_password']);
            
            if($rws[9]==$old && $new==$again){
                $sql1="UPDATE customer SET password='$new' WHERE id='$change'";
                mysqli_query($conn,$sql1) or die(mysqli_error());
                header('location:customer_account_summary.php');
            }
            else{
                    echo "<script>alert('Wrong info provided');</script>";
            }
            }
            ?>
            
        </div>
        <?php include 'footer.php';?>