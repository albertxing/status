<!--
Copyright (c) 2013 Albert Xing

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
-->
<html>
<head>
	<title>Status</title>
</head>
<body>
	<style>
	body {
		background: #FFF;
		color: #555;
		margin: 2em 2em 0.5em 2em;
		pointer-events: none;
		-webkit-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
	}
	pre, textarea {
		font: 10pt "DejaVu Sans Mono", "Consolas", "Monaco", monospace;
	}
	textarea {
		-webkit-appearance: none;
		-moz-appearance: none;
		appearance: none;
		border: none;
		margin: 0;
		padding: 0;
		background: none;
		width: 100%;
		color: #555;
		overflow: hidden;
		resize: none;
		-webkit-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
	}
	</style>
	<?php

	echo '<pre>';
	$uptime = substr(exec('uptime'), 11);
	$loav = substr($uptime, strpos($uptime, 'load average: ') + 14);

	function linuxUptime() {
		$ut = strtok( exec( "cat /proc/uptime" ), "." );
		$days = sprintf( "%2d", ($ut/(3600*24)) );
		$hours = sprintf( "%2d", ( ($ut % (3600*24)) / 3600) );
		$min = sprintf( "%2d", ($ut % (3600*24) % 3600)/60  );
		$sec = sprintf( "%2d", ($ut % (3600*24) % 3600)%60  );
		return array( $days, $hours, $min, $sec );
	}

	$ut = linuxUptime();

	echo "We've been up for $ut[0] days, $ut[1] hours, $ut[2] minutes, and $ut[3] seconds";
	echo '<br>';
	echo '<br>';
	echo 'Load average: ' . $loav;
	echo '<br>';
	echo '<br>';
	system('free');
	echo '<br>';
	echo '<br>';
	system('df -h /');
	echo '<br>';
	echo '<textarea disabled id="textarea">';
	system('ps auxw');
	echo '</textarea></pre>';
	?>
	<script>
	var ta = document.getElementById("textarea");
	ta.style.height = (ta.innerHTML.split("\n").length - 1) * 15 + "px"
	</script>
</body>
</html>