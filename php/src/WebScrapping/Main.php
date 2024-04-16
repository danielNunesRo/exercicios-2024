<?php

namespace WebScrapping;

require_once __DIR__ . '/../../vendor/autoload.php';

use Chuva\Php\WebScrapping\FileManager;

/**
 * Runner for the Webscraping exercise.
 */
class Main
{
    /**
     * Main runner, reads HTML content from a file, extracts papers, generates spreadsheet, and saves data.
     *
     * @param string $filePath The path to the HTML file.
     * @param string $outputDirectory The directory to save the output file.
     * @return string The path to the generated spreadsheet file.
     */
    public static function run(string $filePath, string $outputDirectory): string
    {
        try {
            return FileManager::processHTMLFile($filePath, $outputDirectory);
        } catch (\Throwable $e) {
            return "Erro: " . $e->getMessage();
        }
    }
}

// Exemplo de uso:
$filePath = __DIR__ . '/../../assets/origin.html';
$outputDirectory = __DIR__ . '/../../output';
$outputFile = Main::run($filePath, $outputDirectory);
echo "Os dados foram salvos em: $outputFile";
