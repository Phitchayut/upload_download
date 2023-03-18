<?php 
    require_once("./config/connect.php");
    if (isset($_POST['doc_name'])) {
        $doc_name = $_POST['doc_name'];
    
        $stmt = $conn->prepare("SELECT COUNT(*) FROM tbl_upload WHERE doc_name = ?");
        $stmt->execute([$doc_name]);
        $result = $stmt->fetchColumn();
    
        if ($result > 0) {
            echo '<span style="color: red;">ชื่อซ้ำ กรุณากรอกชื่อใหม่.</span>';
        } else {
            echo '<span style="color: green;">ชื่อนี้สามารถใช้ได้.</span>';
        }
    }
