<?php
$mc = new Memcached();
$mc->addServer("localhost", 11211);
echo $data = $mc->get("data");

?>
<!DOCTYPE html>
<html>
    <head>
        <title>ReadSoccerData</title>
        <script src="/project/project/views/js/jquery.js"></script>
        <script>
</script>
    </head>
    <body>

    </body>
</html>