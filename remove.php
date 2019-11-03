<?php
require "php_files/db_conn.php";
$id = $_GET["id"];
$stmt = $conn->query("DELETE FROM tasks WHERE id=" . $id);
if ($stmt) {
    header("location:index.php");
} else {
    echo "sorry, something went wrong.. try again later";
}
