<?php
session_start();
require_once '../../../../backend/config/connect.php';
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
    <title>รายงานผู้ดาวน์โหลดเอกสาร</title>
    <link rel="stylesheet" href="../../../../style.css">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
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
        <?php require_once("navbar_report.php") ?>
    </div>
    <div class="container">
        <div class="card mt-2">
            <div class="card-body">

                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-2 mb-2">
                        <input type="text" name="from_date" id="from_date" class="form-control dateFilter" placeholder="From Date" />
                    </div>
                    <div class="col-md-2 mb-2">
                        <input type="text" name="to_date" id="to_date" class="form-control dateFilter" placeholder="To Date" />
                    </div>
                    <div class="col-md-2">
                        <input type="button" name="search" id="btn_search" value="Search" class="btn btn-primary" />
                    </div>
                    <div class="col-md-3"></div>
                </div>
                <div class="table-responsive mt-3" id="search_data">
                    <table class="table table table-bordered table-striped text-center" id="myTable" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">ลำดับ</th>
                                <th class="text-center" style="width: 20%" scope="col">ชื่อ-สกุล</th>
                                <th class="text-center" scope="col">บริษัท</th>
                                <th class="text-center" scope="col">เบอร์โทรศัพท์</th>
                                <th class="text-center" scope="col">อีเมล</th>
                                <th class="text-center" scope="col">อาชีพ</th>
                                <th class="text-center" scope="col">ไฟล์ที่ดาวน์โหลด</th>
                                <th class="text-center" scope="col">วันที่ดาวน์โหลด</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 15px;">
                            <?php
                            $stmt = $conn->prepare("SELECT * FROM tbl_download ");
                            $stmt->execute();
                            $result = $stmt->fetchAll();
                            $i = 0;
                            foreach ($result as $row) {
                                $timestamp = $row['created_at'];
                                $i++;
                            ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td class="text-start"><?= $row['title_name'] . $row['first_name'] . ' ' . $row['last_name'] ?></td>
                                    <td class="text-start"><?= $row['company'] ?></td>
                                    <td><?= $row['mobile_phone'] ?></td>
                                    <td class="text-start"><?= $row['email'] ?></td>
                                    <td><?= $row['career'] ?></td>
                                    <td><?= $row['file_name'] ?></td>
                                    <td><?= date('Y-m-d', strtotime($timestamp)) ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.4.js"></script>
    <!-- dataTable -->
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.colVis.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>
        $(document).ready(function() {
            // datatable
            $('#myTable').DataTable({
                "dom": "<'row'<'col-sm-6 mt-1'B><'col-sm-6 text-end'>>" + "<'row'<'col-sm-6 mt-1'l><'col-sm-6 mt-1 text-end'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-4'i><'col-sm-4 text-center'><'col-sm-4'p>>",
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                buttons: [{
                    extend: 'excel',
                    text: 'ดาวน์โหลดข้อมูล <i class="fa-solid fa-download"></i>',
                    className: 'btn-success'
                }]
            });

            $('.dateFilter').datepicker({
                dateFormat: "yy-mm-dd"
            });

            $('#btn_search').click(function() {
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();
                if (from_date != '' && to_date != '') {
                    $.ajax({
                        url: "search.php",
                        method: "POST",
                        data: {
                            from_date: from_date,
                            to_date: to_date
                        },
                        success: function(data) {
                            $('#search_data').html(data);
                        }
                    });
                } else {
                    alert("Please Select the Date");
                }
            });
        })
    </script>

</body>

</html>