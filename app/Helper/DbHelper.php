<?php

namespace App\Helper;

class DbHelper
{
    public static function getStatusByString(string $status)
    {
        return strtolower($status) === 'ativo' ? 1 : 0;
    }

    public static function getStatusString(int $status)
    {
        return $status === 1 ? 'Ativo' : 'Inativo';
    }
}
