<?php
$conn = new mysqli('127.0.0.1', 'root', '', 'esertifikatv1');
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$result = $conn->query("SELECT id, code, is_active FROM signer_certificates WHERE is_active = 1");
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"]. " - Code: " . $row["code"]. " - Active: " . $row["is_active"]. "\n";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
