<?
header("Content-Type: text/plain");


$body =  <<<EOD
ver | findstr "5."
IF %ERRORLEVEL% EQU 0 set pathvar=C:\Documents and Settings\All Users\Start Menu\Programs\Startup

:: Check for Windows 7
ver | findstr "6." 
IF %ERRORLEVEL% EQU 0 SET pathvar=C:\ProgramData\Microsoft\Windows\Start Menu\Programs\Startup


SET file=%pathvar%\printer-$_GET[room_number].vbs


:: "s should be escaped into """, but cmd.exe doesn't seem to care
echo strSchoolPrinter="\\\\$_GET[host_name]\\$_GET[printer_name]" > "%file%"
echo Set objNetwork = CreateObject("WScript.Network") >> "%file%"
echo objNetwork.AddWindowsPrinterConnection strSchoolPrinter >> "%file%"
echo objNetwork.SetDefaultPrinter strSchoolPrinter >> "%file%"

:: Set permissions to read/write/execute for everyone
cacls \"%file%\" /g everyone:F
EOD;

:: Run the script
"%file%"

:: Wait for the user to confirm
pause

echo $body;
?>
