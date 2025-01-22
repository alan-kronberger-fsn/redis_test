<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



session_start();

$url = "http://169.254.169.254/latest/meta-data/instance-id";
$instance_id = file_get_contents($url);


$_SESSION['instances'][] = $instance_id;

?>

<!DOCTYPE html>
<html>

<body>
<div class="container">
    <div class="content">
        <h1>Redis Test</h1>
        <p><span class="attribute-name">Instance ID: <?php echo $instance_id; ?></span></p>
        <p><span >Your session id is: <?= session_id() ?></span></p>
        <p><?php var_dump($_SESSION['instances'])?></p>
    </div>

</div>

</body>
</html>