:setlocal enableextensions enabledelayedexpansion

:: Check for Windows xp
ver | findstr "5."
IF %ERRORLEVEL% EQU 0 set pathvar=C:\Documents and Settings\All Users\Start Menu\Programs

\Startup

:: Check for Windows 7
ver | findstr "6." 
IF %ERRORLEVEL% EQU 0 SET pathvar=C:\ProgramData\Microsoft\Windows\Start Menu\Programs

\Startup


SET file=%pathvar%\Printer-ROOMNUM-TIMESTAMP.vbs

echo %file%
echo %pathvar%

:: The escape character for .bat files is ^
echo strSchoolPrinter="""\\$$PRINTER\$$LOC""" > %file%
echo Set objNetwork = CreateObject("""WScript.Network""") > %file%
echo objNetwork.AddWindowsPrinterConnection strSchoolPrinter > %file%
echo objNetwork.SetDefaultPrinter strSchoolPrinter > %file%

:: Set permissions to read/write/execute for everyone
cacls %file% /g everyone:F

:endlocal