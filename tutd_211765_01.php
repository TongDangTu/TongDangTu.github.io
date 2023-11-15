<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bài 1</title>

</head>
<body>
    <a href="./"><button>Trở về thư mục gốc của dự án</button></a>
    <br><br>

<?php
    for ($i = 6; $i >= 1; $i--) {
        for ($j = $i; $j >= 1; $j--) {
            echo("*");
        }
        echo("<br>");
    }
?>
</body>
</html>