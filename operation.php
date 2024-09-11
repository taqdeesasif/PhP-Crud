<?php
 require_once('form_script.php');
if(!isset($_SESSION))
{ session_start(); }
   
    $db = new dbconfig();
    $op = new operations();


    class operations extends dbconfig
    {

       
         public function Update_Img_Record($data)
        {
            $db = new dbconfig();
            $data_id = $_POST['data_id'];
            $u_fid = $_POST['u_fid'];
            $u_tmp_data = $_POST['u_tmp_data'];
           
            if(!empty( $_FILES['u_data']['name']))
            {
                $u_data = $_FILES['u_data']['name'];
                $fileName = pathinfo($u_data,PATHINFO_FILENAME);
                $fileType = pathinfo($u_data,PATHINFO_EXTENSION);
                 $allowTypes = array('jpg','png','jpeg','gif');

                if(in_array($fileType,$allowTypes))
                {
                    $tem_u_data = $_FILES['u_data']['tmp_name'];
                      $temp_file_name = $fileName;
                    $increment = 0;
                    while(file_exists('upload/'.$fileName . '.' . $fileType))
                    {
                        $increment++;
                        $u_data = $temp_file_name . $increment . '.' . $fileType;
                        $fileName = pathinfo($u_data,PATHINFO_FILENAME);
                                 
}
                    move_uploaded_file($tem_u_data, "upload/".$u_data );

                    $sqry = "UPDATE user_data SET u_fid = '$u_fid', u_data = '$u_data' WHERE data_id = $data_id";

                    $done = mysqli_query($db->conn, $sqry);
                    if($done)
                    {
                        $delete_path = "upload/".$u_tmp_data;
                        unlink($delete_path);
                        unset($_POST['data_update']);
                        $_SESSION['submit_image'] = "Data Updated In Database";
                    }
                    else
                    {
                        $SESSION['data'] = array('data_id'=>$data_id,'edit_state'=>true,'u_fid'=> $u_fid, 'u_data'=> $u_data );
                        unset($_POST['data_update']);
                        $_SESSION['submit_image'] = "Error!! Data failed to update";
                       
}

}
                 else
               {
                    $SESSION['data'] = array('data_id'=>$data_id,'edit_state'=>true,'u_fid'=> $u_fid, 'u_data'=> $u_data );
                    $_SESSION['submit_image'] = "Error!!Choose jpg png jpeg or gif file";
                     unset($_POST['data_update']);
  }
            }
         else
           {
                 $SESSION['data'] = array('data_id'=>$data_id,'edit_state'=>true,'u_fid'=> $u_fid, 'u_data'=> "" );
                $_SESSION['submit_image'] = "Error!! Choose Image";
                 unset($_POST['data_update']);
           
  }


        }

         public function Get_Img_Record($id)
        {
            $db = new dbconfig();
            $qry = "SELECT * FROM user_data WHERE data_id = $id";
            $rec = mysqli_query($db->conn,$qry);
            return $rec;
        }

         public function Delete_Img_Record($id)
        {
             $db = new dbconfig();
             $qury = "SELECT * FROM user_data WHERE data_id = $id";
             $rec = mysqli_query($db->conn,$qury);
             $row = mysqli_fetch_array($rec);
             $img_name = $row['u_data'];
             $delete_path = "upload/".$img_name;
           

             $qry = "DELETE FROM user_data WHERE data_id = $id";
             $done = mysqli_query($db->conn,$qry);
             if($done)
            {
                unlink($delete_path);
                echo '<script>
                alert("DATA DELETED FROM DATABASE");
                </script>';
               
            }
           
        }
   
        public function View_Img_Record()
        {
            $db = new dbconfig();
            $qry = "SELECT u.*, v.name FROM user_data u, register_user v WHERE v.id = u.u_fid ";
            $res = mysqli_query($db->conn,$qry);
            return $res;
}

        public function Store_Img_Record($data)   //Store image
        {
            $db = new dbconfig();
            $u_fid = $_POST['u_fid'];
           
            if(!empty($_FILES['u_data']['name']))
            {
                $u_data = $_FILES['u_data']['name'];
               
               $fileName = pathinfo($u_data,PATHINFO_FILENAME);
                $fileType = pathinfo($u_data, PATHINFO_EXTENSION);
                $allowTypes = array('jpg','png','jpeg','gif');
                if(in_array($fileType, $allowTypes))
                {
                    $tem_u_data = $_FILES['u_data']['tmp_name'];

                     $temp_file_name = $fileName;
                    $increment = 0;
                    while(file_exists('upload/'.$fileName . '.' . $fileType))
                    {
                        $increment++;
                       
                        $u_data = $temp_file_name . $increment . '.' . $fileType;
                        $fileName = pathinfo($u_data,PATHINFO_FILENAME);
                                 
}
                    move_uploaded_file($tem_u_data, "upload/".$u_data );

                    $sqry = "INSERT INTO user_data(u_fid, u_data) VALUES ('$u_fid', '$u_data' )";
                    $done = mysqli_query($db->conn, $sqry);
                    if($done)
                    {
                        unset($_POST['data_submit']);
                        $_SESSION['submit_image'] = "Data Inserted Into Database";
                    }
                    else
                    {
                        $SESSION['data'] = array('data_id'=>0,'edit_state'=>false,'u_fid'=> $u_fid, 'u_data'=> $u_data );
                        unset($_POST['data_submit']);
                        $_SESSION['submit_image'] = "Error!! Data failed to insert";
                       
}
           
               }
               else
               {
                    $SESSION['data'] = array('data_id'=>0,'edit_state'=>false,'u_fid'=> $u_fid, 'u_data'=> $u_data );
                    $_SESSION['submit_image'] = "Error!!Choose jpg png jpeg or gif file";
                     unset($_POST['data_submit']);
  }
           }
           else
           {
                 $SESSION['data'] = array('data_id'=>0,'edit_state'=>false,'u_fid'=> $u_fid, 'u_data'=> "" );
                $_SESSION['submit_image'] = "Error!! Choose Image";
                 unset($_POST['data_submit']);
           
  }
        }
     
           
       
        public function Store_Record($data)   //Store Record
        {
           
            $conf = $data['password2'];
            $name = $data['name'];
            $email = $data['email'];
            $password = $data['password'];
            $contact = $data['contact'];
            $address = $data['address'];
            $current_address = $data['current_address'];
            $gender = $data['gender'];
            $use_course = $data['use_course'];
            $is_disable = '';
            if(isset($data['is_disable']))
            {
                $is_disable = $data['is_disable'];
            }
            $err = ($this->validate($name,$email,$password,$conf,$contact,$address,$current_address,$gender,$use_course));
           
            if($err==false)
            {
               

                if($this->insert_record($name,$email,$password,$contact,$address,$current_address,$gender,$use_course,$is_disable))
                {
                    unset($_POST['submit']);
                   $_SESSION['submit_result'] = "Data Inserted Into Database";
                   

                   
                }
            }
            else
            {
               
                $_SESSION['record']  = array('id'=>0,'edit'=>false,'name'=>$name,'email'=>$email,'password'=>$password,'password2'=>$conf,'contact'=>$contact,'address'=>$address,'current_address'=>$current_address,'gender'=>$gender,'use_course'=>$use_course,'is_disable'=>$is_disable);
                unset($_POST['submit']);
                $_SESSION['submit_result'] = "Error!! Registration Cancel";
               
            }
           
           
           
           
        }

        public function insert_record($name,$email,$password,$contact,$address,$current_address,$gender,$use_course,$is_disable)  //Insert record in the DB
        {
            $db = new dbconfig();
            $sqry = "INSERT INTO register_user(name, email, password, contact, address, current_address, gender, use_course, is_disable) VALUES ('$name', '$email', '$password', '$contact', '$address','$current_address', '$gender', '$use_course', '$is_disable' )";
            $done = mysqli_query($db->conn, $sqry);
            if($done)
            {
                return true;
            }

            else
            {
                return false;
            }

        }

        public function View_Record()
        {
            $db = new dbconfig();
           
            /*var_dump($db->conn);
            exit;*/
            $qury = "SELECT * FROM register_user";
            $result = mysqli_query($db->conn, $qury);
            return $result;
        }

        public function Filter_Record($data)
        {   $db = new dbconfig();
            $name = "";
            $contact = "";
            $gender = "all";
            $dis = "all";
           
            $and = "id IS NOT NULL";
            if((!empty($data['gender'])) && (($data['gender']) != "all")){
                $gender = $data['gender'];
               
            $and .= " AND gender= '$gender'";
            }
            if((!empty($data['is_disable'])) && (($data['is_disable']) != "all")){
                if(($data['is_disable']) == "No")
                {
                    $is_disable = '0';
                    $dis="No";
                }
                else
                {
                $is_disable = $data['is_disable'];
                $dis="1";
                }
            $and .= " AND is_disable= '$is_disable'";
            }
            if(!empty($data['name'])){
                $name = $data['name'];
                $percent = "%";
                $fname = $name . $percent;
                $and .= " AND name LIKE '$fname'";
            }
            if(!empty($data['contact'])){
                $contact = $data['contact'];
                $and .= " AND contact =  '$contact'";
            }

            $q = "SELECT * FROM register_user WHERE $and";
            $result = mysqli_query($db->conn, $q);

            $_SESSION['reportRec']  = array('name'=>$name,'contact'=>$contact,'gender'=>$gender,'is_disable'=>$dis);
            unset($_GET['load']);
            return $result;



        }

        public function Get_Record($id)
        {
            $db = new dbconfig();
            $qr = "SELECT * FROM register_user WHERE id=$id";
            $rec = mysqli_query($db->conn, $qr);
            return $rec;
        }

        public function Update($data)
        {
            $conf = $data['password2'];
            $id = $data['id'];
            $name = $data['name'];
            $email = $data['email'];
            $password = $data['password'];
            $contact = $data['contact'];
            $address = $data['address'];
            $current_address = $data['current_address'];
            $gender = $data['gender'];
            $use_course = $data['use_course'];
            $is_disable = '';
            if(isset($data['is_disable']))
            {
                $is_disable = $data['is_disable'];
            }
           
           
            $err = ($this->validate($name,$email,$password,$conf,$contact,$address,$current_address,$gender,$use_course));
           
            if($err==false)
            {

                if($this->update_record($id,$name,$email,$password,$contact,$address,$current_address,$gender,$use_course,$is_disable))
                {
                    unset($_POST['update']);
                    $_SESSION['submit_result'] = "Data Updated";

                    echo '<script>
                    alert("DATA UPDATED INTO DATABASE");
                    </script>';
                   
                }
            }
            else
            {
               
                $_SESSION['record']  = array('edit'=>true,'id'=>$id,'name'=>$name,'email'=>$email,'password'=>$password,'password2'=>$conf,'contact'=>$contact,'address'=>$address,'current_address'=>$current_address,'gender'=>$gender,'use_course'=>$use_course,'is_disable'=>$is_disable);
                unset($_POST['update']);
                $_SESSION['submit_result'] = "Error!! Registration Cancel";
               
            }
           
        }

        public function update_record($id,$name,$email,$password,$contact,$address,$current_address,$gender,$use_course,$is_disable)
        {
            $db = new dbconfig();
            $qr ="UPDATE register_user SET name = '$name', email = '$email', password = '$password' , contact = '$contact', address = '$address',current_address = '$current_address', gender = '$gender', use_course = '$use_course', is_disable = '$is_disable' WHERE id = $id ";
            $r = mysqli_query($db->conn,$qr);
            if($r)
            {
                return true;
            }
            else
            {
                return false;
            }


        }

        public function Delete_Record($id)
        {
            $db = new dbconfig();
            $qq = "DELETE FROM register_user WHERE id = $id";
            $re = mysqli_query($db->conn,$qq);
            if($re)
            {
                echo '<script>
                alert("DATA DELETED FROM DATABASE");
                </script>';
               
            }


        }


        public function Delete_Selected_Records($data)
        {
            $db = new dbconfig();
            $rowCount = count($data["users"]);
            for($i=0;$i<$rowCount;$i++)
            {
            $re = mysqli_query($db->conn, "DELETE FROM register_user WHERE id='" . $data["users"][$i] . "'");
           
            }
            unset($_POST['delete']);
            if($re)
            {
                echo '<script>
                alert("DATA DELETED FROM DATABASE");
                </script>';
               
            }
               
           
        }


        public function validate($name,$email,$passwordd,$conf,$contact,$address,$current_address,$gender,$use_course)
        {
           
            $errorN = '0';
            $errorE = '0';
            $errorP = '0';
            $errorCP = '0';
            $errorC = '0';
            $errorPh = '0';
            $errorAdd = '0';
            $errorG = '0';
            $errorCr = '0';
            $errorDis = '0';
            $error_Check = false;
           
         
            $emp_name=$name;
            $emp_email=$email;
            $password=$passwordd;
            $confirm=$conf;
            $emp_ph=$contact;
            $add = $address;
            $cadd = $current_address;
            $g= $gender;
            $course = $use_course;
           
           
                 
       
            if(($emp_name =="") || (!preg_match ("/^[a-zA-z\s]*$/", $emp_name)) || (!strlen($emp_name)>2) )
            {            
                $errorN =  '1' ;
                $error_Check = true;
               
               
            }
            if(($emp_email == "") || (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $emp_email)))
            {
               
                $errorE =  '2';
                $error_Check = true;
               
               
            }
           
           
            if(($password == "") || (!strlen($password)>7))
            {
               
                $errorP =  '3';
                $error_Check = true;
               
               
            }
           
            if(($confirm == "") || (!strlen($confirm)>7))
            {
               
                $errorC =  '4';
                $error_Check = true;
               
               
            }
           
            if($password != $confirm) {
               
                $erroCP =  '5';
                $error_Check = true;
               
               
            }
       
            if(($emp_ph == "") || (is_numeric(trim($emp_ph)) == false) || (!strlen($emp_ph) == 11))
            {
               
                $erroPh =  '6';
                $error_Check = true;
               
               
            }
            if($add == "")
            {
               
                $errorAdd =  '7';
                $error_Check = true;
               
               
            }

            if($cadd == "")
            {
               
                $errorAdd =  '10';
                $error_Check = true;
               
               
            }
            if($g == "")
            {
               
                $errorG =  '8';
                $error_Check = true;
               
               
            }
            if(($course == "")|| ($course == "Default"))
            {
               
                $errorCr =  '9';
                $error_Check = true;
               
               
            }
         
            if($error_Check == true)
            {
                $_SESSION['error'] = array('name'=>$errorN, 'email' => $errorE, 'password' => $errorP, 'conf' => $errorC, 'confP' => $errorCP, 'phone' => $errorPh, 'address' => $errorAdd, 'gender' => $errorG, 'course' => $errorCr, 'dis' =>$errorDis);

            }
             
               
                return $error_Check;
           


        }
    }




?>