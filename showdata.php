<?php session_start(); ?>
<meta charset="UTF-8">
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.responsive {
  width: 100%;
  height: auto;
}
.headerT{
    width:100%
    border:10px while black;
    border-collapse: collapse;
    background-color: #f1f1c1;
}
.text{
    color:#000000;
    margin-left: auto;
    margin-right: auto;
}
.text2{
    color:#000077; 
}
</style>

</head>
<body>
<?php
include('connection.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี

if (isset($_POST['search'])){
    $_SESSION['ID']=$_POST['IdS'];
    $query3 = "SELECT * FROM gradebc WHERE ID='" .$_SESSION['ID']."'" or die("ERROR:".mysql_error());
    $rs = mysqli_query($con, $query3);
    while($row = mysqli_fetch_array($rs)) { 
    
    $data = array("stdid" => $row["ID"] ,
                    "code" => $row["Code"],
                    "grade" =>$row["Grade"] ,
                    "year" => $row["Year"],
                    "seme" => $row["Seme"]);

                    $creator=$row["Creator"];
                    $ID=$row["ID"];
                    $code=$row["Code"];
                    $year=$row["Year"];
                    $seme=$row["Seme"];
                    $grade=$row["Grade"];     
        $data_string = json_encode($data);
        #echo "data send: ".$data_string."<br>";

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,"http://localhost:2000/cp");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $result = curl_exec($ch);
        $arr = json_decode($result);
        #echo "<td align='center'>" .$arr->res_code. "</td> ";
        #echo "<td align='center'>" .$arr->valid. "</td> ";
       
        curl_close($ch);
        echo "</tr>";    
        if ($arr->res_code!=1){
            $f=1;
        }
  }
 
    if ($f==1){
        $data="ความถูกต้องของข้อมูลเกรดคุณ:ไม่ผ่าน";
        require_once('PHPMailer/PHPMailerAutoload.php');
        $mail = new PHPMailer(); 
        $mail->IsHTML(true);
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = ""; 
        $mail->Host = "ssl://smtp.gmail.com"; 
        $mail->Port = 465; 
        $mail->Username = "project.blockchain2563@gmail.com"; 
        $mail->Password = "[]Hvdg=o";
        $mail->FromName = "PSU PATTANI"; 
        $mail->Subject = "Grade:"; 

        $mail->Body = "Dear  $creator
                    <br><br>จากการตรวจสอบข้อมูลเกรดในฐานข้อมูลของ
                    
                    <br><br>$ID  <br>รหัสวิชา : $code
                    <br>ปีการศึกษา :$year  ภาคการศึกษา : $seme
                    <br>ได้เกรด : $grade  
                    <br><br><b>*** พบว่าข้อมูลไม่ถูกต้อง  *** <br><br></b>
                    <br>กรุณาตรวจสอบข้อมูลดังกล่าว
                    <br><b>กรุณาติดต่อ : ฝ่ายทะเบียนเพื่อตรวจสอบเกรดของนักศึกษา</b> <br>
                    <br><br>";
            
                    

                        $mail->AddAddress($s_email); 
                        $mail->AddBCC($creator); 

                        if($mail->Send())
                        {
                            echo 
                                "<script>
                                    window.alert('เกรดของคุณมีความผิดปกติ ระบบได้ส่งข้อความถึงอาจารย์ผู้สอนแล้ว ');
                                </script>"; 
                        }
                           
    }else{
        $data="ความถูกต้องของข้อมูลเกรดคุณ:ผ่าน";
    }
 
}
    echo "<a href='index.php'>";
    echo "<img src='mis2.png' alt='Mis Center PSU PATTANI' class=responsive>";
    echo "</a>";
    echo "<form  action='showdata.php'method='post' enctype='multipart/form-data'> ";
    echo "<table class='text2' >";
    echo " <tr><td ><p >รหัสนักศึกษา :</p></td>";
    echo "<td>";
    echo  $_SESSION['ID'];
    echo "&nbsp;<td align='center'>".$data. "</td> "; 
    echo "</td></tr></table>";
    echo "</table>";
    echo "<table class='text'><tr ><td>ภาคการศึกษา :</td>";
    echo "<td><select name='seme'>
            <option value='1'>1</option>
            <option value='2'>2</option>
            <option value='3'>summer</option>
        </select></td>&nbsp;

        <td>ปีการศึกษา :</td>
        <td><select name='year'>
            <option value='2563'>2563</option>
            <option value='2562'>2562</option>
            <option value='2561'>2561</option>
            <option value='2560'>2560</option>
        </select></td>&nbsp;

        <td><input type='submit' value='ค้นหา' name='find'></td>
        <td><input type='submit' value='ค้นหาทั้งหมด' name='all'></td>
        <td><input type='hidden' value='".$_SESSION['ID']."' name='id'></td>
        
        </form><br><br><table> <tr ><td><p><br></p>
           
        </tr></td></table>";


    switch (isset($_POST))
            {
                case isset($_POST['all']): 
                $seme=$_POST['seme'];  
                $year=$_POST['year']; 
                $ID=$_POST['id'];
               
                    $query = "SELECT * FROM gradebc WHERE ID='$ID'" or die("ERROR:".mysql_error());
                    $rsAll = mysqli_query($con, $query);
                
                        echo "<table border='1' align='center' width='500'>";
                        echo "<tr align='center' bgcolor='#CCCCCC'><td>ID</td><td>Code</td><td>Year</td><td>Seme</td><td>Grade</td></tr>";
                        while($row = mysqli_fetch_array($rsAll)) { 
                            echo "<tr bgcolor='#F0F0F0'>";
                        echo "<td align='center'>" .$row["ID"] .  "</td> "; 
                        echo "<td align='center'>" .$row["Code"] .  "</td> ";  
                        echo "<td align='center'>" .$row["Year"] .  "</td> ";
                        echo "<td align='center'>" .$row["Seme"] .  "</td> ";
                        echo "<td align='center'>" .$row["Grade"] .  "</td> ";    
                        echo "</tr>";  
                        
                }
                
                break;
                case isset($_POST['find']): 

                $seme=$_POST['seme'];  
                $year=$_POST['year']; 
                $ID=$_POST['id'];
                 
                $query = "SELECT * FROM gradebc WHERE ID='$ID' AND Seme='$seme' AND Year='$year' " or die("ERROR:".mysql_error());
                $rsAll = mysqli_query($con, $query);
              
                    echo "<table border='1' align='center' width='500'>";
                    echo "<tr align='center' bgcolor='#CCCCCC'><td>ID</td><td>Code</td><td>Year</td><td>Seme</td><td>Grade</td></tr>";
                    while($row = mysqli_fetch_array($rsAll)) { 
                        echo "<tr bgcolor='#F0F0F0'>";
                    echo "<td align='center'>" .$row["ID"] .  "</td> "; 
                    echo "<td align='center'>" .$row["Code"] .  "</td> ";  
                    echo "<td align='center'>" .$row["Year"] .  "</td> ";
                    echo "<td align='center'>" .$row["Seme"] .  "</td> ";
                    echo "<td align='center'>" .$row["Grade"] .  "</td> ";    
                    echo "</tr>";  }
            }
   
            
?>


            
            
          
