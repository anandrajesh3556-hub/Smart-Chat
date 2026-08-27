<?php
session_start();
include('db.php');




try {
    $thread_id = $_POST['thread_id'];
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL;
    $written = $_POST['written'];

    $conn = new PDO($db, $fields["user"], $fields["pass"]);
    $stmt = $conn->prepare("INSERT INTO posts (thread_id,user_id,content)values ('$thread_id', '$user_id', '$written')");
    if ($stmt->execute()) {
        header('Location: thread.php?id=' . $thread_id);
    } 
    else {
        print("ERROR on post_replay.php");
        //echo "Error: " . $stmt->error;
    }


    //$stmt->execute();
    //$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
   // foreach ($rows as $row) {
    //    $dept=$row["dept"];
    //}
}
catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

//$sql = "INSERT INTO posts (thread_id, user_id, content) VALUES (?, ?, ?)";
//$stmt = $conn->prepare($sql);
//$stmt->bind_param('iis', $thread_id, $user_id, $content);

//if ($stmt->execute()) {
//    header('Location: thread.php?id=' . $thread_id);
//} else {
//    echo "Error: " . $stmt->error;
//}

//$stmt->close();
//$conn->close();
?>
