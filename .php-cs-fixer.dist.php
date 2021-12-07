<?php

$finder = PhpCsFixer\Finder::create()
    ->in(['src/app', 'src/config']);

$config = new PhpCsFixer\Config();
return $config->setRules([
    '@PSR12' => true,
    'array_syntax' => ['syntax' => 'short'],
])
    ->setFinder($finder);