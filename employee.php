<?php  
 include 'class.php';  
 $obj = new Employee();  
 ?> 
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Employee list</title>
  </head>
  <body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <div class="jumbotron container bg text-white">
        <h1 id="headline" class="text-center">Add Employee</h1>
        <form  method="post" onsubmit="return validateform()" enctype="multipart/form-data" id="user_form" novalidate> 
        <div class="form-group">
        <label for="uname">Username</label>
        <input type="text" class="form-control"  onblur="validateName()" id="uname" name="uname">
              </div>   <span class="text-danger" id="unameError"></span>
    
              <div class="form-group">
              <label for="email">Email</label>
              <input type="text" class="form-control" onblur="validateEmail()" id="email" name="email">
              </div>  <span class="text-danger" id="emailError"></span>
                

              <div class="form-group">
              <label for="age">Age</label>
              <input type="number" class="form-control" onblur="validateAge()" id="age" name="age">
              </div> <span class="text-danger" id="ageError"></span>
                

              <div class="form-group">
              <label for="city">City</label>
              <input type="text" class="form-control" onblur="validateCity()" id="city" name="city">
              </div><span class="text-danger" id="cityError"></span>
            

              <div class="form-group">
              <label for="image">Image</label>
              <input type="file" class="form-control-file" id="image" name="image">
              </div> <span class="text-danger" id="imageError"></span>
              <input type="hidden" name="hidden_user_image" id="hidden_user_image" />  
                    <span id="uploaded_image"></span>  
                   <span class="text-danger" id="imageError"></span>
              
            
              <div class="form-group">
                    <input type="hidden" name="action" id="action" />  
                    <input type="hidden" name="user_id" id="user_id" />  
                   <input type="submit" name="button_action" id="button_action" class="btn btn-primary" value="Insert" />
                    </div>
        </form>
    </div>
    <div class="jumbotron container bg" id="user_table">
        
    </div>
    <script>
       $(document).ready(function(){  
           load_data();  
           $('#action').val("Insert");  
           $('#add').click(function(){  
                $('#user_form')[0].reset();  
                $('#uploaded_image').html('');  
                $('#button_action').val("Insert");  
           });  
           function load_data()  
           {  
                var action = "Load";  
                $.ajax({  
                     url:"action.php",  
                     method:"POST",  
                     data:{action:action},  
                     success:function(data)  
                     {  
                         
                          $('#user_table').html(data);  
                     }  
                });  
           }  
           $('#user_form').on('submit', function(event){  
                event.preventDefault();  
                var uname = $('#uname').val();  
                var email = $('#email').val();  
                var city = $('#city').val();
                var age = $('#age').val();    
                var extension = $('#image').val().split('.').pop().toLowerCase();  
                if(extension != '')  
                {  
                     if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)  
                     {  
                          alert("Invalid Image File");  
                          $('#image').val('');  
                          return false;  
                     }  
                }  
                if(uname != '' && email != '')  
                {  
                     $.ajax({  
                          url:"action.php",  
                          method:"POST",  
                          data:new FormData(this),  
                          contentType:false,  
                          processData:false,  
                          success:function(data)  
                          {  
                               alert(data);  
                               $('#user_form')[0].reset();  
                               load_data();  
                          }  
                     })  
                }  
           });  

           $(document).on('click','.edit',function(event){
               event.preventDefault();  
                var user_id = $(this).attr("id");  
                var action = "Fetch"; 
                $.ajax({  
                     url:"action.php",  
                     method:"POST",  
                     data:{user_id:user_id, action:action},  
                     success:function(data)  
                     {  
                         
                          myObj = JSON.parse(data);
                          $('#uname').val(myObj.uname);  
                          $('#email').val(myObj.email); 
                          $('#city').val(myObj.city);
                          $('#age').val(myObj.age);   
                          $('#uploaded_image').html(myObj.image);  
                          $('#hidden_user_image').val(myObj.image);  
                          $('#button_action').val("Edit");  
                          $('#action').val("Edit");  
                          $('#user_id').val(user_id);  
                     }  
                });  
           }); 

           $(document).on('click','.delete',function(){
                var user_id = $(this).attr("id");  
                var action = "delete"; 
                $.ajax({  
                     url:"action.php",  
                     method:"POST",  
                     data:{user_id:user_id, action:action},  
                     success:function(data)  
                     {  
                        alert("success");
                        load_data();  
                     }  
                });  
           }); 
  
      });  

    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="validations.js"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>