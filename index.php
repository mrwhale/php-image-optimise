<?php
session_start();
//todo sessions so only the session can access the files uploaded
if (!isset($_SESSION['folder'])) {
    $_SESSION['folder'] = uniqid(rand());
  }
  echo $_SESSION['folder'];
  
?>
<html>
 
<head>   
 
<!-- 1 -->
<link href="css/dropzone.css" type="text/css" rel="stylesheet" />
 
<!-- 2 -->
<script src="dropzone.js"></script>
 
</head>
 
<body>
 
<!-- 3 -->
<form action="upload.php" class="dropzone">
Resize? <input checked type="checkbox" name="resize" value="resize" > <br/>
Size?<input type="number" name="size" value="1024"><br/>
Progressive?<input checked type="checkbox" name="progressive" value="progressive" > <br/></form>

<a href="view.php">View all images</a> 

</body>
 
</html>