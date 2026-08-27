<?php
session_start();
include('db.php');
include('header.php');


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

?>

<link rel="stylesheet" href="css/stylereg.css">
<div class="create-thread">
    <h2>Create a New Thread</h2>
    <form action="create_thread_process.php" method="post">
        <div class="form-group">
            <label for="title">Title</label>
            <br>
            <input type="text" name="title" id="title" required>
            <br>
            <label for="Description">Description</label>
            <br>
            <textarea name="dis" id="dis"></textarea>
            <br>
            <label for="dept">Department</label>
            <br>
            <?php echo '<input type="text" class="dept" id="dept" value= ' . htmlspecialchars($dept) . '>'?>
            
            <br>
       </div>
       <br>
        <button type="submit" class="submit-btn">Create Thread</button>
    </form>
</div>

<?php include('footer.php'); ?>
