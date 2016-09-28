<?php
use \Michelf\MarkdownExtra;

require 'phpmd/Michelf/MarkdownExtra.inc.php';

/*class MDParser extends \Michelf\MarkdownExtra
{


}*/


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
            
/*            if (substr($line, 0, 3) == '```') {
                // seguimos leyendo hasta que encontremos nuevamente el ```
                $more_lines = array_shift($data);
                while ("forever") {
                    $line .= $more_lines . PHP_EOL;
                    
                    $more_lines = array_shift($data);                    
                    var_dump($more_lines);
                    if (!$data || substr($more_lines, -3) == '```') { 
                        break;
                    }
                }
                
            }*/
        
            $md = new self;
            $paragraph = $md->transform($line);
            
            $body .= $paragraph . PHP_EOL;
        }

        $variables ['body'] = $body;

        return $variables;
    }
}
