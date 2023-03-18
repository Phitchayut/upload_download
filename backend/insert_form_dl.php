<?php
require_once("./config/connect.php");
$file_name = $_POST['file_name'];
$tname = $_POST['title_name'];
$fname = $_POST['first_name'];
$lname = $_POST['last_name'];
$company = $_POST['company'];
$mphone = $_POST['mobile_phone'];
$email = $_POST['email'];
if (isset($_POST['othercareer']) && $_POST['othercareer'] != "") {
    $career = $_POST['othercareer'];
} else {
    $career = $_POST['career'];
}

$stmt = $conn->prepare("INSERT INTO tbl_download(title_name,first_name,last_name,company,mobile_phone,email,career,file_name)
    VALUES(:title_name, :first_name, :last_name, :company, :mobile_phone, :email, :career, :file_name)");
$stmt->bindParam(":title_name", $tname);
$stmt->bindParam(":first_name", $fname);
$stmt->bindParam(":last_name", $lname);
$stmt->bindParam(":company", $company);
$stmt->bindParam(":mobile_phone", $mphone);
$stmt->bindParam(":email", $email);
$stmt->bindParam(":career", $career);
$stmt->bindParam(":file_name", $file_name);
$stmt->execute();

if($stmt){
    echo "success";
} else {
    echo "Fail";
}

?>
