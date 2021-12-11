<?php

namespace App\Service;

Class Slugify
{
    public function generate(string $input): string
    {
        $strInterdit = ['à', 'â', 'ç', 'é', 'è', 'ê', 'ë','î','ï','û',' ','&','#', '/', '!'];
        $strAuto = ['a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'u','-', '-', '-', '-', '-'];
        return str_replace($strInterdit, $strAuto, strtolower($input));
    }
}