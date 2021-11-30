<?php

namespace AnthonyEdmonds\GovukLaravel\Helpers;

class GovukComponent
{
    public static function renderTableContent(array $column, $row): string
    {
        if (is_array($row) !== true) {
            $row = (array)$row;
        }

        $content = $column['html'];

        foreach ($row as $key => $value) {
            if ("~$key" === $column['hide'] && $value == true) {
                return '';
            }

            $content = str_replace("~$key", $value, $content);
        }

        return $content;
    }
}
