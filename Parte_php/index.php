<?php
$conf = 'api';

$fileHtml = $conf == 'api' ? '/parte_php/api.php' : '/parte_php/web.php';
require_once dirname(__DIR__) . $fileHtml;
