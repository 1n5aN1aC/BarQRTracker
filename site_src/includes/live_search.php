<?php
include 'core/init.php';
protect_page();

//this needs fixed, but I don't know the database tables enough yet to fix it.
@mysql_select_db("joshua_class") or die("Unable to select database");
$result = mysql_query("SELECT * FROM SERVERS WHERE Server_Name LIKE '%" . $_GET["s"] . "%' LIMIT 0, 6");

//Output Table openings
echo "<center><table border='1'><tr>
<th>Food Name</th>
<th>ID Number</th>
<th>Calories</th>
<th>etc</th>
<th>etc</th>
</tr>";

//Operate on the results
while($row = mysql_fetch_array($result))
{
  echo "<tr><td>";
  echo $row['Food_Name'] . "</td><td>" . $row['ID_Number'];
  echo "<td><a href='https://rt.oregonsdc.org/Ticket/Display.html?id=" . $row[calories] . "'>" . $row[calories] . "</a></td>";
  echo "<td><a href='#' onclick=removesubmit(" . $row[Server_ID] . ")><img src='img/Delete_Icon.png' alt='Delete'/></a></td>";
  echo "<td><a href='Edit.php?s=" . $row[Server_ID] . "'><img src='img/Edit_Icon.png' alt='Edit'/></a></td>";
  echo "</td></tr>";
}

//end the table
echo "</table></center>";
  
include 'includes/overall/footer.php';
?>