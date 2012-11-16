<?php
include 'core/init.php';
protect_page();

//this needs fixed, but I don't know the database tables enough yet to know what to query to fix it.
@mysql_select_db("joshua_class") or die("Unable to select database");
$result = mysql_query("SELECT * FROM SERVERS WHERE Server_Name LIKE '%" . $_GET["s"] . "%' LIMIT 0, 6");

//Output Table openings
echo "<center><table border='1'><tr>
<th>Food Name</th>
<th>ID Number</th>
<th>Calories</th>
<th></th>
<th>etc</th>
</tr>";

//Operate on the results
while($row = mysql_fetch_array($result))
{
  echo "<tr><td>";
  echo $row['Food_Name'] . "</td><td>" . $row['ID_Number'];
  echo "<td><a href='https://rt.oregonsdc.org/Ticket/Display.html?id=" . $row[calories] . "'>" . $row[calories] . "</a></td>";
  echo "<td><a href='#' onclick=fooddetails(" . $row[ID_Number] . ")><img src='img/Food_Details.png' alt='Details'/></a></td>";
  echo "<td><a href='#' onclick=editfood(" . $row[ID_Number] . "')><img src='img/Edit_Icon.png' alt='Edit'/></a></td>";
  echo "</td></tr>";
}

//end the table
echo "</table></center>";
  
include 'includes/overall/footer.php';
?>