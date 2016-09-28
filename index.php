<?php
/*
  
  Vendima Framework MD documentation parser
  
  It uses the excellent PHP Markdown Extra from Michel Fortin
  https://michelf.ca/projects/php-markdown/extra/
  
  Files are inside the 'md/' directory, and uses the same structure as the
  URI, except if it begins with a two-letter word, indicating a different
  language. 
  
  Each file have the format "name.[language.]md". If omitted, the default
  language is spanish.
  
*/

const MD_BASEPATH = 'md/';

require 'mdparser.php';

if (isset($_GET['q'])) {
    $file = trim($_GET['q'], '/.\\');
}
else {
    $file = 'index';
}

$parts = explode('/', $file);

// Usamos la 1ra parte sólo si tiene 2 caracteres
if (strlen($parts[0]) == 2) {
    $language = array_shift($parts);
} else {
    $language = '';
}

// Es un fichero o un directorio?
$test = MD_BASEPATH . join('/', $parts);
if (is_dir($test)) {
    // Intentamos index
    $basefile = ['index', $language, 'md'];
} else {
    $basefile = [array_pop($parts), $language, 'md'];
}


$md_path = join('/', $parts) . '/'; 
$md_basename = join('.', array_filter($basefile));

$md_file =  MD_BASEPATH . $md_path . $md_basename;

if (file_exists($md_file)) {
    extract( MDparser::parse($md_file) );

    // DEBUG
    if (file_exists('/etc/DOROTHY')) {
        $base = '/vendimia/docs/';
    } else {
        $base = '/';
    }
    
    include 'templates/default.php';
} else {
    //  TODO: 404!
}
