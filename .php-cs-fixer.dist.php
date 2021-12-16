<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->exclude('bin')
    ->exclude('config')
    ->exclude('public')
    ->exclude('var')
    ->notPath('vendor')
    ->notPath('public/index.php')
;

return (new PhpCsFixer\Config())
    ->setRiskyAllowed(true)
    ->setRules([
        '@Symfony' => true,
        '@Symfony:risky' => true
    ])->setFinder($finder);
