
    <?php
    require_once("../../../../backend/config/connect2.php");

    if (isset($_POST["from_date"], $_POST["to_date"])) {
        $output = "";
        $query = "SELECT * FROM tbl_download WHERE created_at BETWEEN '" . $_POST["from_date"] . "' AND '" . $_POST["to_date"] . "'";
        $result = mysqli_query($con, $query);
        $output .= '
    <table class="table table table-bordered table-striped text-center" style="width:100%">
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
                            </tr>';

        if (mysqli_num_rows($result) > 0) {
            $i = 0;
            while ($row = mysqli_fetch_array($result)) {
                $i++;
                $output .= '
            <tr>
            <td>' . $i . '</td>
            <td>' . $row['title_name'] . $row['first_name'] . ' ' . $row['last_name'] . '</td>
            <td>' . $row["company"] . '</td>
            <td>' . $row["mobile_phone"] . '</td>
            <td>' . $row["email"] . '</td>
            <td>' . $row["career"] . '</td>
            <td>' . $row["file_name"] . '</td>
            <td>' . $row['created_at'] . '</td>
            </tr>';
            }
        } else {
            $output .= '
        <tr>
        <td colspan="8">ไม่พบข้อมูล</td>
        </tr>';
        }
        $output .= '</table>';
        $output .= '<div class="row mt-3 mb-3">
        <div class="col text-center">
        <a href="admin_report_download.php" class="btn btn-danger"><i class="fa fa-repeat"></i></a></div>
                      </div>';
        echo $output;
    }
    ?>

