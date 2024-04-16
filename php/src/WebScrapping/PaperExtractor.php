<?php

// PaperExtractor.php

namespace Chuva\Php\WebScrapping;

/**
 * Class PaperExtractor
 *
 * Extrai informações de um registro de papel.
 */
class PaperExtractor
{
    /**
     * Extraindo informações de um registro de papel.
     *
     * @param string $record O registro de papel a ser extraído.
     * @return array As informações extraídas.
     */
    public static function extract($record)
    {
        $paper = [];

        preg_match('/(\d+)/', $record, $idMatches);
        $paper['ID'] = $idMatches[1];

        preg_match('/<h4 class="my-xs paper-title">([^<]+)/', $record, $titleMatches);
        $paper['Title'] = trim($titleMatches[1]);

        preg_match('/<div class="tags mr-sm">([^<]+)/', $record, $typeMatches);
        $paper['Type'] = trim($typeMatches[1]);

        preg_match_all('/<span title="([^"]+)">([^<]+)/', $record, $authorMatches, PREG_SET_ORDER);
        $authors = [];
        $institutions = [];
        foreach ($authorMatches as $authorMatch) {
            $authors[] = $authorMatch[2];
            $institutions[] = $authorMatch[1];
        }

        $maxAuthors = 9;
        for ($i = count($authors); $i < $maxAuthors; $i++) {
            $authors[] = '';
            $institutions[] = '';
        }

        for ($i = 1; $i <= $maxAuthors; $i++) {
            $paper["Author $i"] = $authors[$i - 1];
            $paper["Author {$i} Institution"] = $institutions[$i - 1];
        }

        return $paper;
    }
}
