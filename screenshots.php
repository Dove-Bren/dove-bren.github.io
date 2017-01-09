<?php
require 'scripts/screenslib.php';
?>

<html>

<head>
<title>Screenshots</title>
<link type="text/css" rel="stylesheet" href="global.css" />
<link type="text/css" rel="stylesheet" href="screenshots.css" />
<script src="scripts/framework.js"></script>

</head>
<body>

<div id="topper">
</div>

<div id="content">
<p id="header">
Screenshots
</p>

<div style="text-align: right;">
<form method="GET">
<input type="text" name="prefix" placeholder="Search" />
<input type="submit" value="Search" /><br />
<a href="?" class="silent">Reset</a>
</form>
</div>

<?php
spawnLightbox($_GET["prefix"]);
?>

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
