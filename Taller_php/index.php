<?php
$conf = 'api';

$fileHtml = $conf == 'api' ? '/taller_php/api.php' : '/taller_php/web.php';
require_once dirname(__DIR__) . $fileHtml;
