#!/usr/bin/php
<?php

require __DIR__.'/../../vendor/autoload.php';

$application = new \QC\Hook\PreCommit();
$application->run();
