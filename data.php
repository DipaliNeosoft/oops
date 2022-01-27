<?php
if ($_GET['insert'] == 1) { 
    $ob=new Project();
    $ob->insert();
}
class Project{
    private $conn;
    public $msg;
    function __construct(){
        $this->conn=mysqli_connect("localhost","root","","todo");
    }
   public function insert($uname,$email,$age,$city,$path){
    echo "inserted";
    exit(1);
$this->add=mysqli_query($this->conn,"insert into employee(uname,email,age,city,image) values ('$uname','$email',$age,'$city','$path')");
if($this->add){
    
    $msg="task added";
    return $msg;
}
else{
    $msg="task does not added";
    return $msg;
}
    }
    public  function show(){

    }
    public  function edit(){
        
    }
    public  function delete(){
        
    }
    function __destruct(){
        mysqli_close($this->conn);
    }
}
?>