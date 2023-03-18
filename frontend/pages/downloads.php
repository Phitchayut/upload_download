<?php
require_once("../../backend/config/connect.php")
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download File</title>
    <link rel="stylesheet" href="../../style.css">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css" rel="stylesheet" />
    <style>
        .error {
            color: red;
            font-style: italic;
        }

        .success {
            display: none;
        }
    </style>
</head>

<body class="bg-light">
    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $stmt = $conn->query("SELECT * FROM tbl_upload WHERE id = $id");
        $stmt->execute();
        $row = $stmt->fetch();
    }
    ?>
    <div class="container">
        <div class="header">
            <img src="../upload/header/<?= $row['header_img']; ?>" alt="header image" class="img-fluid">
        </div>
        <div class="mt-3 text-center">
        <h4><?= $row['doc_file'] ?></h4>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="" id="form_insert" method="post">
                    <input id="idfile" type="hidden" value="<?= $row['id'] ?>">
                    <input id="file" type="hidden" value="<?= $row['doc_file'] ?>">
                    <input id="file_name" name="file_name" type="hidden" value="<?= $row['doc_file'] ?>">
                    <div class="row">
                        <div class="col-sm-2">
                            <label for="title_name" class="form-label">คำนำหน้าชื่อ<span class="text-danger">*</span></label>
                            <input autocomplete="off" class="form-control" list="datalistOptions" id="title_name" name="title_name" placeholder="คำนำหน้าชื่อ..">
                            <datalist id="datalistOptions">
                                <option value="นาย">
                                <option value="นางสาว">
                                <option value="นาง">
                            </datalist>
                        </div>
                        <div class="col-sm-5">
                            <label for="first_name" class="form-label">ชื่อ<span class="text-danger">*</span></label>
                            <input autocomplete="off" type="text" class="form-control" id="first_name" name="first_name" placeholder="กรุณากรอกชื่อ..." require>
                        </div>
                        <div class="col-sm-5">
                            <label for="last_name" class="form-label">นามสกุล<span class="text-danger">*</span></label>
                            <input autocomplete="off" type="text" class="form-control" id="last_name" name="last_name" placeholder="กรุณากรอกนามสกุล..." require>
                        </div>
                        <!-- row -->
                        <div class="col-sm-6 mt-3">
                            <label for="company" class="form-label">บริษัท/สังกัดสำนักงาน <span class="text-danger">*</span></label>

                            <input autocomplete="off" class="form-control" list="companyOptions" id="company" name="company" placeholder="กรณีท่านไม่ได้สังกัดสำนักงาน กรุณาระบุ “อิสระ”">
                            <datalist id="companyOptions">
                                <option value="อิสระ">
                            </datalist>
                        </div>
                        <div class="col-sm-6 mt-3">
                            <label for="mobile_phone" class="form-label">เบอร์โทรศัพท์มือถือ<span class="text-danger">*</span></label>
                            <input autocomplete="off" type="text" class="form-control" id="mobile_phone" name="mobile_phone" placeholder="กรุณากรอกเบอร์โทรศัพท์มือถือ..." require>
                        </div>
                        <!-- row -->
                        <div class="col-sm-6 mt-3">
                            <label for="email" class="form-label">อีเมล<span class="text-danger">*</span></label>
                            <input autocomplete="off" type="text" class="form-control" id="email" name="email" placeholder="กรุณากรอกอีเมล..." require>
                        </div>
                        <div class="col-sm-6 mt-3">
                            <label for="emailcf" class="form-label">ยืนยันอีเมล<span class="text-danger">*</span></label>
                            <input autocomplete="off" type="text" class="form-control" id="emailcf" name="emailcf" placeholder="กรุณายืนยันอีเมล..." require>
                        </div>

                        <!-- row -->
                        <div class="col-sm-12 mt-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-2" role="alert">ท่านเป็นผู้ปฏิบัติงานด้านการสอบบัญชีประเภทใด<span class="text-danger">*</span></div>
                                    <label for="career" class="error success"></label>
                                    <div class="form-check">
                                        <input class="form-check-input" id="career1" type="radio" name="career" value="ผู้สอบบัญชีรับอนุญาต" require>
                                        <label class="form-check-label" for="career">
                                            ผู้สอบบัญชีรับอนุญาต
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" id="career2" type="radio" name="career" value="ผู้ช่วยผู้สอบบัญชี" require>
                                        <label class="form-check-label" for="career">
                                            ผู้ช่วยผู้สอบบัญชี
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" id="career3" type="radio" name="career" value="อาจารย์ - นักศึกษาในสถาบันการศึกษา" require>
                                        <label class="form-check-label" for="career">
                                            อาจารย์ - นักศึกษาในสถาบันการศึกษา
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" id="morecheck" type="radio" name="career" require>
                                        <label class="form-check-label" for="career">
                                            อื่นๆ
                                        </label>
                                        <input class="form-control form-control-sm" name="othercareer" type="text" placeholder="ข้อมูลอื่นๆ..." id="morecareer" style="display: none" require>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- row -->
                        <div class="col-sm-12">
                            <div class="form-check mt-3">
                                <label class="form-check-label text-danger" style="font-size: 15px;"><span class="text-danger">*</span> กรุณาอ่านเพิ่มเพื่อให้ความยินยอมเกี่ยวกับข้อมูลส่วนบุคคล
                                    <button id="readmore" class="btn btn-warning btn-sm">อ่านเพิ่ม</button>
                                </label>
                                <label for="check_read" class="error"></label>
                            </div>
                            <div class="col-sm-12">
                                <div id="show_readmore" style="display: none;">
                                    <?php require_once("../components/more_info.php") ?>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 mt-2">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="readmore_b" name="readmore_b" require>
                                <label class="form-check-label" style="font-size: 15px;"><span class="text-danger">กรุณาอ่านข้อความและยอมรับเงื่อนไขลิขสิทธิ์ ก่อนดาวน์โหลดเอกสาร (ห้ามนำไปจำหน่าย)</span></label>
                            </div>
                            <?php require_once("../components/readmore.php") ?>
                        </div>
                        <div class="col-sm-12 mt-3">
                            <button type="submit" name="submit" class="btn btn-success w-100 fs-4">บันทึกข้อมูล และดาวน์โหลด</button>
                        </div>

                    </div> <!-- row -->
                </form>
            </div> <!-- card-body -->
        </div> <!-- card -->
    </div>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $file =  $("#file").val();
            $idfile =  $("#idfile").val();
            // validation and insert data
            $("#form_insert").validate({
                submitHandler: function(form) {
                    Swal.fire({
                        title: "ต้องการลงทะเบียนและดาวน์โหลดใช่หรือไม่?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "ใช่!",
                        cancelButtonText: "ไม่!",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "POST",
                                url: "../../backend/insert_form_dl.php",
                                data: $("#form_insert").serialize(),
                                success: function(response) {
                                    Swal.fire({
                                        title: 'สำเร็จ',
                                        text: 'เพิ่มข้อมูลเรียบร้อย',
                                        icon: 'success',
                                        timer: 1000,
                                        showConfirmButton: false
                                    });
                                    $('#form_insert')[0].reset();
                                    window.location.href = "../../backend/downloads_db.php?file="+$file+"&id="+$idfile;
                                },
                            });
                        }
                    });
                },
                rules: {
                    title_name: {
                        required: true,
                    },
                    first_name: {
                        required: true,
                    },
                    last_name: {
                        required: true,
                    },
                    company: {
                        required: true,
                    },
                    mobile_phone: {
                        required: true,
                        number: true,
                        minlength: 10,
                        maxlength: 10,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    emailcf: {
                        required: true,
                        equalTo: "#email",
                    },
                    career: {
                        required: true,
                    },
                    check_read: {
                        required: true,
                    },
                    readmore_b: {
                        required: true,
                    },
                    cf: {
                        required: true,
                    },
                    file: {
                        required: true,
                    },
                },
                messages: {
                    title_name: {
                        required: "กรุณากรอกคำนำหน้าชื่อ",
                    },
                    first_name: {
                        required: "กรุณากรอกชื่อ",
                    },
                    last_name: {
                        required: "กรุณากรอกนามสกุล",
                    },
                    company: {
                        required: "กรุณากรอกชื่อบริษัท",
                    },
                    mobile_phone: {
                        required: "กรุณากรอกเบอร์โทรมือถือ",
                        number: "กรุณากรอกเบอร์โทรมือถือให้ถูกต้อง",
                        minlength: "กรุณากรอกเบอร์โทรมือถือให้ครบ",
                        maxlength: "กรุณากรอกเบอร์โทรมือถือให้ถูกต้อง",
                    },
                    email: {
                        required: "กรุณากรอกอีเมล",
                        email: "กรุณากรอกอีเมลให้ถูกต้อง",
                    },
                    emailcf: {
                        required: "กรุณากรอกยืนยันอีเมล",
                        equalTo: "กรุณากรอกยืนยันอีเมลให้ตรงกับอีเมล",
                    },
                    career: {
                        required: "กรุณาเลือก",
                    },
                    check_read: {
                        required: "กรุณายินยอม*",
                    },
                    readmore_b: {
                        required: "*",
                    },
                    cf: {
                        required: "*",
                    },
                    file: {
                        required: "กรุณาเลือกโปรแกรมที่จะดาวน์โหลด",
                    },
                },
            });
            $("#readmore").click(function(e) {
                e.preventDefault();
                $("#show_readmore").slideToggle();
            });
            $("#readmore_b").change(function() {
                if (this.checked) {
                    $("#readmore_bb").modal("show");
                } else {
                    $("#readmore_bb").modal("hide");
                }
            });
            // career
            $("#morecheck").click(function() {
                $("#morecareer").css("display", "block");
            });

            $("#career1").click(function() {
                $("#morecareer").css("display", "none");
            });
            $("#career2").click(function() {
                $("#morecareer").css("display", "none");
            });
            $("#career3").click(function() {
                $("#morecareer").css("display", "none");
            });
        })
    </script>
</body>
</html>