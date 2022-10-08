<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__.'/src')
;

return (new PhpCsFixer\Config())
    ->setFinder($finder)
    ->setRiskyAllowed(true)
    ->setCacheFile(__DIR__.'/var/cache/dev/.php_cs_fixer.cache')
    ->setRules([
        '@Symfony' => true,
    ])
;
