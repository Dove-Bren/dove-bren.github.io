<?php
echo "1";
require 'scripts/screenslib.php';
echo "2";
?>

<html>

<head>
<title>Screenshots</title>
<link type="text/css" rel="stylesheet" href="global.css" />
<link type="text/css" rel="stylesheet" href="screenshots.css" />
<script src="scripts/framework.js"></script>
<script src="scripts/lightbox.js"></script>

</head>
<body>

<div id="topper">
</div>

<div id="content">
<p id="header">
Screenshots
</p>

<div>
<?php
spawnLightbox();
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

</html>
