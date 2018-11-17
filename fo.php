<?php

$filePath = __DIR__.'/frontend/web/texts/new.txt';
$handle = fopen($filePath, 'r');
echo fread($handle, filesize($filePath));
fclose($handle);