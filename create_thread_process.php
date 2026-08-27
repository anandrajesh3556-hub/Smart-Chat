<?php
session_start();
include('db.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to the login page if not logged in
    exit;
}

// Fetch the user ID from the session
$user_id = $_SESSION['user_id'];

try {
    $thread_id = $_SESSION['user_name'];
    $conn = new PDO($db, $fields["user"], $fields["pass"]);
    //print($thread_id);
    $stmt = $conn->prepare("SELECT dept FROM users WHERE username = '$thread_id'");
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rows as $row) {
        $dept=$row["dept"];
    }
}
catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}


// Get the title from the form and sanitize it

$title = $_POST['title'];
$dis = $_POST['dis'];
//$dept = $_POST['dept'];
// Check if the title is not empty
if (empty($title)) {
    echo "Title cannot be empty!";
    exit;
}


try {
    $conn = new PDO($db, $fields["user"], $fields["pass"]);

    $stmt = $conn->prepare("INSERT INTO threads (title, user_id, dis, dept) VALUES ('$title', '$user_id', '$dis', '$dept')");
    if ($stmt->execute()) {
        // Redirect to the home page after successful thread creation
        header('Location: index.php');
    } else {
        // Handle errors if the query fails
       // echo "Error: " . $stmt->error;
    }
    
}
catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

////////////////////////////////////////////////////////////
// Prepare the SQL statement to insert a new thread
//$sql = "INSERT INTO threads (title, user_id, dis, dept) VALUES (?, ?, ?, ?)";

// Use prepared statements to prevent SQL injection
//$stmt = $conn->prepare($sql);
//if (!$stmt) {
 //   die('Prepare failed: ' . $conn->error);
//}

//$stmt->bind_param('siss', $title, $user_id, $dis,$dept);



//$stmt->close();
//$conn->close();
?>
