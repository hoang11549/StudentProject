<?php
require_once('dbhelp.php');
session_start();

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- jQuery library -->

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>

    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 style="text-align: center;"> Manager Student</h2>
                <h4 style="float: left;"> Welcome,<?= $_SESSION["user"]; ?></h4>
                <a href="logout.php" style="float: right;">Log Out</a>
            </div>
            <?php $check = true; ?>
            <div class="panel-body">
                <form>
                    <div class="input-group">
                        <div class="form-outline">
                            <input type="search" id="form1" class="form-control" placeholder="SEARCH" onkeyup="searchLive(this.value)" />
                        </div>

                    </div>
                </form>
                <?php if ($check == true) { ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>STT </th>
                                <th>Full name
                                </th>
                                <th> Age
                                </th>
                                <th>email</th>
                                <th>Image</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="tableStudent">
                            <?php $sql = 'select * from student';

                            $studenList = excuteResult($sql);
                            $i = 1;

                            foreach ($studenList as $std) {
                                echo '<tr>
                            <td>' . $i . '</td>
                            <td>' . $std['fullname'] . '</td>
                            <td>' . $std['age'] . '</td>
                            <td>' . $std['email'] . '</td>
                            
                            <td><img style=" width: 80px;
                            height: 80px;
                            " src="' . $std['file_path'] . '"/>
                            <td><button class="btn btn-warning" onclick=\'window.open("input.php?id=' . $std['id'] . '","_self") \'>Edit</button></td>
                            <td><button class="btn btn-danger" onclick="deleteStudent(' . $std['id'] . ')">DELETE</button></td>
                        </tr>';
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>
                <?php } ?>

                <button class="btn btn-success" onclick="window.open('input.php','_SELF')"> Add Student</button>
            </div>

        </div>
    </div>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>
    <script type="text/javascript">
        function deleteStudent(id) {
            option = confirm('Are you sure')
            if (!option) {
                return;
            }
            $.post('DeleteStudent.php', {
                'id': id
            }, function(data) {
                alert(data)
                location.reload()
            })
        }

        function searchLive(inputSearch) {
            // if (inputSearch != '') {
            <?php $checkx = false;
            $check = &$checkx;
            ?>
            $.ajax({
                method: 'POST',
                url: 'search.php',
                data: {
                    inputSearch: inputSearch,

                },
                success: function(data) {
                    // var row = document.getElementById("#tableStudent");
                    // row.innerHTML += data;
                    $("#tableStudent").html(data);
                }

            })
            // }


        }
    </script>

</body>

</html>