<?php
require 'scripts/screenslib.php';

$count = $_GET["n"];
if (empty($count)) {
    $count = 50;
}

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
<hr class="headerrule" />

<div style="text-align: right;">
<form method="GET">
<input type="text" name="key" placeholder="Search" value="<?php echo $_GET["key"] ?>" /><br />
<input type="text" name="n" placeholder="Max Results" value="<?php echo $count ?>" /><br />
<a href="?" class="silent">Reset</a>
<input type="submit" value="Search" />
</form>
</div>

<?php
spawnLightbox($_GET["key"], $count);
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
