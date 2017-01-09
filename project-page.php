<?php

error_reporting(E_ALL); ini_set('display_errors', true);

require 'scripts/projectlib.php';

?>

<html>

<head>
<title>Skyler Manzanares</title>
<link type="text/css" rel="stylesheet" href="global.css" />
<link type="text/css" rel="stylesheet" href="screenshots.css" />
<script src="scripts/framework.js"></script>

</head>
<body>

<div id="topper">
</div>

<div id="content">
<p id="header">
<?php
echo $header;
?>
</p>

<div>
<?php
displayProjectPage();
?>
</div>

<p>
</p>
</div>

<div id="footer">
footer
</div>
</body>


<script>
init_navbar();
init_footbar();
</script>
<script src="scripts/lightbox.js"></script>

</html>
