<html>
<body>
<?
// Create a connection
$db = new mysqli("localhost", "root", "root", "rayschool");

// Handle errors
if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

echo "Connected to db!";

$fields = array("host_name", "printer_name", "room_number", "description", "timestamp");

$room_number = (int)$_GET["room_number"];

$sql =<<<EOD
INSERT INTO printers ($fields[0], $fields[1], $fields[2], $fields[3],
       $fields[4]) 
VALUES ("$_GET[host_name]", "$_GET[printer_name]", $room_number,
       "$_GET[description]", NULL)
EOD;

echo "<br>";
echo $_GET;
foreach ($_GET as $get){
	echo $get . "<br>";
}
echo "<br>";
echo $sql;

// Run query
if (!($result = $db->query($sql))){
    die('There was an error running the query [' . $db->error . ']');
} else {
    echo "Successfully submitted!";
}
?>