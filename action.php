<?php  
include("class.php");
$obj = new Employee(); 
 if(isset($_POST["action"]))  
 {  
      if($_POST["action"] == "Load")  
      {  
           echo $obj->display("select * from employee ORDER BY id DESC");  
      }  
      if($_POST["action"] == "Insert")  
      {  
           $uname = mysqli_real_escape_string($obj->conn, $_POST["uname"]);  
           $email = mysqli_real_escape_string($obj->conn, $_POST["email"]);  
           $city = mysqli_real_escape_string($obj->conn, $_POST["city"]);  
           $age = mysqli_real_escape_string($obj->conn, $_POST["age"]);  
           $image = $obj->upload_file($_FILES["image"]);  
           $query = "insert into employee(uname,email,age,city,image) values('$uname','$email',$age,'$city','$image')";
           $obj->execute_query($query);  
           echo 'Data Inserted';  
      } 
      if($_POST["action"] == "Fetch")  
      {  
           $query = "SELECT * FROM employee WHERE id = '".$_POST["user_id"]."'";  
           $result = $obj->execute_query($query);  
           while($row = mysqli_fetch_array($result))  
           {  
                $output["uname"] = $row['uname'];  
                $output["email"] = $row['email'];  
                $output["city"] = $row['city'];
                $output["age"] = $row['age'];  
                $output["image"] = '<img src="upload/'.$row['image'].'" class="img-thumbnail" width="50" height="35" />';  
                $output["image"] = $row['image'];  
           }  
           echo json_encode($output);
           
      }   
      if($_POST["action"] == "Edit")  
      {  
           $image = '';  
           if($_FILES["image"]["name"] != '')  
           {  
                $image = $obj->upload_file($_FILES["user_image"]);  
           }  
           else  
           {  
                $image = $_POST["hidden_user_image"];  
           }  
           $uname = mysqli_real_escape_string($obj->conn, $_POST["uname"]);  
           $email = mysqli_real_escape_string($obj->conn, $_POST["email"]);  
           $city = mysqli_real_escape_string($obj->conn, $_POST["city"]);  
           $age = mysqli_real_escape_string($obj->conn, $_POST["age"]);  
           $image = $obj->upload_file($_FILES["image"]);  
           $query = "UPDATE employee SET uname = '".$uname."', email = '".$email."',age = '".$age."' ,city = '".$city."' ,image = '".$image."' WHERE id = '".$_POST["user_id"]."'";  
           $obj->execute_query($query);  
           echo 'Data Updated';  
      }  
     }  
     if($_POST["action"] == "delete")  
     {  
       
          $query="delete from employee where id = '".$_POST["user_id"]."'";
          $obj->execute_query($query);  
          echo 'Data Updated';  
     }  
 ?>  