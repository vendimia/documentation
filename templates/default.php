<!DOCTYPE html>
<html>
<head>
    <title><?=$title?> - M3 Framework</title>

    <meta charset="utf-8" />
    <base href="<?=$base?>" />
    <link rel="stylesheet" href="static/css/style.css" type="text/css" />
    <link rel="icon" type="image/png" href="static/imgs/favicon.png" />
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <!--
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.7.0/styles/agate.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.7.0/highlight.min.js"></script>

    <script>hljs.initHighlightingOnLoad();</script>
    -->
    
    <link rel="stylesheet" type="text/css" href="static/enlighterjs/EnlighterJS.min.css" />
    <script type="application/javascript" src="static/enlighterjs/MooTools-Core-1.6.0-compressed.js"></script>
    <script type="application/javascript" src="static/enlighterjs/EnlighterJS.min.js"></script>
    
    <meta name="EnlighterJS" content="Advanced javascript based syntax highlighting" data-indent="4" data-selector-block="pre code" data-selector-inline="code" data-language="generic" />

</head>
<body>
    <header><div class="container">
    </div></header>
    <main><div class="container">
    <?=$body?>
    </div></main>
    <footer>
    Revisa el código fuente de esta página, colabora con el proyecto reportando errores, traduciendo a otros idiomas, o simplemente diciendo hola,
    <a href="https://github.com/vendimia/documentation/md/<?=$md_path . $md_basename?>">en la página de GitHub</a>.
    </footer>
</body>
</html>
