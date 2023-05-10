<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excel to MySQL</title>
</head>

<body>
<?php
require "./connect.php";
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_REQUEST['import-excel'])) {
    $file = $_FILES["excel-file"]["tmp_name"];
    $extension = pathinfo($_FILES["excel-file"]["name"],PATHINFO_EXTENSION);

    if($extension == 'xlsx' || $extension == 'xls' || $extension == 'csv') {
        $obj = PhpOffice\PhpSpreadsheet\IOFactory::load($file);
        $data = $obj->getActiveSheet()->toArray();

        foreach ($data as $row) {
            $province = $row['0'];
            $district = $row['1'];

            $insert_query = mysqli_query($dbcon, "INSERT INTO teste SET 	provincia='$province', distrito	='$district'");

            if ($insert_query) {
                $msg = "File Imported successfully";
            } else {
                $msg = "File not imported";
            }
        }
    } else {
        $msg = "Extension not valid!";
    }
}


?>




    <form method="POST" enctype="multipart/form-data">
        <label for="excel-file">Excel to MySQL</label>
        <input type="file" name="excel-file" required>
        <input type="submit" name="import-excel" value="Submit" />
        <p>
            <?php if (!empty($msg)) {
                echo $msg;
            } ?>
        </p>
    </form>
</body>

</html>