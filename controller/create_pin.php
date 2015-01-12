<?php
$pin=intval($_POST['pin']);
mysql_connect("127.0.0.1","root","");
mysql_select_db("tedmon");
$i=0;
while($i < $pin){
  $rand=rand(111111111,999999999);
  $insert=mysql_query("INSERT INTO pin_code(id,code) VALUES(null,'$rand')");
  if($insert){
  echo "A pin has been created!" . " " . $rand;
  }
  else {
  echo "Error:" . mysql_error();
  }
  $i++;
  }

?>

<html>
<body>
<form method="post">
No of Pins:<input type="text" name="pin"><input type="submit" value="Create PIN Code!">

</form>

</body>

</html>