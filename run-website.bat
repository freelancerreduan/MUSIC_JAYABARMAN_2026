@echo off
rem ==========================================================
rem  Jaya Barman website - double-click to run
rem  Starts MySQL (Laragon) if needed, prepares the project,
rem  opens the browser and runs the site on http://127.0.0.1:8000
rem ==========================================================
setlocal EnableDelayedExpansion
cd /d "%~dp0"
title Jaya Barman website

rem ---- PHP: use the one on PATH, otherwise Laragon's ----
where php >nul 2>nul
if errorlevel 1 (
    for /d %%D in ("C:\laragon\bin\php\php-8*") do set "PATH=%%D;!PATH!"
)
where php >nul 2>nul
if errorlevel 1 (
    echo [!] PHP was not found. Install Laragon from https://laragon.org and try again.
    pause
    exit /b 1
)

rem ---- MySQL: start Laragon's MySQL when nothing listens on port 3306 ----
netstat -ano | findstr /r /c:":3306 .*LISTENING" >nul
if not errorlevel 1 goto mysqlready

set "MYSQL_DIR="
for /d %%D in ("C:\laragon\bin\mysql\mysql-*") do set "MYSQL_DIR=%%D"
if not defined MYSQL_DIR (
    echo [!] MySQL is not running and Laragon MySQL was not found. Start MySQL and run this again.
    pause
    exit /b 1
)
echo Starting MySQL from %MYSQL_DIR% ...
start "MySQL" /min "%MYSQL_DIR%\bin\mysqld.exe" --defaults-file="%MYSQL_DIR%\my.ini" --standalone
set /a TRIES=0

:waitmysql
timeout /t 2 /nobreak >nul
set /a TRIES+=1
netstat -ano | findstr /r /c:":3306 .*LISTENING" >nul
if not errorlevel 1 goto mysqlready
if %TRIES% lss 40 goto waitmysql
echo [!] MySQL did not start. Open Laragon and click "Start All", then run this again.
pause
exit /b 1

:mysqlready
echo MySQL is running.

rem ---- First run: packages and .env ----
if not exist "vendor\autoload.php" (
    echo Installing PHP packages - first run only ...
    call composer install --no-interaction || (pause & exit /b 1)
)
if not exist ".env" (
    copy ".env.example" ".env" >nul
    php artisan key:generate --force
)

rem ---- Database: create, migrate, fill content (keeps your edits) ----
php artisan site:setup || (pause & exit /b 1)

rem ---- Run ----
echo.
echo  Website : http://127.0.0.1:8000
echo  Admin   : http://127.0.0.1:8000/admin
echo  Close this window to stop the site.
echo.
start "" "http://127.0.0.1:8000/admin"
php artisan serve --host=127.0.0.1 --port=8000
