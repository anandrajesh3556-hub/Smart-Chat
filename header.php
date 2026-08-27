<!-- header.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Name</title>
    <link rel="stylesheet" href="css/hedstyle.css">
</head>
<body>
    <header class="header">
        <h1><a href="index.php"><button class="button-85">Project Name</button</a></h1>
   
        <div class="login">
            <?php if (isset($_SESSION['user_id'])): 
                
                try {
                        $conn = new PDO($db, $fields["user"], $fields["pass"]);
  
                        $stmt = $conn->prepare("SELECT username FROM users WHERE id = 'user_id'");
                        //$stmt->bind_param(':username', $username);
                        $stmt->execute();
                         //$stmt->store_result();
                         //$stmt->bind_result($user_id, $stored_password);
                         $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($rows as $row) {
                        $username=$row["username"];
                        }
                    }
                    catch (Exception $e) {
                        echo "Error: " . $e->getMessage();
                    }

                
                //$thread_id = $_SESSION['user_id'];
                //$sql = "SELECT username FROM users WHERE id = ?";
                //$stmt = $conn->prepare($sql);
                //$stmt->bind_param('i', $thread_id);
                //$stmt->execute();
                //$stmt->store_result();
                //$stmt->bind_result($username);
                //$stmt->fetch();

                //echo '<button class="button-81">'.htmlspecialchars($username).'</button>';
                ?>

                <a href="logout.php"><button class="button-81">LOGOUT</button></a>
            <?php else: ?>
                
                <a href="login.php"><button class="button-81"> LOGIN </button></a>
                <a href="register.php"><button class="button-81">REGISTER</button></a>
            <?php endif; ?>
        </div>
    </header>
    <div class="container">
