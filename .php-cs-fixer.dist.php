<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->exclude('bin')
    ->exclude('var')
    ->exclude('node_modules')
    ->notPath('public/index.php')
;

return (new PhpCsFixer\Config())
    ->setFinder($finder)
    ->setRiskyAllowed(true)
    ->setCacheFile(__DIR__.'/var/cache/dev/.php_cs_fixer.cache')
    ->setRules([
        '@Symfony' => true,
    ])
;
