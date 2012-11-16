<?php
$con = mysql_connect("localhost","class","t3mpP@wd");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("joshua_class", $con);

$sql="DELETE FROM SERVERS WHERE Server_ID='$_REQUEST[s]'";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
echo "1 record Deleted";
echo "</br><a href='#' onclick='javascript:location.reload(true)'>Close</a>";

mysql_close($con)
?>