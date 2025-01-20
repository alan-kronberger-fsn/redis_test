<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require 'vendor/autoload.php';



use Predis\Client as PredisClient;
$url = "http://169.254.169.254/latest/meta-data/instance-id";
$instance_id = file_get_contents($url);



$r = new PredisClient([
    'scheme'   => 'tcp',
    'host'     => 'sample.15p8r0.clustercfg.use2.cache.amazonaws.com',
    'port'     => 6379
]);
if ($_COOKIE['sessionId']) {
    $id = $_COOKIE['sessionId'];
    $r->append($id, ",{$instance_id}");
    $servers = $r->get($id);
} else {
    $id = session_create_id();
    setcookie('sessionId', $id);
    $r->set($id, $instance_id);
    $servers = $r->get($id);
}

?>

<!DOCTYPE html>
<html>

<body>
<div class="container">
    <div class="content">
        <h1>Redis Test</h1>
        <p><span class="attribute-name">Instance ID: <?php echo $instance_id; ?></span></p>
        <p><span >Your session id is: <?= $id ?></span></p>
        <p><?php var_dump($servers)?></p>
    </div>

</div>

</body>
</html>