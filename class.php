<?php
    class Employee{
        public $conn;
        function __construct()
        {
            $this->conn=mysqli_connect("localhost","root","","todo");
        }

        function addEmp($uname,$email,$age,$city,$image){
            if(mysqli_query($this->conn,"insert into employee(uname,email,age,city,image) values('$uname','$email',$age,'$city','$image
            ')")){
                $msg="Employee added successfully";
            }
            else{
                $msg="Employee not added please try again";
            }
            return $msg;
        }
        function upload_file($file)  
        {  
            if(isset($file))  
            {  
                    $extension = explode('.', $file["name"]);  
                    $new_name = rand() . '.' . $extension[1];  
                    $destination = './upload/' . $new_name;  
                    move_uploaded_file($file['tmp_name'], $destination);  
                    return $new_name;  
            }  
        }  
        function __destruct()
        {
            mysqli_close($this->conn);
        }
        public function execute_query($query)  
        {  
            return mysqli_query($this->conn, $query);  
        }  
        function display($sel){
            ?>
            <table class="table text-white">
            <thead>
                <tr>
                    <th scope="col">Sr no</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Age</th>
                    <th scope="col">City</th>
                    <th scope="col">Image</th>     
                    <th scope="col">Action</th>             
                </tr>
            </thead>
            <tbody>
            <?php 
                $select=mysqli_query($this->conn,"$sel");
                if(mysqli_num_rows($select)>0){
                    $sno=1;
                    while($arr=mysqli_fetch_assoc($select)){
                    ?>
                    <tr>
                        <td><?= $sno;?></td>
                        <td><?= $arr['uname'];?></td>
                        <td><?= $arr['email'];?></td>
                        <td><?= $arr['age'];?></td>
                        <td><?= $arr['city'];?></td>
                        <td><img src="<?php $img=$arr['image']; echo "upload/"."$img"; ?>" class="img-thumbnail" width="50" height="35" /></td>
                        <td>
                            <button class="btn btn-primary edit" name="edit"  id="<?= $arr['id'];?>">Edit</button>
                            <button class="btn btn-danger delete" name="delete" id="<?= $arr['id'];?>">Delete</button>
                        </td>
                    </tr>
                    <?php 
                    $sno++;
                }
            }
              ?>
            </tbody>
        </table>
        <?php
        }
    }


?>