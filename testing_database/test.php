<?php
//Creates new record as per request
    //Connect to database
    $servername = "localhost";		//example = localhost or 192.168.0.0
    $username = "rizal";		//example = root
    $password = "rizal";	
    $dbname = "nodemcu_ldr";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    //Get current date and time
    date_default_timezone_set('Asia/Jakarta');
    $d = date("Y-m-d");
    $t = date("H:i:s");

    if(!empty($_POST['ldrvalue']))
    {
		$ldrvalue = $_POST['ldrvalue'];
        $Da2 = $_POST['Data2'];
        $Da3 = $_POST['Data3'];
        $Da4 = $_POST['Data4'];
	    $sql = "INSERT INTO  nodemcu_ldr_table VALUES ('', '$ldrvalue', '$Da2', '$Da3', '$Da4', '$d', '$t')";
        mysqli_query($conn, $sql);
		
	}

?>

<!DOCTYPE html>
<html>
    <head>
        
    </head>
    
    <body>
        <table>
            <tr>
                <th>No</th> 
                <th>Test Value</th> 
                <th>Data2</th>
                <th>Data3</th>
                <th>Data4</th>
                <th>Date</th>
                <th>Time</th>
                <th>ID</th>
            </tr>
            <?php $i = 1; ?>    
            <?php
                $table = mysqli_query($conn, "SELECT No, Ldr, Data2, Data3, Data4, Date, Time FROM nodemcu_ldr_table ORDER BY No DESC LIMIT 10"); //nodemcu_ldr_table = Youre_table_name
                while($row = mysqli_fetch_array($table))
                {
            ?>

            <tr>
                <td><?php echo $i; $i++;?></td>
                <td><?php echo $row["Ldr"]; ?></td>
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