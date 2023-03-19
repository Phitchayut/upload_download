<?php
session_start();
require_once '../../../../backend/config/connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูล</title>
    <link rel="stylesheet" href="../../style.css">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css" rel="stylesheet" />
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
        <?php require_once("../../../components/navbar_admin.php") ?>
        <div class="container">
            <div class="mt-5 text-center">
                <h3>แก้ไขข้อมูล</h3>
            </div>
            <div class="mb-5">
                <form action="../../../../backend/edit_db.php" method="post" enctype="multipart/form-data">
                    <?php
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $stmt = $conn->query("SELECT * FROM tbl_upload WHERE id = $id");
                        $stmt->execute();
                        $row = $stmt->fetch();
                    }
                    ?>
                    <div class="mb-3">
                        <input type="text" value="<?= $row['id']; ?>" required class="visually-hidden" name="id">
                    </div>
                    <input type="hidden" name="role" value="<?=  $rowrole['role'] ?>">
                    <div class="form-outline mb-4">
                        <input type="text" id="doc_name" name="doc_name" class="form-control" value="<?= $row['doc_name']; ?>" required />
                        <input type="hidden" name="old_doc_name" value="<?= $row['doc_name']; ?>">
                        
                    </div>
                    <label class="form-label" for="doc_file"><?= $row['doc_file']; ?></label>
                    <input type="file" name="doc_file" class="form-control" id="doc_file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" />
                    <input type="hidden" name="old_doc_file" value="<?= $row['doc_file']; ?>">
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <button type="submit" name="update" class="btn btn-success w-100">บันทึก</button>
                        </div>
                        <div class="col-6">
                            <a href="../../index.php" class="btn btn-danger w-100">ยกเลิก</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.js"></script>
    <script>
        let imgInput = document.getElementById('imgInput');
        let previewImg = document.getElementById('previewImg');

        imgInput.onchange = evt => {
            const [file] = imgInput.files;
            if (file) {
                previewImg.src = URL.createObjectURL(file)
            }
        }
    </script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>
</body>

</html>