<?php
require_once('dbhelp.php');

$s_fullname = $s_age = $s_email = '';
$folder_path = 'upload/';


if (!empty($_POST)) {
    $s_id = '';

    if (isset($_POST['fullname'])) {
        $s_fullname = $_POST['fullname'];
    }

    if (isset($_POST['age'])) {
        $s_age = $_POST['age'];
    }

    if (isset($_POST['email'])) {
        $s_email = $_POST['email'];
    }

    if (isset($_POST['id'])) {
        $s_id = $_POST['id'];
    }
    $flag_ok = true;
    $file_path = $folder_path . $_FILES['upload_file']['name'];
    if (isset($_POST["submit"])) {

        $check = getimagesize($_FILES["upload_file"]["tmp_name"]);
        if ($check != false) {
            echo "file is an image - " . $file_path . ".";
            $flag_ok = true;
        }
    }
    // Check trùng file
    // if (file_exists($file_path)) {
    //     echo 'File trung ten';
    //     $file_path = false;
    // }


    // check đuôi

    $ex = array('jpg', 'png', 'jpeg');
    $file_type = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
    if (!in_array($file_type, $ex)) {
        if (!$s_file) {
            echo 'file khong hop le';
        }

        $flag_ok = false;
    }
    //dung luong 
    if ($_FILES['upload_file']['size'] > 5000000) {
        if (!$s_file) {
            echo 'dun luong file tren 50mb';
        }

        $flag_ok = false;
    }
    if ($flag_ok) {
        move_uploaded_file($_FILES['upload_file']['tmp_name'], $file_path);
    } else {
        if (!$s_file) {
            echo 'khong upload duoc';
        }
    }


    $s_fullname = str_replace('\'', '\\\'', $s_fullname);
    $s_age      = str_replace('\'', '\\\'', $s_age);
    $s_email  = str_replace('\'', '\\\'', $s_email);
    $s_id       = str_replace('\'', '\\\'', $s_id);

    if ($s_id != '') {
        //update
        $sql = "update student set fullname = '$s_fullname', age = '$s_age', email = '$s_email' file_path='$file_path' where id = " . $s_id;
    } else {
        //insert
        $sql = "insert into student(fullname, age, email, file_path) value ('$s_fullname', '$s_age', '$s_email','$file_path')";
    }

    // echo $sql;

    excute($sql);

    header('Location: ManagerStudent.php');
    exit();
}
$id = '';
if (isset($_GET['id'])) {
    $id          = $_GET['id'];
    $sql         = 'select * from student where id = ' . $id;
    $studentList = excuteResult($sql);
    if ($studentList != null && count($studentList) > 0) {
        $std        = $studentList[0];
        $s_fullname = $std['fullname'];
        $s_age      = $std['age'];
        $s_email  = $std['email'];
        $s_file = $std['file_path'];
    } else {
        $id = '';
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Registation Form * Form Tutorial</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="text-center">Add Student</h2>
            </div>
            <div class="panel-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="usr">Name:</label>
                        <input type="number" name="id" value="<?= $id ?>" style="display: none;">
                        <input required="true" type="text" class="form-control" id="usr" name="fullname" value="<?= $s_fullname ?>">
                    </div>
                    <div class="form-group">
                        <label for="birthday">Age:</label>
                        <input type="number" class="form-control" id="age" name="age" value="<?= $s_age ?>">
                    </div>
                    <div class="form-group">
                        <label for="address">email:</label>
                        <input type="text" class="form-control" id="email" name="email" value="<?= $s_email ?>">

                    </div>
                    <div class="form-group">
                        <input type="file" name="upload_file">
                    </div>
                    <button class="btn btn-success">Save</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>