<?php

error_reporting(0);

if(isset($_POST['save']) || isset($_POST['update'])){
  echo "hello";
    $uname = test_input($_POST["uname"]);
    $email = test_input($_POST["email"]);
    $age = test_input($_POST["age"]);
    $city = test_input($_POST["city"]);
    $tmp = test_input($_FILES["image"]["tmp_name"]);
    $image = test_input($_FILES["image"]["name"]);
   $unameerror= $emailerror=$ageerror=$cityerror=$imageerror="";
  
   if(empty($uname)){
    $unameerror = "This field is required!!!";
}
else if (!preg_match("/^[a-zA-Z0-9]{6,16}+$/",$uname)) {
  $unameerror = "only alphabets and digits are allowed and length should be atleast 6";
}
    if(empty($email)){
        $emailerror = "This field is required!!!";
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailerror = "Invalid email format";
    }
    if(empty($age)){
        $ageerror = "This field is required!!!";
    }
    else if (!preg_match("/^[0-9]+$/",$age)) {
      $ageerror = "only digits are allowed";
    }
    else if ($age<1 || $age>110) {
        $ageerror = "Enter valid age";
      }
      if($city=="NULL"){
        $cityerror = "This field is required!!!";
    }
    if(!empty($tmp)) {
      $ext = pathinfo($tmp, PATHINFO_EXTENSION);
      $allowed=array("png","jpg","jpeg");
if(in_array($ext,$allowed)){
 $imageerror="";
}
else{
  $imageerror = "png,jpg and jpeg are allowed";
}
    }
    else{
      $imageerror = "This field is required!!!!!";
    }
}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>To do</title>
    <style>
        .bg{
            background:linear-gradient(160deg,deeppink,orange,violet);
        }
        .error{
            color:red;
        }
    </style>
  </head>
  <body>
   <div class="container text-center text-white bg">
   <h1>To Do List</h1>
   </div>
    <div class="container jumbotron bg  text-white">
        <div class="row">
        <div class="col-md-6">
<img src="image/bg.jpg" alt="image" height="100%" width="100%">
            </div>
            <div class="col-md-6">
            
         <form method="post" enctype="multi/form-data" id="form" action="add.php"> 
  <div class="form-group ">
      <label for="uname">Uname</label>
      <input type="text" class="form-control" name="uname" id="uname" placeholder="User name">
    </div><span class="error"><?= $unameerror; ?></span>
    <div class="form-group ">
      <label for="email">Email</label>
      <input type="text" class="form-control" name="email" id="email" placeholder="Email">
    </div><span class="error"><?= $emailerror; ?></span>
    <div class="form-group ">
      <label for="age">Age</label>
      <input type="text" class="form-control" name="age" id="age" placeholder="Age">
    </div><span class="error"><?= $ageerror; ?></span>
    <div class="form-group ">
      <label for="city">City</label>
      <select id="city" class="form-control"  name="city">
        <option value="NULL">Choose city...</option>
        <option value="Mumbai">Mumbai</option>
        <option value="Pune">Pune</option>
        <option value="Delhi">Delhi</option>
        <option value="Banglore">Banglore</option>
      </select>
    </div><span class="error"><?= $cityerror; ?></span>
    <div class="form-group">
    <label for="image">Image</label>
      <input type="file" class="form-control-file" id="image" name="image">
    </div><span class="error"><?= $imageerror; ?></span>
    <div class="form-group text-center">
  <button type="submit" class="btn btn-primary" name="save" id="save">Save</button>
  <button type="submit" class="btn btn-primary" name="update" id="update">Update</button>
  </div>
</form>
</div>  
   
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
<script>

  $(document).ready(function(){
$('#save').click(function(e){
e.preventDefault();
// $('#update').hide();
<?php
if(move_uploaded_file($tmp,"uploads/$image")){
  $path="uploads/$image";
  $ob=new Project();
$ob->insert($uname,$email,$age,$city,$path);
}
?>
var fd=new FormData();
console.log(fd);
var uname=$("#uname").val();
var email=$("#email").val();
var age=$("#age").val();
var city=$("#city").val();
var files=$('#image')[0].files[0];
 var path=fd.append('uploads/',files);

console.log(path);

$.ajax({
  type: "post",
  url:"data.php?insert=1",
  data:{uname:uname,email:email,age:age,city:city,path:path},
  success:function(data){
    console.log(data);

  }
})
});
  });
</script>
</body>
</html>