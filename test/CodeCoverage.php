<?php

require __DIR__ . "/../vendor/phpunit/php-code-coverage/src/CodeCoverage.php";

use SebastianBergmann\CodeCoverage\CodeCoverage;

$coverage = new CodeCoverage();
$coverage->filter()->addDirectoryToWhitelist(__DIR__ . '/../src');
$coverage->start();
$coverage->stop();

$writer = new SebastianBergmann\CodeCoverage\Report\Clover();
$writer->process($coverage, '/tmp/clover.xml');

$writer = new SebastianBergmann\CodeCoverage\Report\Html\Facade();
$writer->process($coverage, '/tmp/code-coverage-report');
