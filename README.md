# Vendima Framework MD documentation parser

This script parses the MD files located inside 'md/' directory, taking account the language specified in the URL. 

Each file have the format `name.[language.]md`. If language is omitted, the default is spanish. The first lines of each MD file have a `variable: value` syntax, used for metadata. After a blank line, the document body begins.

Translations and fixes are most welcome!

Big kudos to Michel Fortin for the PHP Markdown library 👍👍 https://michelf.ca/projects/php-markdown/extra/
