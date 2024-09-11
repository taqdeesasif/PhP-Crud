<?php
 include('operations.php'); 

class dbconfig
{
  public $conn;
  public function __construct()
  {
    $this->db_connect();
  }
  
  public function db_connect()
  {
    $this->conn = mysqli_connect("localhost", "root", "", "form_user");
    if (mysqli_connect_errno()) 
    {
      die("Connection failed: ");
    }

  }

}

// echo $conn->connect_error; exit;
// echo mysqli_error($conn);exit;
// $result = mysqli_query($conn, "select sysdate() as vdate");
// var_dump($result->fetch_assoc());
// exit;

  
  

//  Check connection


// Insert Records

// if (isset($_POST['submit'])) 
// {
// $name = $_POST['name'];
// $email = $_POST['email'];
// $password = $_POST['password'];
// $contact = $_POST['contact'];
// $address = $_POST['address'];
// $gender = $_POST['gender'];
// $use_course = $_POST['use_course'];
// $is_disable = $_POST['is_disable'];


// $sqry = "INSERT INTO register_user(name, email, password, contact, address, gender, use_course, is_disable) VALUES ('$name', '$email', '$password', '$contact', '$address', '$gender', '$use_course', '$is_disable' )";

// $done = mysqli_query($conn, $sqry);

// if($done)
// {
//   echo '<script>
//     alert("DATA INSERTED INTO DATABASE");
//     </script>';
//     header('location:form.php');  
// }

// else
//  {
//   echo  mysqli_error($conn);
//  }
// }

// Update records


// if (isset($_POST['update']))
// {
// $id = $_POST['id'];
// $name = $_POST['name'];
// $email = $_POST['email'];
// $password = $_POST['password'];
// $contact = $_POST['contact'];
// $address = $_POST['address'];
// $gender = $_POST['gender'];
// $use_course = $_POST['use_course'];
// $is_disable = $_POST['is_disable'];

// $qr =mysqli_query($conn,"UPDATE register_user SET name = '$name', email = '$email', password = '$password' , contact = '$contact', address = '$address', gender = '$gender', use_course = '$use_course', is_disable = '$is_disable' WHERE id = $id ");

// if($qr)
// {
//   echo '<script>
//     alert("DATA UPDATED INTO DATABASE");
//     </script>';
//     header('location:form.php');  
// }

// else
//  {
//   echo  mysqli_error($conn);
//  }

// }


// Delete records

// if(isset($_GET['del']))
// {
//   $id = $_GET['del'];
//   $qq = mysqli_query($conn, "DELETE FROM register_user WHERE id = $id");
//   if($qq)
//   {
//     echo '<script>
//       alert("DATA DELETED FROM DATABASE");
//       </script>';
//       header('location:form.php');  
//   }
  
//   else
//    {
//     echo  mysqli_error($conn);
//    }

// }


// Read records
// $res = mysqli_query($conn, "SELECT * FROM register_user");



