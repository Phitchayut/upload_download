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
        <div class="card mt-5">
            <div class="card-body text-center">
                <h4><?= $row['doc_file'] ?></h4>
                <a href="../../backend/download_db.php?file=<?php echo $row['doc_file']; ?>&id=<?php echo $row['id']; ?>" class="btn btn-success btn-sm fs-3 mt-3">คลิกเพื่อดาวน์โหลดเอกสาร</a>
            </div>
        </div>
    </div>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>
</body>

</html>