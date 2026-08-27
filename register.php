<link rel="stylesheet" href="css/stylereg.css">
<?php
include('header.php');
?>

<div class="register-form">
    <h2>Register</h2>
    <form action="register_process.php" method="post">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required>
        </div>
        <br>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div class="form-group">
            <br>
            <label for="dept">Department</label>
            <select class="dept" id="dept" name="dept" REQUIRED>
                    <option value="CS">CS</option>
                    <option value="Visual Media">Visual Media</option>
                    <option value="IT">IT</option>
                    <option value="Business">Business</option>
                    <option value="Language">Language</option>
                </select>
            
        </div>
        <br>
        <button type="submit" class="submit-btn">Register</button>
    </form>
</div>

<?php include('footer.php'); ?>
