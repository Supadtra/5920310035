<meta charset="UTF-8">
<?php
include('connection.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี

if (isset($_POST['verify'])){
    $ID=$_POST['IdS'];
    $query2 = "SELECT * FROM gradebc WHERE ID='$ID'" or die("ERROR:".mysql_error());
    $result2 = mysqli_query($con, $query2);
    echo "<table border='1' align='center' width='500'>";
    echo "<tr align='center' bgcolor='#CCCCCC'><td>ID</td><td>Code</td><td>Year</td><td>Seme</td><td>Grade</td><td>Response</td></tr>";
    while($row = mysqli_fetch_array($result2)) { 
        echo "<tr>";
        echo "<td align='center'>" .$row["ID"] .  "</td> "; 
        echo "<td align='center'>" .$row["Code"] .  "</td> ";  
        echo "<td align='center'>" .$row["Year"] .  "</td> ";
        echo "<td align='center'>" .$row["Seme"] .  "</td> ";
        echo "<td align='center'>" .$row["Grade"] .  "</td> ";
       
        $data = array("stdid" => $row["ID"] ,
                    "code" => $row["Code"],
                    "grade" =>$row["Grade"] ,
                    "year" => $row["Year"],
                    "seme" => $row["Seme"]);
        
        $data_string = json_encode($data);
        #echo "data send: ".$data_string."<br>";

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,"http://localhost:2000/cp");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $result = curl_exec($ch);
        $arr = json_decode($result);
        echo "<td align='center'>" .$arr->res_code. "</td> ";
        #echo "<td align='center'>" .$arr->valid. "</td> ";
        curl_close($ch);
        echo "</tr>";    
                }
}
if (isset($_POST['VerAll'])){
    $query3 = "SELECT * FROM gradebc " or die("ERROR:".mysql_error());
    $rsAll = mysqli_query($con, $query3);
    echo "<table border='1' align='center' width='500'>";
    echo "<tr align='center' bgcolor='#CCCCCC'><td>ID</td><td>Code</td><td>Year</td><td>Seme</td><td>Grade</td><td>Response</td></tr>";
    while($row = mysqli_fetch_array($rsAll)) { 
        echo "<tr>";
    echo "<td align='center'>" .$row["ID"] .  "</td> "; 
    echo "<td align='center'>" .$row["Code"] .  "</td> ";  
    echo "<td align='center'>" .$row["Year"] .  "</td> ";
    echo "<td align='center'>" .$row["Seme"] .  "</td> ";
    echo "<td align='center'>" .$row["Grade"] .  "</td> ";
    
    $data = array("stdid" => $row["ID"] ,
                    "code" => $row["Code"],
                    "grade" =>$row["Grade"] ,
                    "year" => $row["Year"],
                    "seme" => $row["Seme"]);
        
        $data_string = json_encode($data);
        #echo "data send: ".$data_string."<br>";

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,"http://localhost:2000/cp");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $result = curl_exec($ch);
        $arr = json_decode($result);
        echo "<td align='center'>" .$arr->res_code. "</td> ";
        #echo "<td align='center'>" .$arr->valid. "</td> ";
        curl_close($ch);
        echo "</tr>";    
                }
}

?>

