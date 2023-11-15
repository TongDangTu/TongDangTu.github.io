<?php
    date_default_timezone_set("Asia/Bangkok");
    session_start();

    $name;
    $ID;
    $class;
    $email;
    $phoneNumber;
    $address;
    $gender;
    $image;

    function check_form() {
        $isValidImage = isValidImage();
        if (empty($_POST['txtName']) || empty($_POST['txtID']) || empty($_POST['txtClass']) ||
            empty($_POST['txtEmail']) || empty($_POST['txtPhoneNumber']) || empty($_POST['txtAddress']) ||
            empty($_POST['radioGender']) || ($_FILES["fileImage"]["size"] = 0)) 
        {
            $_SESSION['errorNotification'] = "Bắt buộc phải nhập tất cả các trường dữ liệu";
            return false;
        }
        else {
            $_SESSION['errorNotification'] = "";
            $GLOBALS['name'] =  testInput($_POST['txtName']);
            $GLOBALS['ID'] = testInput($_POST['txtID']);
            $GLOBALS['class'] = ($_POST['txtClass']);
            $GLOBALS['email'] = ($_POST['txtEmail']);
            $GLOBALS['phoneNumber'] = ($_POST['txtPhoneNumber']);
            $GLOBALS['address'] = ($_POST['txtAddress']);
            $GLOBALS['gender'] = ($_POST['radioGender']);
            if ((isValidName() && isValidID() && isValidPhoneNumber() && isValidEmail() && $isValidImage) == true) {
                return true;
            }
            else {
                $_SESSION['errorNotification'] = $_SESSION['errorName'] .", ". $_SESSION['errorID'] .", ". $_SESSION['errorPhoneNumber'] .", ". $_SESSION['errorEmail'] .", ". $_SESSION['errorImageSize'] .", ". $_SESSION['errorImageExpand'];
                return false;
            }
        }
    } 
    
    function isValidName () {
        $text = $GLOBALS['name'];
        $pattern = "/.{25,}/";
        if (preg_match($pattern, $text) == "1") {
            $_SESSION['errorName'] = "Họ tên vượt quá 24 ký tự";
            return false;
        }
        else {
            $_SESSION['errorName'] = "";
            return true;
        }
    }

    function isValidID () {
        $text = $GLOBALS['ID'];
        $pattern = "/[^\d]/";
        if (preg_match($pattern, $text) == "1") {
            $_SESSION['errorID'] = "MSSV phải là kiểu số";
            return false;
        }
        else {
            $_SESSION['errorID'] = "";
            return true;
        }
    }

    function isValidPhoneNumber () {
        $text = $GLOBALS['phoneNumber'];
        $pattern = "/[^\d]/";
        if (preg_match($pattern, $text) == "1") {
            $_SESSION['errorPhoneNumber'] = "Số điện thoại phải là kiểu số";
            return false;
        }
        else {
            $_SESSION['errorPhoneNumber'] = "";
            return true;
        }
    }

    function isValidEmail () {
        $email = $GLOBALS['email'];
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) === true) {
            $_SESSION['errorEmail'] = "Email không đúng định dạng";
            return false;
        }
        else {
            $_SESSION['errorEmail'] = "";
            return true;
        }
    }

    function isValidImage () {
        $target_dir = ""; 
        $target_file = $target_dir . basename($_FILES["fileImage"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        if ($_FILES["fileImage"]["size"] > (5*1024*1024)) {
            $_SESSION['errorImageSize'] = "<br>Kích thước file quá lớn, vượt quá 5 MB.";
            $uploadOk = 0;
        }
    
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            $_SESSION['errorImageExpand'] = "Chỉ nhận tệp có đuôi JPG, JPEG, PNG, GIF.";
            $uploadOk = 0;
        }
    
        if ($uploadOk == 0) {
            echo "<br>Tệp tải lên không thành công.";
            return false;
        }
        else {
            if (move_uploaded_file($_FILES["fileImage"]["tmp_name"], $target_file)) {
                echo "<br>Tệp ". htmlspecialchars( basename( $_FILES["fileImage"]["name"])). " đã được upload.";
                $_SESSION['errorImageSize'] = "";
                $_SESSION['errorImageExpand'] = "";
                $GLOBALS['image'] = basename($_FILES["fileImage"]["name"]);
                return true;
            }
            else {
                echo "<br>Xảy ra lỗi khi tải tệp lên.";
                return false;
            }
        }
    }

    function testInput ($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function writeTxtFile () {
        $f = fopen("DangKy.txt", "a+");
        fwrite($f, "Họ và tên => ".$GLOBALS['name'] ."\n");
        fwrite($f, "MSSV => ".$GLOBALS['ID'] ."\n");
        fwrite($f, "Lớp quản lý => ".$GLOBALS['class'] ."\n");
        fwrite($f, "Email => ".$GLOBALS['email'] ."\n");
        fwrite($f, "Số điện thoại => ".$GLOBALS['phoneNumber'] ."\n");
        fwrite($f, "Địa chỉ => ".$GLOBALS['address'] ."\n");
        fwrite($f, "Ảnh => ". $GLOBALS['image'] ."\n");
        // fwrite($f, "Giới tính => ". $GLOBALS['gender'] ."\n");
        fwrite($f, "Thời gian => ". date("Y/m/d h:i:sa") ."\n");
        fclose($f);
    }
?>

<?php
    $isValid = check_form();
    if ($isValid == true) {
        writeTxtFile();
    }

    header("Location: tutd_211765_02.php");
    exit;
?>