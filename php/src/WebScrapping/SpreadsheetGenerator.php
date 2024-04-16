<?php
namespace Chuva\Php\WebScrapping;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/**
 * Class SpreadsheetGenerator
 *
 * Gera um arquivo de planilha a partir dos dados fornecidos.
 */
class SpreadsheetGenerator
{
    /**
     * Gera uma planilha a partir dos dados fornecidos.
     *
     * @param array $data Os dados para preencher a planilha.
     * @return string O caminho do arquivo gerado.
     */
    public static function generate(array $data): string
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->fromArray(self::getHeaders(), null, 'A1');
        $row = 2;
        foreach ($data as $paper) {
            $sheet->fromArray($paper, null, "A$row");
            $row++;
        }

        $outputDir = __DIR__ . '/../../view/';
        $outputFile = $outputDir . 'data.xlsx';

        if (!file_exists($outputDir)) {
            mkdir($outputDir, 0777, true);
        }

        $writer = new Xlsx($spreadsheet);
        $sheet->removeRow(2);
        $writer->save($outputFile);

        return $outputFile;
    }

    /**
     * Retorna os cabeçalhos para a planilha.
     *
     * @return array Os cabeçalhos da planilha.
     */
    private static function getHeaders(): array
    {
        return [
            'ID',
            'Title',
            'Type',
            'Author 1',
            'Author 1 Institution',
            'Author 2',
            'Author 2 Institution',
            'Author 3',
            'Author 3 Institution',
            'Author 4',
            'Author 4 Institution',
            'Author 5',
            'Author 5 Institution',
            'Author 6',
            'Author 6 Institution',
            'Author 7',
            'Author 7 Institution',
            'Author 8',
            'Author 8 Institution',
            'Author 9',
            'Author 9 Institution',
        ];
    }
}
