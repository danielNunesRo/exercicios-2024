<?php

namespace Chuva\Php\WebScrapping;

/**
 * Runner for the Webscrapping exercice.
 */
class Main {

  /**
   * Main runner, instantiates a Scrapper and runs.
   */
  public static function run(): void {
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
    


  }

}
