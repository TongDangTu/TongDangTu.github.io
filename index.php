<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bài 2</title>

</head>
<body>
    <a href="./"><button>Trở về thư mục gốc của dự án</button></a>
    <br><br>

    <form action="index_action.php" method="POST" enctype="multipart/form-data">
        </font></center>
        <table align="center">
            <tr>
                <td>Họ và tên</td>
                <td><input type="text" name="txtName"></td>
            </tr>
            <tr>
                <td>MSSV</td>
                <td><input type="text" name="txtID"></td>
            </tr>
            <tr>
                <td>Lớp quản lý</td>
                <td><input type="text" name="txtClass"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="txtEmail"></td>
            </tr>
            <tr>
                <td>Số điện thoại</td>
                <td><input type="text" name="txtPhoneNumber"></td>
            </tr>
            <tr>
                <td>Địa chỉ</td>
                <td><input type="text" name="txtAddress"></td>
            </tr>
            <tr>
                <td>Giới tính</td>
                <td>
                    Nam <input type="radio" name="radioGender" value="Nam">
                    Nữ <input type="radio" name="radioGender" value="Nữ">
                    Khác <input type="radio" name="radioGender" value="Khác">
                </td>
            </tr>
            <tr>
                <td>Ảnh</td>
                <td>
                    <input type="file" name="fileImage">
                </td>
            </tr>
            <tr>
                <td colspan=2>
                    <input type="submit" value="Đăng ký">
                    <input type="reset" value="Reset">
                </td>
            </tr>
        </table>
    </form>
    <center><font color="red">
<?php
    if (isset($_SESSION['errorNotification']) == true) {
        echo $_SESSION['errorNotification'];
    }
?>
</body>
</html>