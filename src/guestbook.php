<?php
$filePath = 'messages.txt';

// Function to append message to the file
function saveMessageToFile($name, $message, $filePath) {
    $timestamp = date('Y-m-d H:i:s');
    $entry = $timestamp . " | " . $name . " | " . $message . "\n";
    file_put_contents($filePath, $entry, FILE_APPEND);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $message = htmlspecialchars($_POST['message']);
    if (!empty($name) && !empty($message)) {
        saveMessageToFile($name, $message, $filePath);
    }
}

// Function to load messages from the file
function loadMessages($filePath) {
    $entries = [];
    if (file_exists($filePath)) {
        $entries = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    }
    return $entries;
}

$messages = loadMessages($filePath);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Simple PHP Guestbook</title>
</head>
<body>
    <h1>Guestbook</h1>
    <form action="guestbook.php" method="post">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>
        <label for="message">Message:</label><br>
        <textarea id="message" name="message" required></textarea><br><br>
        <input type="submit" value="Submit">
    </form>

    <h2>Messages</h2>
    <?php
    if (!empty($messages)) {
        foreach ($messages as $entry) {
            echo nl2br(htmlspecialchars($entry) . "\n");
        }
    } else {
        echo "No messages found.";
    }
    ?>
</body>
</html>
