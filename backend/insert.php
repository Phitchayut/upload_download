<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
session_start();
require_once "./config/connect.php";

if (isset($_POST['submit'])) { 
$doc_name = $_POST['doc_name'];
if (isset($_POST['status_input'])) {
    $status_input = 1;
} else {
    $status_input = 0;
}
if (is_uploaded_file($_FILES['doc_file']['tmp_name'])) {
    $new_file_name = $doc_name . "." . pathinfo(basename($_FILES['doc_file']['name']), PATHINFO_EXTENSION);
    $file_upload_path = "../frontend/upload/file/" . $new_file_name;
    move_uploaded_file($_FILES['doc_file']['tmp_name'], $file_upload_path);
} else {
    $new_file_name = "";
}

if (is_uploaded_file($_FILES['header_img']['tmp_name'])) {
    $new_image_name = 'header' . uniqid() . "." . pathinfo(basename($_FILES['header_img']['name']), PATHINFO_EXTENSION);
    $image_upload_path = "../frontend/upload/header/" . $new_image_name;
    move_uploaded_file($_FILES['header_img']['tmp_name'], $image_upload_path);
} else {
    $new_image_name = "";
}
if($new_image_name == ''){
    $new_image_name = "No header!";
}

        $stmt = $conn->prepare("INSERT INTO tbl_upload(doc_name,doc_file,header_img,status_input) VALUES(:doc_name,:doc_file,:header_img,:status_input)");
        $stmt->bindParam(":doc_name", $doc_name);
        $stmt->bindParam(":doc_file", $new_file_name);
        $stmt->bindParam(":header_img", $new_image_name);
        $stmt->bindParam(":status_input", $status_input);
        $stmt->execute();
        if ($stmt) {
            echo "<script>
                    $(document).ready(function() {
                        Swal.fire({
                            title: 'สำเร็จ',
                            text: 'เพิ่มข้อมูลเรียบร้อย!',
                            icon: 'success',
                            timer: 3000,
                            showConfirmButton: false
                        });
                    })
                </script>";
            header("refresh:1; url=../frontend/pages/index.php");
        } else {
            $_SESSION['error'] = "Data has not been inserted succesfully";
        }
    }
?>