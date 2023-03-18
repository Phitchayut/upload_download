<?php
session_start();
require_once '../../backend/config/connect.php';
if (!isset($_SESSION['admin_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
    header('location: ../../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าหลัก</title>
    <link rel="stylesheet" href="../../style.css">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css" rel="stylesheet" />

    <!-- toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <!-- dataTable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <style>
        .error {
            color: red;
            font-style: italic;
        }

        .form_error span {
            width: 80%;
            height: 35px;
            margin: 3px 10%;
            font-size: 1.1rem;
            color: #d83d5a;
        }

        .form_error input {
            border: 1px solid #d83d5a;
        }

        .form_success span {
            width: 80%;
            height: 35px;
            margin: 3px 10%;
            font-size: 1.1rem;
            color: green;
        }

        .form_success input {
            border: 1px solid green;
        }
    </style>
</head>

<body class="bg-light">
    <?php
    if (isset($_SESSION['admin_login'])) {
        $user_id = $_SESSION['admin_login'];
        $stmt = $conn->query("SELECT * FROM tbl_user WHERE id = $user_id");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    ?>
    <div class="container">
        <?php require_once("navbar.php") ?>
    </div>
    <div class="container">
        <div class="card mt-2">
            <div class="card-body">
                <div class="my-3">
                    <button type="button" class="btn btn-success" data-mdb-toggle="modal" data-mdb-target="#upload_file">
                        Upload File
                    </button>
                </div>
                <?php require_once("modal_upload_file.php") ?>
                <div class="table-responsive">
                    <table class="table table-striped  table-hover table-responsive table-bordered" id="tbl_file_upload">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 10%;">ลำดับ</th>
                                <th class="text-center" style="width: 50%;">ชื่อเอกสาร</th>
                                <th class="text-center" style="width: 20%;">Shared Link</th>
                                <th class="text-center" style="width: 10%;">จำนวนการดาวน์โหลด</th>
                                <th class="text-center" style="width: 10%;">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php
                            //คิวรี่ข้อมูลมาแสดงในตาราง
                            $stmt = $conn->prepare("SELECT * FROM tbl_upload");
                            $stmt->execute();
                            $result = $stmt->fetchAll();
                            $i = 0;
                            foreach ($result as $row) {
                                $i++;
                            ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td class="text-start"><?= $row['doc_name']; ?></td>
                                    <td>
                                        <p>
                                            <?= $row['status_input'] == 1 ?
                                                "downloads.php?id=" . $row['id'] :
                                                "download.php?id=" . $row['id']
                                            ?>
                                        </p>
                                        <a href="<?= $row['status_input'] == 1 ?
                                                        "downloads.php?id=" . $row['id'] :
                                                        "download.php?id=" . $row['id'] ?>" class="btn btn-info btn-sm copy_text"><i class="fa-solid fa-copy"></i></a>
                                    </td>
                                    <td><?= $row['count_download']; ?></td>
                                    <td>
                                        <a href="<?= $row['status_input'] == 1 ?
                                                        "edits.php?id=" . $row['id'] :
                                                        "edit.php?id=" . $row['id'] ?>" class="btn btn-warning btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
                                    </td>
                                <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    </div>
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.4.js"></script>
    <script>
        $(document).ready(function() {
            // check docname
            $('#doc_name').on('blur', function() {
                var doc_name = $(this).val();
                $.ajax({
                    url: '../../backend/check_docname.php',
                    method: 'POST',
                    data: {
                        doc_name: doc_name
                    },
                    success: function(response) {
                        $('#check_docname').html(response);
                    }
                });
            });
            // datatable
            $('#tbl_file_upload').DataTable();
            // copy link
            $('.copy_text').click(function(e) {
                e.preventDefault();
                var copyText = $(this).attr('href');
                var host = "http://localhost/upload_download/frontend/pages/"

                document.addEventListener('copy', function(e) {
                    e.clipboardData.setData('text/plain', host + copyText);
                    e.preventDefault();
                }, true);

                document.execCommand('copy');
                Command: toastr["success"]("Copied!")
                toastr.options = {
                    "positionClass": "toast-top-right",
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "1000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
            });


            // เช็คว่าต้องการให้กรอกข้อมูลหรือไม่
            $("#status_input").change(function() {
                if (this.checked) {
                    $("#shw_header_img").css('display', 'block');
                    $("#header_img").prop('required', true);
                } else {
                    $("#header_img").prop('required', false);
                    $("#shw_header_img").css('display', 'none');
                }
            });
        })
    </script>
    <!-- dataTable -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>
    <!-- toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <!-- swal -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</body>

</html>