<?php 
include('form_script.php');
include_once('operations.php'); 
$edit_state = false;
$name = "";
$email= "";
$password = "";
$password2 = "";
$contact = "";
$address = "";
$current_address = "";
$gender = "";
$use_course = "";
$is_disable = "";
$id = 0;


$db = new operations();

$resl = $db-> View_Record();
if (isset($_POST['submit'])) 
{
    $db->Store_Record($_POST);
    
}
elseif(isset($_POST['update']))
{
    $db->Update($_POST);
  
}
elseif(isset($_POST['delete']))
{
    {
        $db-> Delete_Selected_Records($_POST);
        header('Location: form.php');
    }
}
else
{
    if(isset($_GET['del']))
    {
        $idd = $_GET['del'];
        $db->Delete_Record($idd);
        header('Location: form.php');
    }
   
}

//validation result$_POST
if(isset($_SESSION['record']))
{
    $edit_state = $_SESSION['record']['edit'];
    $id = $_SESSION['record']['id'];
    $name = $_SESSION['record']['name'];
    $email= $_SESSION['record']['email'];
    $password = $_SESSION['record']['password'];
    $password2 = $_SESSION['record']['password2'];
    $contact = $_SESSION['record']['contact'];
    $address = $_SESSION['record']['address'];
    $current_address = $_SESSION['record']['current_address'];
    $gender = $_SESSION['record']['gender'];
    $use_course = $_SESSION['record']['use_course'];
    $is_disable = $_SESSION['record']['is_disable'];
    unset($_SESSION['record']);

}


//fetch records to edit
if(isset($_GET['edit']))
{
    $id = ($_GET['edit']);
    $rec = $db-> Get_Record($id);
    
    $edit_state = true;
    $record = mysqli_fetch_array($rec);
    $name = $record['name'];
    $email= $record['email'];
    $password = $record['password'];
    $password2 = $record['password'];
    $contact = $record['contact'];
    $address = $record['address'];
    $current_address = $record['current_address'];
    $gender = $record['gender'];
    $use_course = $record['use_course'];
    $is_disable = $record['is_disable'];
    $id = $record['id'];
}

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet"  href="My.css">
    <title>
        My Form
    </title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="validation.js"></script>
    <script type="text/javascript" src="select_all.js"></script>
</head>
<body>
  
   
    <form action="form.php" method="post" id="registration" name='registration'  onsubmit="return formValidation()"  >
        <h5 class="danger">
        <?php if(isset($_SESSION['submit_result']))
        {
            $result_session = $_SESSION['submit_result'];
            echo $result_session;
            unset($_SESSION['submit_result']);

        }?>

        </h5>
        <h1>Manage User</h1>

        <input type="hidden" name="id" value="<?php echo $id ?>" >

        <div class="border">
            <div class="row">
               
                <label> Name:</label>
                <input type="text" name="name" placeholder="Enter Your Name" value="<?php echo $name ?>">
                <div id = "errorN" class="danger"></div>
                
                  
                <?php if ((isset($_SESSION['error']))&& (($_SESSION['error']['name']) == '1'))
                {?>
                <label class="danger">*required and name in atleast 3 alphabets</label>
                <?php
               
                 } 
                
                ?>
              
               
                
            </div>
            <br>
    
            <div class="row">
       
                <label> Email:</label> 
                <input type="email" name="email" placeholder="Enter Your Email" value="<?php echo $email ?>">
                <div id = "errorE" class="danger"></div>
                <?php if ((isset($_SESSION['error']))&& (($_SESSION['error']['email']) == '2'))
                {?>
                <label class="danger">*required and enter valid email</label>
                <?php
                
                 } 
                
                ?>
                
                

            </div>
            <br>

            <div class="row">
        
                <label> Password:</label>
                <input type="password" name="password" id="myInput" placeholder="Enter Your Password" value="<?php echo $password ?>">
                <div id = "errorP" class="danger"></div>
                <?php if ((isset($_SESSION['error']))&& (($_SESSION['error']['password']) == '3'))
                {?>
                <label class="danger">*required and consists of atleast 8 characters</label>
                <?php
              
                 } 
                
                ?>
                
       
            </div>
            <br>

            <div class="row">
       
                <label> Confirm Password:</label>
                <input type="password" name="password2" id="myInput2" placeholder="Confirm Password" value="<?php echo $password2 ?>">
                <div id = "errorP2" class="danger"></div>
                <div id = "errorPC" class="danger"></div>
                <?php if ((isset($_SESSION['error']))&& (($_SESSION['error']['conf']) == '4'))
                {?>
                <label class="danger">*required and consists of atleast 8 characters</label>
                <?php
               
                 } 
                
                ?>

                <?php if ((isset($_SESSION['error']))&& (($_SESSION['error']['confP']) == '5'))
                {?>
                <label  class="danger">Password Didn't match</label>
                <?php
               
                 } 
                
                ?>
                
        
            </div>
            <br>

            <div class="row">
            
                <input type="checkbox" onclick="myFunction()"  >
                <b class="size"> Show Password:</b>

            </div>
            <br>

            <div class="row">
       
                <label> Contact Number:</label>
                <input type="text" name="contact" placeholder="Enter Your Phone Number" value="<?php echo $contact ?>">
                <div id = "errorCT" class="danger"></div>
                <?php if ((isset($_SESSION['error']))&& (($_SESSION['error']['phone']) == '6'))
                {?>
                <label class="danger">*required and consists of 11 numbers</label>
                <?php
                
                 } 
                
                ?>
        
            </div>
            <br>

            <div class="row">
        
                <label> Address:</label>
                <input type="text" id="address" name="address" placeholder="Enter Your Address" value="<?php echo $address ?>">
                <div id = "errorAD" class="danger"></div>
                <?php if ((isset($_SESSION['error']))&& (($_SESSION['error']['address']) == '7'))
                {?>
                <label class="danger">*required</label>
                <?php
                
                 } 
                
                ?>
        
            </div>
            <br>


            <div class="row">
        
                <label> Current Address:</label>
                <input type="text" id="current_address" name="current_address" placeholder="Enter Your Current Address" value="<?php echo $current_address ?>">
                <div id = "errorAD2" class="danger"></div>
                <?php if ((isset($_SESSION['error']))&& (($_SESSION['error']['address']) == '10'))
                {?>
                <label class="danger">*required</label>
                <?php
                
                 } 
                
                ?>
        
            </div>
            <div class="row">
            
                <input type="checkbox" id="same" name="same" onclick="addressFunction()" >
                <b class="size"> Same As Above:</b>

            </div>
            <br>

            <div class="row">
        
                <label class="bolder"> Gender:</label>

                <label > male      
                    <input style="margin-left: 19px;" type="radio" name="gender" id="male" value="male" <?php echo ($gender =='male')?'checked':'' ?> >
                </label>
             
                <label >Female
                    <input type="radio" name="gender" id="female" value="female" <?php echo ($gender=='female')?'checked':'' ?> >
                </label>
        
   
                <label>Others
                    <input type="radio" name="gender" id="others" value="others" <?php echo ($gender=='others')?'checked':'' ?> >
                </label> 
                <div id = "errorG" class="danger"></div>
                
                <?php if ((isset($_SESSION['error']))&& (($_SESSION['error']['gender']) == '8'))
                {?>
                <label class="danger">*required</label>
                <?php
               
                 } 
                
                ?>
            </div>
            <br>

            <div class="row">
           
                <label> Use Course:</label>
                     
                <select name="use_course" >
                    <option selected="" value="Default">(Please select a Course)</option>
                    <option value="HTML" <?php echo ($use_course=='HTML')?'selected':'' ?>>HTML</option>
                    <option value="CSS"  <?php echo ($use_course=='CSS')?'selected':'' ?>>CSS</option>
                </select>
                <div id = "errorU" class="danger" ></div>
                <?php if ((isset($_SESSION['error']))&& (($_SESSION['error']['course']) == '9'))
                {?>
                <label class="danger">*required</label>
                <?php
                
                 } 
                
                ?>
         
            </div>
            <br>

            <div class="row">
            
                <label>Disable:      
                    <input type="checkbox" name="is_disable" value="1"  <?php echo ($is_disable =='1')?'checked':'' ?>>
                </label>
                <div id = "errorD" class="danger"></div>
                <?php if ((isset($_SESSION['error']))&& (($_SESSION['error']['dis']) == '10'))
                {?>
                <label class="danger">*required</label>
                <?php
               
                 } 
                 unset($_SESSION['error']);               
                ?>
            
            </div>

            <div class="center">
                <div class="row">
                    <?php if($edit_state == false)
                    { ?>
                        <button class="btn" type="submit" name="submit" >Submit</button>
                    <?php } ?>

                    <?php if($edit_state == true)
                    { ?>
                        <button class="btn" type="submit" name="update" >Update</button>
                    <?php } ?>

                    <a  class="btn" style="color: white;" href="report.php">Back</a>
            </div>
                </div>
        </div>
    </form>
    
    
    <div class="container"> 
    
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
                <th>Edit</th>
                <th>Delete </th>
                <th >
                <input type="checkbox" name="checkAll" class="checkAll"/>All
                </th>
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
                
                <td>
                    <a class="abtn btn-green"  href="form.php?edit=<?php echo $row['id']; ?> ">
                       Edit
                    </a>
                </td>
                <td>
                    
                <a class="abtn btn-danger" href="form.php?del=<?php echo $row['id']; ?> "  onclick="return confirmSubmit()">
                   Delete
                </a>
            
                </td>
            <form method="post" action="form.php">
                <td>
                <input class="checkboxes" type="checkbox" name="users[]" value="<?php echo $row["id"]; ?>">
                </td>
                
            </tr>
            <?php
            $i++;
            }
            ?>
          
            <tr>
                <td colspan="11"></td>
                <td  style="text-align:center"><input class=" bg_blue" type="submit" name="delete" value="delete"  onclick="return confirmSubmit()"></td>
            </tr>
            </form>
       
        </table>
   
    </div>
   


</body>
</html>

<script>
    if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
    }
</script>