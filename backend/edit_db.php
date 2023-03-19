<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php

session_start();
require_once './config/connect.php';

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $role = $_POST['role'];
    $doc_name = $_POST['doc_name'];
    $old_doc_file = $_POST['old_doc_file'];

    if (is_uploaded_file($_FILES['doc_file']['tmp_name'])) {
        $new_file_name = $doc_name . "." . pathinfo(basename($_FILES['doc_file']['name']), PATHINFO_EXTENSION);
        $file_upload_path = "../frontend/upload/file/" . $new_file_name;
        move_uploaded_file($_FILES['doc_file']['tmp_name'], $file_upload_path);
    } else {
        $new_file_name = "$old_doc_file";
    }

    $stmt = $conn->prepare("UPDATE tbl_upload SET doc_name = :doc_name, doc_file = :doc_file WHERE id = :id");
    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":doc_name", $doc_name);
    $stmt->bindParam(":doc_file", $new_file_name);
    $stmt->execute();
    $location = ($role == 'admin') ? "../frontend/pages/index.php" : "../frontend/pages/index_user.php";
    if ($stmt) {
        echo "<script>
                            $(document).ready(function() {
                                Swal.fire({
                                    title: 'สำเร็จ',
                                    text: 'เพิ่มข้อมูลเรียบร้อย!',
                                    icon: 'success',
                                    timer: 5000,
                                    showConfirmButton: false
                                });
                            })
                        </script>";
                        header("refresh:1; url=$location");
    } else {
        $_SESSION['error'] = "Data has not been inserted succesfully";
    }
}


?>