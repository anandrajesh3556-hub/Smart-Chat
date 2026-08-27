<?php
$stored_hashed_password = 'the_hashed_password_from_database';

$input_password = 'the_password_user_entered';

if (password_verify($input_password, $stored_hashed_password)) {
    echo 'Password is valid!';
} else {
    echo 'Invalid password.';
}
?>
