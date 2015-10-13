<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <title>.lang files checker on Mozilla sites</title>
  <link rel="shortcut icon" href="<?=$assets_folder?>/img/favicon.ico">
  <script src="<?=$assets_folder?>/js/sorttable.js"></script>
  <link href="<?=$assets_folder?>/css/langchecker.css" rel="stylesheet">
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
