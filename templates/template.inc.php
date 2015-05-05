<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <title>.lang files checker on Mozilla sites</title>
  <link rel="shortcut icon" href="./media/img/favicon.ico">
  <script src="./media/js/sorttable.js"></script>
  <link href="./media/css/langchecker.css" rel="stylesheet">
</head>
<body id="<?=$viewname?>">
<?php echo "<!-- Current view: {$viewname} -->\n"; ?>
<div id="outer-wrapper">
    <div id="wrapper">
<?php
    include $view;
?>
	</div>
</div>
<?php
$time   = 'Elapsed time (s): ' . round((microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"]), 4);
$memory = 'Memory usage (MB): ' . round(memory_get_peak_usage(true) / (1024 * 1024), 2);

print "<!-- " . $time . " -->\n";
print "<!-- " . $memory . " -->\n";

if (defined('DEBUG') && DEBUG) {
    error_log($time);
    error_log($memory);
}
?>
</body>
</html>
