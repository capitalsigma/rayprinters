
:: Check for Windows xp
ver | findstr "5."

IF %ERRORLEVEL% LEQ 0 set path = "C:\ProgramData\Microsoft\Windows\StartMenu\Programs\Startup\"

:: Check for Windows 7
ver | findstr "6."
IF %ERRORLEVEL% LEQ 0 set path = "C:\Documents and Settings\All Users\Start Menu\Programs\Startup\"

set file = "%path%\Printer-ROOMNUM-TIMESTAMP.vbs"

:: The escape character for .bat files is ^
echo strSchoolPrinter=^"\\$$PRINTER\$$LOC^" > %file%
echo Set objNetwork = CreateObject(^"WScript.Network^") > %file%
echo objNetwork.AddWindowsPrinterConnection strSchoolPrinter > %file%
echo objNetwork.SetDefaultPrinter strSchoolPrinter > %file%

:: Set permissions to read/write/execute for everyone
icacls %file% /geveryone:F