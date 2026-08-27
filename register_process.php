
<?php
include('db.php');

// Sanitize input
$username = $_POST['username'];
$password = $_POST['password'];
$dept = $_POST['dept'];

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

try {
    $conn = new PDO($db, $fields["user"], $fields["pass"]);

    $stmt = $conn->prepare("INSERT INTO users (username, password, dept) VALUES ('$username', '$hashed_password', '$dept')");
    //$stmt->bind_param(':username', $username);
    //$stmt->execute();
    //$stmt->store_result();
    //$stmt->bind_result($user_id, $stored_password);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //foreach ($rows as $row) {
    //    $uss=$row["username"];
    //    $pass=$row["password"];
    //}
    if ($stmt->execute()) {
        echo "Registration successful! <a href='login.php'>Login</a>";
    } else {
        print("ERROR in register_process.php");
        //echo "Error: " . $stmt->error;
    }
}
catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}


// Directly insert the plain text password into the database
//$sql = "INSERT INTO users (username, password, dept) VALUES (?, ?, ?)";
//$stmt = $conn->prepare($sql);
//$stmt->bind_param('sss', $username, $password, $dept);



//$stmt->close();
//$conn->close();
?>
