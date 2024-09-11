<?php 
include('form_script.php');
include_once('operations.php'); 


$name = "";
$contact = "";
$gender = "all";
$is_disable = "all";


$db = new operations();
$resl='';

if (isset($_GET['load'])) 
{
    $resl = $db->Filter_Record($_GET);
        
}

if(isset($_SESSION['reportRec']))
{
    
    $name = $_SESSION['reportRec']['name'];
    $contact = $_SESSION['reportRec']['contact'];
    $gender = $_SESSION['reportRec']['gender'];
    $is_disable = $_SESSION['reportRec']['is_disable'];
    unset($_SESSION['reportRec']);

}

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet"  href="My.css">
    <title>
       Reports
    </title>
   
</head>
<body>
    <table class="table2">
        <form action="report.php" class="form2" method="get">
            <tr  style="background-color: black;">
                <td>
                    <label style="color: white;">Gender</label>
                </td>
                <td colspan="2">
                    <select name="gender" >
                    <option selected="" value="all" <?php echo ($gender=='all')?'selected':'' ?>>All</option>
                        <option value="male" <?php echo ($gender=='male')?'selected':'' ?>>Male</option>
                        <option value="female" <?php echo ($gender=='female')?'selected':'' ?> >Female</option>
                        <option value="others" <?php echo ($gender=='others')?'selected':'' ?> >Others</option>
                    </select>
                </td>
                <td>

                    <label  style="color: white;">Is Disable</label>
                </td>
                <td colspan="2">
                    <select name = "is_disable">
                        <option selected="" value="all" <?php echo ($is_disable=='all')?'selected':'' ?>>All</option>
                        <option value="1" <?php echo ($is_disable=='1')?'selected':'' ?> >Yes</option>
                        <option value="No" <?php echo ($is_disable=='No') ?'selected':'' ?>>No</option>

                    </select>
                </td>
            </tr>

            <tr style="background-color: black;">
                <td>
                    <label  style="color: white;">Name</label>
                </td>
                <td colspan="2">
                    <input type="textfield" name="name"  value="<?php echo $name ?>" placeholder="Search By Name">
                </td>
                <td>
                    <label  style="color: white;">Phone</label>
                </td>
                <td colspan="2">
                    <input  type="text" name="contact"  value="<?php echo $contact ?>" placeholder="Search By Phone Number">
                </td>
            </tr>
            <tr  style="background-color: black;">
                <td colspan="3">
                    <a  class="btn btn-blue btn-left" href="form.php">Manage User</a>
                </td>
                <td colspan="3">
                    <button class="btn btn-blue btn-right" type="submit" name="load" >Load</button>
                </td>
            </tr>
        </form>
    </table>


<?php 
    if($resl!=''){
?>
    <div class="container2"> 
    
    <table >

        <tr>
            <th>SrNo.</th>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Current Address</th>
            <th>Gender</th>
            <th>Course</th>
            <th>Is Disable</th>
        </tr>

        <?php $i = 1;
         while($row = mysqli_fetch_array($resl)){
        ?>

        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['password']; ?></td>
            <td><?php echo $row['contact']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td><?php echo $row['current_address']; ?></td>
            <td><?php echo $row['gender'] ;?></td>
            <td><?php echo $row['use_course']; ?></td>
            <td><?php if($row['is_disable'] == '1')
            {$dis = "Yes"; }
            else{$dis = "No";}
            echo $dis; ?></td>
            
            
        </tr>
        <?php
        $i++;
        }
        ?>
      
   
    </table>

</div>
<?php 
}?>

</body>
</html>