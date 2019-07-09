<?php
    include_once('connect.php');
    if (isset($_GET['action']))
    {
        $action = $_GET['action'];
        switch ($action){
        case 'delete':
            $id = $_GET['id'];
            $id = mysqli_escape_string($conn, $id);
            if (is_numeric($id)){
                mysqli_query($conn, 'DELETE FROM `users` WHERE `id` = '.$id);
            }
            break;
        case 'edit':
            $id = $_GET['id'];
            header('Location: edit.php?id='.$id);
        }
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>City name</td>
        </tr>
        <tr>
            <?php
                $sql = 'SELECT * FROM `users` inner join `cities` on `users`.`id_city`=`cities`.`id`';
                $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                if(mysqli_num_rows($result)>0){
                    while ($row = mysqli_fetch_assoc($result)){
                        echo '<tr>';
                        echo '<td>'.$row['id'].'</td>';
                        echo '<td>'.$row['name'].'</td>';
                        echo '<td>'.$row['city_name'].'</td>';
                        echo '<td>
                                <a href="?action=delete&id='.$row['id'].'">Xoa</a>
                                <a href="?action=edit&id='.$row['id'].'">Sua</a>
                            </td>';
                        echo '</tr>';
                    }
                }
                ?>
        </tr>
    </table>
</body>
</html>