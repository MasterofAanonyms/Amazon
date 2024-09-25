<?php
header('Content-Type: application/json');
$request = json_decode(file_get_contents('php://input'), true);

if (!isset($request['message'])) {
    echo json_encode(['response' => 'Invalid request.']);
    exit;
}

$message = trim($request['message']);

// Database connection
$servername = "localhost";
$username = "root";
$password = "Pa$$@word12";
$dbname = "beta_x2";
$port = "3306";

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("SELECT response FROM chat_responses WHERE question = ?");
$stmt->bind_param("s", $message);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($response);

if ($stmt->num_rows > 0) {
    $stmt->fetch();
} else {
    $response = "Sorry, I don't have an answer for that question.";
}

$stmt->close();
$conn->close();

echo json_encode(['response' => $response]);
?>
