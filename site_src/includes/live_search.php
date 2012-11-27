<?php
include 'core/init.php';
protect_page();

//this needs fixed, but I don't know the database tables enough yet to know what to query to fix it.
$result = mysql_query("SELECT * FROM Food WHERE Name LIKE '%" . $_GET["s"] . "%' LIMIT 0, 6");

//Output Table openings
echo "<center><table border='1'><tr>
<th>Food Name</th>
<th>Food ID</th>
<th>Calories</th>
<th>Fat</th>
<th>Add</th>
</tr>";

//Operate on the results
while($row = mysql_fetch_array($result))
{
  echo "<tr>";
  echo "<td>" . $row['Name'] . "</td>";
  echo "<td>" . $row['IDFood']; "</td>";
  echo "<td>" . $row['Calories'] . "</td>";
  echo "<td>" . $row['totalFat'] . "</td>";
  echo "<td><a href='#' onclick=addfood(" . $row[ID_Number] . "')><img src='img/Add_Icon.png' alt='Add'/></a></td>";
  echo "</td></tr>";
}

//end the table
echo "</table></center>";
  
include 'includes/overall/footer.php';
?>