<?php
$mttextline1 = "Server Connected to : Database Server, MySQL Version: ";

// Load private configuration if exists
if (file_exists(__DIR__ . '/config.php')) {
    include(__DIR__ . '/config.php');
} else {
    $db_uri = "mysql://DB_USER:DB_PASSWORD@DB_HOST:DB_PORT/DB_NAME?ssl-mode=REQUIRED";
    $ssl_ca = __DIR__ . "/ca.pem";
}

$uri = isset($db_uri) ? $db_uri : "";
$fields = parse_url($uri);

// build the DSN including SSL settings
$db = "mysql:";
$db .= "host=" . (isset($fields["host"]) ? $fields["host"] : "localhost");
if (isset($fields["port"])) {
    $db .= ";port=" . $fields["port"];
}
$db .= ";dbname=" . (isset($fields["path"]) ? ltrim($fields["path"], '/') : "defaultdb");

if (isset($ssl_ca) && file_exists($ssl_ca)) {
    $db .= ";sslmode=verify-ca;sslrootcert=" . $ssl_ca;
}

try {
    $user = isset($fields["user"]) ? $fields["user"] : "";
    $pass = isset($fields["pass"]) ? $fields["pass"] : "";
    $conn = new PDO($db, $user, $pass);

    $stmt = $conn->query("SELECT VERSION()");
    print($mttextline1);
    print($stmt->fetch()[0]);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
