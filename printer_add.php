<html>
<body>

<?
echo <<<EOD
set file = "%AllUsersProfile%\Start Menu\Programs\Startup\Printer-$_GET["room_number"]-$_GET["timestamp"].vbs"

:: The escape character for .bat files is ^
echo strSchoolPrinter=^"\\$_GET["hostname"]\$_GET["printer_name"]^" > %file%
echo Set objNetwork = CreateObject(^"WScript.Network^") > %file%
echo objNetwork.AddWindowsPrinterConnection strSchoolPrinter > %file%
echo objNetwork.SetDefaultPrinter strSchoolPrinter > %file%

:: Set permissions to read/write/execute for everyone
icacls %file% /geveryone:F
EOD;
?>
</body>
</html>
