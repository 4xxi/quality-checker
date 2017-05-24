#!/usr/bin/php
<?php

require __DIR__ . '/../../vendor/autoload.php';

use QC\Tool\CodeQualityTool;

$application = new CodeQualityTool();
$application->run();