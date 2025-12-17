<?php
// Support environment variables for production, fallback to Docker defaults for local dev
$db_host = getenv('DB_HOST') ?: "db";
$db_user = getenv('DB_USER') ?: "annisa";
$db_pass = getenv('DB_PASSWORD') ?: "12345";
$db_name = getenv('DB_NAME') ?: "attendance_system";

$con=mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if(mysqli_connect_errno())
{
echo "Connection Fail".mysqli_connect_error();
}
?>