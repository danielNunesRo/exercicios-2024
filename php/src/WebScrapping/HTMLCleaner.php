<?php

namespace Chuva\Php\WebScrapping;

class HTMLCleaner
{
    public static function cleanHTML($html) {
        $html = preg_replace_callback(
            '/<(\/?)(\w+)((?:\s+\w+(?:\s*=\s*(?:".*?"|\'.*?\'|[^\'">\s]+))?)+\s*|\s*)\/?>/i',
            function ($matches) {
               
                $validTags = ['a', 'h4', 'span', 'div'];

                
                if (in_array(strtolower($matches[2]), $validTags)) {
                    
                    $tag = '<' . $matches[1] . $matches[2];

                    
                    if (!empty($matches[3])) {
                        $tag .= $matches[3];
                    }

                    $tag .= '>';

                    return $tag;
                } else {
                   
                    return '';
                }
            },
            $html
        );

        return $html;
    }
}