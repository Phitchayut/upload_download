<?php
session_start();
require_once '../../../../backend/config/connect.php';
if (!isset($_SESSION['admin_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
    header('location: ../../../../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายละเอียด</title>
    <link rel="stylesheet" href="../../../../style.css">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css" rel="stylesheet" />
    <!-- dataTable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.bootstrap5.min.css">
</head>

<body class="bg-light">
    <?php
    if (isset($_SESSION['admin_login'])) {
        $user_id = $_SESSION['admin_login'];
        $stmt = $conn->query("SELECT * FROM tbl_user WHERE id = $user_id");
        $stmt->execute();
        $rowrole = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    ?>
    <div class="container">
        <?php require_once("navbar_admin.php") ?>
    </div>
    <?php
    if (isset($_GET['doc_file']) && $_GET['id']) {
        $id = $_GET['id'];
        $doc_file = $_GET['doc_file'];
    }
    ?>
    <div class="container">
        <div class="card mt-2">
            <div class="card-body">
                <h3 class="text-center">ชื่อไฟล์เอกสาร <?= $doc_file ?></h3>
                <div class="d-flex justify-content-center">
                    <div class="card shadow bg-body rounded border-0 mt-2" style="width: 70%; height: 150px">
                        <div class="card-body text-center">
                            <p class="">มีผู้ดาวน์โหลดเอกสารนี้ทั้งหมด</p>
                            <?php
                            $count = $conn->prepare("SELECT count_download FROM tbl_upload WHERE id = :id");
                            $count->bindParam(":id", $id);
                            $count->execute();
                            $row = $count->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <p class="fw-bold fs-1"> <?= $row['count_download'] ?> ครั้ง</p>
                        </div>
                    </div>
                </div>
                <a href="../../index.php" class="btn btn-danger w-100 mt-5">ย้อนกลับ</a>
            </div>
        </div>


        <!-- MDB -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>
        <!-- jquery -->
        <script src="https://code.jquery.com/jquery-3.6.4.js"></script>

</body>

</html>