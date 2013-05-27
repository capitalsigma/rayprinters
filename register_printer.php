<?
/* Takes an array of 3-tuples for $form_items of the format: */
/*    array("descrpitive text", "input type", "input name") */
function formTable($form_vals, $page, $method)
{
  echo "<table border = \"1\"> ";
  echo "<form method = \"$method\" action = \"$page\"> ";
  foreach ($form_vals as $form_val){
    formRow($form_val);
  }
  echo "</form> ";
  echo "</table ";
}

/* Helper function for formBuilder  */
function formRow($form_val) 
{
  echo "<tr> "
  echo "<td> $form_val[0] </td> ";
  echo "<td> " 
  echo "<input type = \"$form_val[1]\" name = \"form_val[2]\"> ";
  echo "</td> ";
  echo "</tr>";
}

$form_items = array( array("Room number", "text", "room_number"),
		     array("Printer name", "text", "host_name"),
		     array("Host name", "text", "host_name"),
		     array("Description", "text", "description"),
		     array("", "hidden", "timestamp") )
?>

<? formTable($form_items, "input.php", "get"); ?>

