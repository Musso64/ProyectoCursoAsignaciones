<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class EnumHelper
{
    public static function getValues($table, $column)
    {
        $result = DB::select("SHOW COLUMNS FROM {$table} LIKE '{$column}'");
        if (empty($result)) return [];
        $type = $result[0]->Type;
        preg_match("/^enum\(\'(.*)\'\)$/", $type, $matches);
        return isset($matches[1]) ? explode("','", $matches[1]) : [];
    }
}