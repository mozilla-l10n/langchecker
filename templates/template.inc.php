<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <title>.lang files checker on mozilla sites</title>
  <link rel="shortcut icon" href="./media/img/favicon.ico">
  <script src="./media/js/sorttable.js"></script>
  <link href="./media/css/langchecker.css" rel="stylesheet">
</head>

<body class="sand">
<div id="outer-wrapper">
    <div id="wrapper">
<?php
    echo "<!-- Current view: {$viewname} -->\n";
    include $view;
    echo "\n<!-- Elapsed time (s): " . round((microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"]), 4) . " -->\n";
?>
	</div>
</div>
</body>
</html>
