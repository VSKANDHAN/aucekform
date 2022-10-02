<?php
echo "helloooo tester";

$regno=$_POST['regno'];
$sname=$_POST['sname'];
$branch=$_POST['branch'];
$dob=$_POST['dob'];
$year=$_POST['year'];
$semester=$_POST['semester'];
$gender=$_POST['gender'];
$bloodgrp=$_POST['bloodgrp'];



#DataBase Connection
$conn=new mysqli("localhost","vsk","Kandhanvsk2002@28","student");
if($conn->connect_errno){
    echo "failed to connect the Server",$conn->connect_error;
}

$sql="INSERT INTO info(regno,sname,branch,dob,semester,year,gender,bloodgrp)VALUES('$regno','$sname','$branch','$dob','$semester','$year','$gender','$bloodgrp')";
$query=mysqli_query($conn,$sql);
if($query){
    echo "<center><p>Submitted</p></center>";
    echo '<center><button  ><a href="form.html" >Go to home</a></button></center>';
}
else{
    echo "Unable to submit the form",$conn->error;
}
?>