<?php
// Support environment variables for production, fallback to Docker defaults for local dev
$host = getenv('DB_HOST') ?: "db";
$dbname = getenv('DB_NAME') ?: "attendance_system";
$user = getenv('DB_USER') ?: "annisa";
$pass = getenv('DB_PASSWORD') ?: "12345";

try {
    $db = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $user,
        $pass
    );
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("DB Connection failed: " . $e->getMessage());
}
?>
