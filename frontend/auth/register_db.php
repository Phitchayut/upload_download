<?php 
    session_start();
    require_once '../../backend/config/connect.php';

    if(isset($_POST['register'])) {
        $username = $_POST['username'];
        $department = $_POST['department'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = 'user';

        if (empty($username)) {
            $_SESSION['error'] = 'กรุณากรอก Username';
            header("location: register_form.php");
        } else if (empty($department)) {
            $_SESSION['error'] = 'กรุณากรอก Department';
            header("location: register_form.php");
        } else if (empty($email)) {
            $_SESSION['error'] = 'กรุณากรอก Email';
            header("location: register_form.php");
        } else if (empty($password)) {
            $_SESSION['error'] = 'กรุณากรอก Password';
            header("location: register_form.php");
        } else if (strlen($_POST['password']) > 12 || strlen($_POST['password']) < 5) {
            $_SESSION['error'] = 'รหัสผ่านต้องมีความยาว ระหว่าง 5 ถึง 12 ตัวอักษร';
            header("location: register_form.php");
        } else {
            try {
                $check_email = $conn->prepare("SELECT email FROM tbl_user WHERE email = :email");
                $check_email->bindParam(":email",$email);
                $check_email->execute();
                $row = $check_email->fetch(PDO::FETCH_ASSOC);

                if ($row['email'] == $email) {
                    $_SESSION['warning'] = "คุณเคยลงทะเบียนแล้ว";
                    header("location: register_form.php");
                } else if (!isset($_SESSION['error'])) {
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $conn->prepare("INSERT INTO tbl_user (username,department,email,password,role)
                    VALUES (:username,:department,:email,:password,:role)");
                    $stmt->bindParam(":username", $username);
                    $stmt->bindParam(":department", $department);
                    $stmt->bindParam(":email", $email);
                    $stmt->bindParam(":password", $passwordHash);
                    $stmt->bindParam(":role", $role);
                    $stmt->execute();

                    $_SESSION['success'] = "สมัครสมาชิกเรียบร้อยแล้ว! <a href='../../index.php' class='alert-link'>คลิ๊กที่นี่</a> เพื่อเข้าสู่ระบบ";
                    header("location: register_form.php");
                } else {
                    $_SESSION['error'] = "มีบางอย่างผิดพลาด";
                    header("location: register_form.php");
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }

?>