<?php
require_once('dbhelp.php');
if (isset($_POST['inputSearch'])) {
    $dataSearch = $_POST['inputSearch'];
    $sql = "select * from student where fullname like " . "'%" . $dataSearch . "%'";
    $studenList = excuteResult($sql);
    if (count($studenList) > 0) {
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
            // echo "<tr>" .
            //     " <td>' . \$i . '</td>" .
            //     " <td>' . \$std['fullname'] . '</td>" .
            //     " <td>' . \$std['age'] . '</td>" .
            //     " <td>' . \$std['email'] . '</td>" .

            //     "<td><img style=" . " width: 80px;" .
            //     " height: 80px;" .
            //     "  src=\"' . \$std['file_path'] . '\"/>" .
            //     "<td><button class=\"btn btn-warning\" onclick=\'window.open(\"input.php?id=' . \$std['id'] . '\",\"_self\") \'>Edit</button></td>" .
            //     "<td><button class=\"btn btn-danger\" onclick=\"deleteStudent(' . \$std['id'] . ')\">DELETE</button></td>" .
            //     "</tr>";
            // $i++;
        }
    }
};
