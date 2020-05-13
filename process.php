<?php

$fp = fopen($_FILES['fileToUpload']['tmp_name'], 'r');
echo "<table border='1' align='center' width='500'>";
echo "<tr align='center' bgcolor='#CCCCCC'><td>ID</td><td>Code</td><td>Year</td><td>Seme</td><td>Grade</td><td>Creator</td><td>Response</td></tr>";
while (($line = fgetcsv($fp)) !== FALSE) {
   echo "<tr>";
        echo "<td align='center'>" .$line[0] .  "</td> "; 
        echo "<td align='center'>" .$line[1] .  "</td> ";  
        echo "<td align='center'>" .$line[2].  "</td> ";
        echo "<td align='center'>" .$line[3] .  "</td> ";
        echo "<td align='center'>" .$line[4] .  "</td> ";
        echo "<td align='center'>" .$line[5] .  "</td> ";
   $data = array("stdid" => $line[0],
                "code" => $line[1],
                "grade" => $line[4],
                "year" => $line[2],
                "seme" => $line[3],
                "creator" => $line[5]);                                                         

   $data_string = json_encode($data);
   #echo "data send: ".$data_string."<br>";

   $url = "http:2000//localhost/add";   

   $ch = curl_init();
   curl_setopt($ch,CURLOPT_URL,"http://localhost:2000/add");
   curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
   curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   
   $result = curl_exec($ch);
   $arr = json_decode($result);
   echo  "<td align='center'>" .$arr->res_code."</td> ";
   echo "<br>";
   curl_close($ch);

}
?>