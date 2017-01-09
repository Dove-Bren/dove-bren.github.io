<?php require "scripts/projectlib.php"; ?>
<html>

<head>
<title>Skyler Manzanares</title>
<link type="text/css" rel="stylesheet" href="global.css" />
<link type="text/css" rel="stylesheet" href="projects.css" />
<script src="scripts/framework.js"></script>
<!-- <script src="scripts/xmlfetch.js"></script> -->
</head>
<body>


<div id="topper">
</div>

<div id="content">
<p id="header">
Projects
</p>
<p >
This page contains a collection of projects I have worked on. Most of the
projects are hobby projects, and are denoted as such. 
</p>

<div style="text-align: right;">
<form method="GET">
<input type="text" name="key" placeholder="Search" value="<?php echo $_GET["key"] ?>" />
<input type="submit" value="Search" /><br />
<a href="?" class="silent">Reset</a>
</form>
</div>

<!--
<div id="projtable">
<script>displayResult("projtable", "proj", "proj-long");</script>
</div>
-->

<?php displayProjects($_GET["key"]); ?>

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
