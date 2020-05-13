
<!DOCTYPE html>
<html lang="en">
<style>
  .center{
    text-align: center;
    margin: 24px 0 200px 0;
    position: relative;
    padding: 80px;
  }
  
  
  </style>
<head>
  <title>blockchain api</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <div align="center"><h1>Call api blockchain</h1><br><br></div>
</head>
<body>
<div class=center><div class="row">
    <div class="col-sm-4" style="background-color:lavender;">
    <form action="process.php" method="post" enctype="multipart/form-data">
       <div align="center"><h1>Add grade</h1><br><br></div>
       <div align="center">Select file to upload:<br><br>
            <input type="file" name="fileToUpload" id="fileToUpload"><br>
            <input type="submit" value="Upload" name="submit"><br><br>
        </div></form>
    
    </div>
    <div class="col-sm-4" style="background-color:lavenderblush;">
    <form action="verify.php" method="post" enctype="multipart/form-data">
        <div align="center"><h1>Verify grade</h1><br><br></div>
        <div  align="center">Select data to verify:<br><br>
            <input type="text" name="IdS" id="IdS"><br><br>
            <input type="submit" value="Verify" name="verify">
            <input type="submit" value="All Verify" name="VerAll"><br><br>
            </div></form>
    </div>
    <div class="col-sm-4" style="background-color:lavender;">
    <form action="showdata.php" method="post" enctype="multipart/form-data">
            <div align="center"><h1>Search grade </h1><br><br></div>
            <div  align="center">Search grade student:<br><br>
            <input type="text" name="IdS" id="IdS"><br><br>
            <input type="submit" value="search" name="search"><br><br>
        </form>
    </div>
</div>
</body>
</html>
