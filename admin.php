<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <title>Admin Page</title>
</head>
<body>
<?php
$conn=new mysqli("localhost","vsk","Kandhanvsk2002@28","student");
if($conn->connect_errno){
echo "failed to connect the db".$conn->connect_error;

}
else{
    echo "<p> Connected to DataBase</P>";
}
$res=mysqli_query($conn,"SELECT * FROM info");
if(mysqli_num_rows($res)>0){
    $html='<div id="table"><table style="width:100%">';
    $html.='<tr><th>Name</th><th>Register No</th><th>Year</th><th>Department</th></tr>';
    while($rows=mysqli_fetch_assoc($res)){
        $html.='<tr><td>'.$rows['sname'].'</td><td>'.$rows['regno'].'</td><td>'.$rows['year'].'</td><td>'.$rows['branch'].'</td><td><form method="post"><button name="view" value="'.$rows['regno'].'" >view</button></form></td></tr>';

    }



    $html.='</table></div>';
    echo $html;

}
else{
    echo '<p id="nodata" >No Data Found</p>';
}
if(isset($_POST['view'])){
    function viewphp($regno){
        $conn=new mysqli("localhost","vsk","Kandhanvsk2002@28","student");
    if($conn->connect_errno){
    echo "failed to connect the db".$conn->connect_error;
    
    }
        $res1=mysqli_query($conn,"SELECT * FROM info WHERE regno=$regno");
        $row1=mysqli_fetch_assoc($res1);
        $pdfcontent='<div id="pdf">';
        $pdfcontent.='<p style="font-size: 18px;"><span id="pdfspan" style="font-size: 20px;">Register No:</span>'.$row1['regno'].'</p>';

        $pdfcontent.='<p style="font-size: 18px;"><span id="pdfspan" style="font-size: 20px;">Name:</span>'.$row1['sname'].'</p>';
        $pdfcontent.='<p style="font-size: 18px;"><span id="pdfspan" style="font-size: 20px;">Date Of Birth:</span>'.$row1['dob'].'</p>';
        $pdfcontent.='<p style="font-size: 18px;"><span id="pdfspan" style="font-size: 20px;">Gender:</span>'.$row1['gender'].'</p>';
        $pdfcontent.='<p style="font-size: 18px;"><span id="pdfspan" style="font-size: 20px;">Blood Group:</span>'.$row1['bloodgrp'].'</p>';


        $pdfcontent.='<p style="font-size: 18px;"><span id="pdfspan" style="font-size: 20px;">Branch:</span>'.$row1['branch'].'</p>';

        $pdfcontent.='<p style="font-size: 18px;"><span id="pdfspan" style="font-size: 20px;">Year:</span>'.$row1['year'].'</p>';
        $pdfcontent.='<p style="font-size: 18px;"><span id="pdfspan" style="font-size: 20px;">Semester:</span>'.$row1['semester'].'</p>';
        $pdfcontent.='</div>';




    
        require_once __DIR__ . '/vendor/autoload.php';
        ob_clean();
flush();
header("Content-type:application/pdf");
header("Content-Disposition:attachment;filename='downloaded.pdf'"); 
    
    $mpdf = new mPDF();
    $mpdf->WriteHTML($pdfcontent);
    $mpdf->Output();
        
    }
  }
  viewphp($_POST['view']);


?>



    
</body>
</html>
