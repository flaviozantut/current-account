<?php

// for more info see:
// https://github.com/FriendsOfPHP/PHP-CS-Fixer#usage
// https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/master/UPGRADE.md

if (class_exists('PhpCsFixer\Finder')) {    // PHP-CS-Fixer 2.x
    $finder = PhpCsFixer\Finder::create()
        ->in(__DIR__)
        ->exclude(['vendor', 'storage'])
    ;

    return PhpCsFixer\Config::create()
        ->setRules(array(
            '@Symfony' => true,
            'array_syntax' => ['syntax' => 'short' ],
            'phpdoc_to_comment' => false,
            'blank_line_before_return' => true,
            'phpdoc_order' => true,
            'yoda_style' => false,
        ))
        ->setFinder($finder)
    ;
} elseif (class_exists('Symfony\CS\Finder\DefaultFinder')) {  // PHP-CS-Fixer 1.x
    $finder = Symfony\CS\Finder\DefaultFinder::create()
        ->in(__DIR__)
        ->exclude(['vendor', 'storage'])
    ;

    return Symfony\CS\Config\Config::create()
        ->level(Symfony\CS\FixerInterface::PSR2_LEVEL)
        ->fixers(['-psr0'])    // don't lowercase namespace (use "namespace App\.." instead of "namespace app\..") to be compatible with Laravel 5
        ->finder($finder)
    ;
}