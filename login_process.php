<?php
session_start();
include('db.php');

$username = $_POST['username'];
$password = $_POST['password'];

try {
        $conn = new PDO($db, $fields["user"], $fields["pass"]);
  
        $stmt = $conn->prepare("SELECT id,username, password FROM users WHERE username = '$username'");
        //$stmt->bind_param(':username', $username);
        $stmt->execute();
        //$stmt->store_result();
        //$stmt->bind_result($user_id, $stored_password);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $row) {
            $id=$row["id"];
            $uss=$row["username"];
            $pass=$row["password"];
        }
    }
    catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

// Fetch the plain text password from the database
//$sql = "SELECT id, password FROM users WHERE username = ?";
//$stmt = $conn->prepare("SELECT id, password FROM users WHERE username = :username");
//$stmt->bind_param(':username', $username);
//$stmt->execute();
//$stmt->store_result();
//$stmt->bind_result($user_id, $stored_password);
//$stmt->fetch();
if (password_verify($password, $pass)) {
    $_SESSION['user_id'] = $id;
    $_SESSION['user_name'] = $uss;
    $_SESSION['username'] = $usenamre;
    header('Location: index.php');
} else {
    echo 'Invalid username or password.';
}

//if ($pass==$password) {
//    $_SESSION['user_id'] = $id;
 //   $_SESSION['user_name'] = $uss;
 //   $_SESSION['username'] = $usenamre;
 //   header('Location: index.php');
//} else {
//    echo "Invalid username or password.";
//}

//$stmt->close();
//$conn->close();
?>
