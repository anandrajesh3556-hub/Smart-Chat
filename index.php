<?php
session_start();
include('db.php');
include('header.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to the login page if not logged in
    exit;
}

?>
<link rel="stylesheet" href="css/style.css">
<div class="thread-list">
    <h2>Threads</h2>
    <a href="create_thread.php"   style="color: #ffffff"><button class="button-17">New Thread</button></a>
    <?php
        
    if (isset($_SESSION['user_name'])):
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

            
                $conn = new PDO($db, $fields["user"], $fields["pass"]);
          
                $stmt = $conn->prepare("SELECT id, title, dis, created_at FROM threads WHERE dept='$dept' ORDER BY created_at DESC ");
                $stmt->execute();
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                //foreach ($rows as $row) {
                   // $id=$row["id"];
                   // $title=$row["title"];
                   // $dis=$row["dis"];
                   // $created_at=$row["created_at"];
                //}
            
    
            //$sql = "SELECT id, title, dis, created_at FROM threads WHERE dept='$dept' ORDER BY created_at DESC ";
            //$result = $conn->query($sql);
    
            foreach ($rows as $row) {
    
                            echo '<div class="thread-item">';
                            
                            echo '<h3 class="twentysixpoint"><a style="color: #ffffff"href="thread.php?id=' . $row['id'] . '">' . htmlspecialchars($row['title']) . '</a></h3>';
                            
    
                            echo '<div class="dis_sty" <p> ' . htmlspecialchars($row['dis']) . '</div>';
                            echo '<div class="dis_sty" <p>DEPT : ' . htmlspecialchars($dept) . '</div>';
                            echo '<div class="dis_sty"><p> <a style="color: #ffffff" id=' . htmlspecialchars($row['created_at']) . '</a> </p></div>';
                            echo '</div>';
            }
       
        
        }
        catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }

        //$thread_id = $_SESSION['user_id'];
        //$sql = "SELECT dept FROM users WHERE id = ?";
        //$stmt = $conn->prepare($sql);
        //$stmt->bind_param('i', $thread_id);
        //$stmt->execute();
        //$stmt->store_result();
        //$stmt->bind_result($dept);
        //$stmt->fetch();
    

    
    endif;    
    ?>
</div>

<STYLE TYPE=”text/css”>, <!-, .twentysixpoint line-height: 2px;, </STYLE>


<style>
    .popup-icon {
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 60px;
        height: 60px;
        background-color: #4CAF50;
        color: white;
        text-align: center;
        line-height: 60px;
        font-size: 24px;
        border-radius: 50%;
        cursor: pointer;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        z-index: 1001; /* Ensure it's above other content */
    }
    .popup-icon:hover {
        background-color: #45a049;
    }
</style>
</head>
<body>

<!-- Popup icon -->
<div id="popup-icon" class="popup-icon" onclick="openPopup()">
    <span>&#x1F4AC;</span> <!-- Adjust icon as needed -->
</div>

<!-- Script to handle opening the popup -->
<script>
function openPopup() {
    // Specify the relative or full URL for the popup window
    var popupUrl = 'Ai/ai-chat.html'; // Adjust this URL as needed
    var popupWidth = 400;
    var popupHeight = 300;
    
    // Calculate position for centering the popup window
    var popupLeft = (window.innerWidth - popupWidth) / 2;
    var popupTop = (window.innerHeight - popupHeight) / 2;

    // Open the popup window with a custom name (e.g., 'customPopup')
    var popupWindow = window.open(popupUrl, 'customPopup', 'width=' + popupWidth + ', height=' + popupHeight + ', left=' + popupLeft + ', top=' + popupTop);

    // Focus the popup window (in case it's already opened)
    if (popupWindow) {
        popupWindow.focus();
    }
}

</script>

</body>
</html>







<?php include('footer.php'); ?>
