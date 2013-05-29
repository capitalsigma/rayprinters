<html> 
<body>

<?
// Function definitions

function write_cell($str)
{
    echo "<td>" . $str . "</td>";
}

function write_row($arr, $keys)
{
    foreach($keys as $key){
	write_cell($arr[$key]);
    }
}


function generate_form_val($row, $key)
{
    echo "<input type = \"hidden\" name = \"$key\" value = \"$row[$key]\">";
}

function generate_form_vals($row, $keys, $target)
{
    echo "<td>";
    echo "<form name = \"submit\" action = \"$target\" method = \"get\">";
    foreach($keys as $key){
	generate_form_val($row, $key);
    }
    echo "<input type = \"submit\" value = \"Generate\">";
    echo "</form>";
    echo "</td>";
}

// Create a connection
$db = new mysqli("localhost", "root", "root", "rayschool");

// Handle errors
if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

echo "Connected to db!";

// Run query
if (!($result = $db->query("SELECT * FROM printers"))) {
    die('There was an error running the query [' . $db->error . ']');
} else {
    echo "Completed a query!";
}
?>

Here's a table!
<table border = "1">
<tr> 
    <td> Host name </td> 
    <td> Printer name </td> 
    <td> Room Number </td>
    <td> Description </td> 
    <td> Date Added </td>
    <td> Script </td>
</tr>



<?
// Output results
$keys_all = array("host_name", "printer_name", "room_number", "description", "timestamp");
$keys_passed = array("host_name", "printer_name");
while($row = $result->fetch_assoc()){
    echo "<tr>";
    write_row($row, $keys_all);
    generate_form_vals($row, $keys_all, "generate.php");
    echo "</tr>";
}
echo "</form>"
?>


<? // start input section 
/* Takes an array of 3-tuples for $form_items of the format: */
/*    array("descrpitive text", "input type", "input name") */
function formTable($form_vals, $page, $method)
{
  echo "<table border = \"1\"> ";
  echo "<form method = \"$method\" action = \"$page\"> ";
  foreach ($form_vals as $form_val){
    formRow($form_val);
  }
  echo "<tr> <td> ";
  echo "<input type = \"submit\" value = \"Submit\">";
  echo "</form> ";
  echo "</table ";
}

/* Helper function for formBuilder  */
function formRow($form_val) 
{
  echo "<tr> ";
  echo "<td> $form_val[0] </td> ";
  echo "<td> ";
  echo "<input type = \"$form_val[1]\" name = \"$form_val[2]\"> ";
  echo "</td> ";
  echo "</tr>";
}

$form_items = array( array("Room number", "text", "room_number"),
		     array("Printer name", "text", "printer_name"),
		     array("Host name", "text", "host_name"),
		     array("Description", "text", "description"),
		     array("", "text", "timestamp") );
?>

<? formTable($form_items, "submit.php", "get"); ?>



</table>
</body>
</html>
