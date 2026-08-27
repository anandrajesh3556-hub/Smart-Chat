<?php
session_start();
include('db.php');
include('header.php');

//$thread_id = $_GET['thread_id'];
if (isset($_GET['id'])) {
    $thread_id = $_GET['id'];
try {
    //$thread_id = $_POST['id'];
    $conn = new PDO($db, $fields["user"], $fields["pass"]);
    //print($thread_id);
    $stmt = $conn->prepare("SELECT threads.title, users.username, threads.created_at FROM threads LEFT JOIN users ON threads.user_id = users.id WHERE threads.id = '$thread_id'");
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rows as $row) {
        $title=$row["title"];
        $username=$row["username"];
        $created_at=$row["created_at"];
    }
}
catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}


//$sql = "SELECT threads.title, users.username, threads.created_at FROM threads LEFT JOIN users ON threads.user_id = users.id WHERE threads.id = ?";
//$stmt = $conn->prepare($sql);
//$stmt->bind_param('i', $thread_id);
//$stmt->execute();
//$stmt->store_result();
//$stmt->bind_result($title, $username, $created_at);
//$stmt->fetch();


echo '<div class="thread-details">';
echo  '<h2>'. $title .'</h2>';
echo    '<p> Posted by '. print($username) . ' on  '. print($created_at).' </p>';
echo    '<h2>Post a Reply</h2>';
echo    '<form action="post_reply.php" method="post">';
echo        '<textarea name="written" id="written" required></textarea><br>';
echo        '<input type="hidden" name="thread_id" id="thread_id" value=" '.$thread_id.'">';
echo        '<button type="submit">Post Reply</button>';
echo    '</form>';

echo    '<h2>Replies</h2>';


try {
        $conn = new PDO($db, $fields["user"], $fields["pass"]);
  
        $stmt = $conn->prepare("SELECT posts.id, posts.content, users.username, posts.created_at FROM posts JOIN users ON posts.user_id = users.id WHERE posts.thread_id = '$thread_id' ORDER BY posts.created_at DESC");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($rows as $row) {
            echo '<div class="comment-item">';
            echo '<p>' . htmlspecialchars($row['content']) . '</p>';
            echo '<p>Posted by ' . htmlspecialchars($row['username']) . ' on ' .  htmlspecialchars($row['created_at']) . '</p>';
            echo("-------------------------------------------------------------------------------------------");
            
        }
       // foreach ($rows as $row) {
      //      $id=$row["id"];
      //      $content=$row["content"];
      //      $username=$row["username"];
      //      $created_at=$row["created_at"];

            
            
      // }
        

        /////////////
   //     try {
   //             $conn = new PDO($db, $fields["user"], $fields["pass"]);
   //       
   //             $stmt = $conn->prepare("SELECT content, users.username, created_at FROM replies LEFT JOIN users ON replies.user_id = users.id WHERE replies.post_id ='$thread_id' ");
   //             $stmt->execute();
   //             $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
   // 
   //         foreach ($rows as $row) {
   // 
   //             echo '<div class="reply-item">';
   //             echo '<p>' . htmlspecialchars($row['content']) . '</p>';
   //             echo '<p>Posted by ' . htmlspecialchars($row['username']) . ' on ' . $row['created_at'] . '</p>';
    //            echo '</div>';
    //        }
       
        
    //    }
   //    catch (Exception $e) {
    //        echo "Error: " . $e->getMessage();
    //    }
}
catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}


/////LEFT JOIN users ON posts.user_id = users.id
    //$sql = "SELECT posts.id, posts.content, users.username, posts.created_at FROM posts LEFT JOIN users ON posts.user_id = users.id WHERE posts.thread_id = ?";
   // $stmt = $conn->prepare($sql);
    //$stmt->bind_param('i', $thread_id);
    //$stmt->execute();
    //$result = $stmt->get_result();

    //while ($row = $result->fetch_assoc()) {
    //    echo '<div class="comment-item">';
    //    echo '<p>' . htmlspecialchars($row['content']) . '</p>';
    //    echo '<p>Posted by ' . htmlspecialchars($row['username']) . ' on ' . $row['created_at'] . '</p>';

        // Fetch replies to this post
 //       $post_id = $row['id'];
 //       $sql_replies = "SELECT content, users.username, created_at FROM replies LEFT JOIN users ON replies.user_id = users.id WHERE replies.post_id = ?";
 //       $stmt_replies = $conn->prepare($sql_replies);
 //       $stmt_replies->bind_param('i', $post_id);
 //       $stmt_replies->execute();
 //       $result_replies = $stmt_replies->get_result();

 //       while ($reply_row = $result_replies->fetch_assoc()) {
 //           echo '<div class="reply-item">';
 //           echo '<p>' . htmlspecialchars($reply_row['content']) . '</p>';
 //           echo '<p>Posted by ' . htmlspecialchars($reply_row['username']) . ' on ' . $reply_row['created_at'] . '</p>';
  //          echo '</div>';
  //      }

  //      $stmt_replies->close();
  //      echo '</div>';
  //  
  //  $stmt->close();
  //  $conn->close();
} else {
    echo 'No ID specified.';
}
    ?>
</div>

<?php include('footer.php'); ?>
