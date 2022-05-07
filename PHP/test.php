<?php

    $servername = "localhost";
    $username = "rizal";
    $password = "rizal";	
    $dbname = "test_send_val";

    $koneksi = new mysqli($servername, $username, $password, $dbname);

    date_default_timezone_set('Asia/Jakarta');
    $d = date("Y-m-d");
    $t = date("H:i:s");

    if(!empty($_POST['Data1']))
    {   
        var_dump($_POST["Data1"]);
		$Da1 = $_POST['Data1'];
        $Da2 = $_POST['Data2'];
        $Da3 = $_POST['Data3'];
        $Da4 = $_POST['Data4'];
	    $sql = "INSERT INTO  tabel_val VALUES ('', '$Da1', '$Da2', '$Da3', '$Da4', '$d', '$t')";
        mysqli_query($koneksi, $sql);
		var_dump($_POST["Data1"]);
	}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>View Table</title>
        <link rel="stylesheet" type="text/css" href="css1.css">
    </head>
    
    <body>
        <table>
            <tr>
                <th>No</th> 
                <th>Data1</th> 
                <th>Data2</th>
                <th>Data3</th>
                <th>Data4</th>
                <th>Date</th>
                <th>Time</th>
                <th>ID</th>
            </tr>
            <?php $i = 1; ?>    
            <?php
                $table = mysqli_query($koneksi, "SELECT No, Data1, Data2, Data3, Data4, Date, Time FROM tabel_val ORDER BY No DESC LIMIT 10"); 
                while($row = mysqli_fetch_array($table))
                {
            ?>

            <tr>
                <td><?php echo $i; $i++;?></td>
                <td><?php echo $row["Data1"]; ?></td>
                <td><?php echo $row["Data2"]; ?></td>
                <td><?php echo $row["Data3"]; ?></td>
                <td><?php echo $row["Data4"]; ?></td>
                <td><?php echo $row["Date"]; ?></td>
                <td><?php echo $row["Time"]; ?></td>
                <td><?php echo $row["No"]; ?></td>
            </tr>
            <?php
                }
            ?>
        </table>
    </body>
</html>