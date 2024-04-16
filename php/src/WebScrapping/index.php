<?php

namespace Chuva\Php\WebScrapping;

require_once __DIR__ . '/../../vendor/autoload.php';

use Chuva\Php\WebScrapping\Main;

$filePath = __DIR__ . '/../../assets/origin.html';


$outputDirectory = __DIR__ . '/../../output';


$outputFile = Main::run($filePath, $outputDirectory);

echo "Os dados foram salvos em: $outputFile";
