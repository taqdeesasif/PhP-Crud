<?php
include('form_script.php');
include_once('operations.php');



$u_fid = "";
$u_data = "";
$data_id= 0;
$u_tmp_data = '';
$edit_state = false;
$db = new operations();
$resl = $db->View_Record();
$res = $db->View_Img_Record();

if(isset($SESSION['data']))
{    $edit_state = $SESSION['data']['edit_state'] ;
    $data_id = $SESSION['data']['data_id'] ;
    $u_fid = $SESSION['data']['u_fid'] ;
     $u_data = $SESSION['data']['u_data'] ;
}

if (isset($_POST['data_submit']))
{
    $db->Store_Img_Record($_POST);
       
}
elseif (isset($_POST['data_update']))
{
   
    $db->Update_Img_Record($_POST);
       
}
else
    {
        if(isset($_GET['del']))
        {
            $id = $_GET['del'];
            $db->Delete_Img_Record($id);
             header('Location: data.php');
        }
    }


    if(isset($_GET['edit']))
    {
     $idd = $_GET['edit'];
     $u_res = $db->Get_Img_Record($idd);
     unset($_GET['edit']);
     $edit_state = true;
     $u_rec = mysqli_fetch_array($u_res);
     $data_id = $u_rec['data_id'];
     $u_fid = $u_rec['u_fid'];
     $u_data = $u_rec['u_data'];
     $u_tmp_data =  $u_rec['u_data'];
     unset($_GET['edit']);
     

}
?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet"  href="My.css">
    <title>
      Image_data
    </title>
    <script type="text/javascript" src="validation.js"></script>
     <script type="text/javascript" src="select_all.js"></script>
   
</head>
<body>
    <form action="data.php" method="post"   enctype="multipart/form-data">
        <div class="border">
        <h5 class="danger">
         <?php if(isset($_SESSION['submit_image']))
        {
            $result_session = $_SESSION['submit_image'];
            echo $result_session;
            unset($_SESSION['submit_image']);

        }?>
       </h5>
       <input type="hidden" name="data_id" value="<?php echo $data_id ?>" >
        <div class="row">
           
           <label>User Id:</label>
               
           <select name="u_fid" >
               <option selected="" value="Default">(Please select user id)</option>
               <?php
             while($row = mysqli_fetch_array($resl)){
            ?>
               <option <?php echo ($u_fid== $row['id'])?'selected':'' ?> value="<?php echo $row['id']; ?>"><?php echo $row['id']; ?> </option>
               <?php } ?>
           </select>

     

<br>

            <div class="row">
               
               <label> Upload User Data:</label>
               <input type="file" name="u_data" value="<?php echo $u_data ?>" onchange="showMyImage(this)"  >
               

               <img src="upload/<?php echo $u_data?>" style="width:100px;height:100">
               
               <input type=hidden name= "u_tmp_data" value= "<?php echo $u_tmp_data ?>"  >
                   
             
               
           </div>
           

           <div class="center">
                    <div class="row">
                    <?php
                        if($edit_state == false)
                        {
                    ?>
                            <button class="btn" type="submit" name="data_submit" >Submit</button>
                    <?php }
                    if($edit_state == true){
                    ?>
                             <button class="btn" type="submit" name="data_update" >Update</button>
                    <?php } ?>
                    </div>
            </div>
        </div>
    </form>

    <div class="container">
        <table >
   
            <tr>
                <th>SrNo.</th>
                <th>Name</th>
                <th>Image</th>
                <th>Edit</th>
                <th>Delete </th>
                <th >
                <input type="checkbox" name="checkAll" class="checkAll"/>All
                </th>
            </tr>
   
    <?php
        while($row = (mysqli_fetch_array($res)))
        {
   
    ?>
            <tr>
                <td></td>
                <td style="height: 40px"><?php echo $row['name'] ?></td>
                <td><img src= "<?php echo 'upload/'. $row['u_data'] ?>"  width="200" height="200" /> </td>
               
               
                <td>
                    <a class="abtn btn-green" href="data.php?edit=<?php echo $row['data_id']; ?>" >
                       Edit
                    </a>
                </td>
                <td>
                   
                <a class="abtn btn-danger" href="data.php?del=<?php echo $row['data_id']; ?>" >
                   Delete
                </a>
           
                </td>

                <?php
                    }
                ?>
                <td>
                <input class="checkboxes" type="checkbox">
                </td>
               
            </tr>
           
         
            <tr>
                <td colspan="11"></td>
                <td  style="text-align:center"><input class=" bg_blue" type="submit"></td>
            </tr>
           
       
        </table>
   
    </div>
   



</body>