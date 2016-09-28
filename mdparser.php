<?php
use \Michelf\MarkdownExtra;

require 'phpmd/Michelf/MarkdownExtra.inc.php';

/** 
 * Analyze and parse a MD file
 *
 * This class breaks the file in paragraphs, ando parse them individually. This
 * is for (in the future) generating the ToC from the titles, and also write them
 * as links.
 */
class MDparser extends MarkdownExtra
{

    public static function parse($filename) {
        $variables = [];
        $state = 'variables';
        
        $body = '';
        $data =  explode ( "\n\n", file_get_contents ($filename) );
        
        // Analizamos primero los metadatos
        $metadata = array_shift ($data);
        foreach ( explode ( "\n", $metadata ) as $line ) {
            list($var, $val) = explode(':', $line, 2);
            $variables[trim($var)] = trim($val);
        }
        
        // Luego los demás párrafos
        while ($line = array_shift($data)) {
            // Code?
            if (substr($line, 0, 3) == '```') {
                
                while (substr($line, -3) != '```') {
                    $line .= PHP_EOL . PHP_EOL . array_shift($data);
                }
            }
       
            $md = new self;
            $paragraph = $md->transform($line);
            
            $body .= $paragraph . PHP_EOL;
        }

        $variables ['body'] = $body;

        return $variables;
    }
}
