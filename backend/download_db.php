<?php 
   require_once ("./config/connect.php");
    if(isset($_GET['file']) && ($_GET['id'])){
        $id = $_GET['id'];
        $stmt = $conn->prepare("UPDATE tbl_upload SET count_download=count_download+1 WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        
        $filename = basename($_GET['file']);
        $filepath = '../frontend/upload/file/'.$filename;
        if(!empty($filename) && file_exists($filepath)){
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$filename");
            header("Content-Type: application/zip");
            header("Content-Transfer-Emcoding: binary");

            readfile($filepath);
            exit;
        }else{
            echo "This File Does not Exist.";
        }
    }


?>