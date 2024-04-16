<?php

namespace Chuva\Php\WebScrapping;

use Chuva\Php\WebScrapping\HTMLCleaner;
use Chuva\Php\WebScrapping\PaperExtractor;
use Chuva\Php\WebScrapping\SpreadsheetGenerator;

/**
 * Classe FileManager para operações de manipulação de arquivos.
 */
class FileManager
{
    /**
     * Lê o conteúdo HTML de um arquivo, extrai papers, gera planilha e salva os dados.
     *
     * @param string $filePath O caminho para o arquivo HTML.
     * @param string $outputDirectory O diretório para salvar o arquivo de saída.
     * @return string O caminho para o arquivo de planilha gerado.
     */
    public static function processHTMLFile(string $filePath, string $outputDirectory): string
    {
        $htmlContent = file_get_contents($filePath);
        $cleanedHTML = HTMLCleaner::cleanHTML($htmlContent);
        $papersData = self::extractPapers($cleanedHTML);
        $outputFile = self::generateSpreadsheet($papersData, $outputDirectory);
        return $outputFile;
    }

    /**
     * Extrai papers do conteúdo HTML limpo.
     *
     * @param string $cleanedHTML O conteúdo HTML limpo.
     * @return array Os dados dos papers extraídos.
     */
    private static function extractPapers(string $cleanedHTML): array
    {
        $records = explode('<a href="https://proceedings.science/proceedings/100227/_papers/', $cleanedHTML);
        $papersData = [];
        foreach ($records as $record) {
            if (!empty(trim($record))) {
                $paper = PaperExtractor::extract($record);
                $papersData[] = $paper;
            }
        }
        return $papersData;
    }

    /**
     * Gera uma planilha a partir dos dados dos papers e a salva.
     *
     * @param array $papersData Os dados dos papers.
     * @param string $outputDirectory O diretório para salvar o arquivo de saída.
     * @return string O caminho para o arquivo de planilha gerado.
     */
    private static function generateSpreadsheet(array $papersData, string $outputDirectory): string
    {
        $outputFile = SpreadsheetGenerator::generate($papersData);
        $outputFilePath = $outputDirectory . '/output.xlsx';
        rename($outputFile, $outputFilePath);
        return $outputFilePath;
    }
}
