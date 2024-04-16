<?php

namespace WebScraper;

require_once __DIR__ . '/../../vendor/autoload.php';

use Chuva\Php\WebScrapping\HTMLCleaner;
use Chuva\Php\WebScrapping\PaperExtractor;
use Chuva\Php\WebScrapping\SpreadsheetGenerator;

/**
 * Runner for the Webscraping exercise.
 */
class Main
{
    /**
     * Main runner, instantiates a Scrapper and runs.
     */
    public static function run(): void
    {
        try {
            $htmlContent = file_get_contents(__DIR__ . '/../../assets/origin.html');
            $cleanedHTML = HTMLCleaner::cleanHTML($htmlContent);

            $records = explode('<a href="https://proceedings.science/proceedings/100227/_papers/', $cleanedHTML);

            $papersData = [];
            foreach ($records as $record) {
                if (empty(trim($record))) {
                    continue;
                }

                $paper = PaperExtractor::extract($record);
                $papersData[] = $paper;
            }

            $outputFile = SpreadsheetGenerator::generate($papersData);

            echo "Os dados foram salvos em: $outputFile";
        } catch (\Throwable $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
}
