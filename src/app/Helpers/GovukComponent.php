<?php

namespace AnthonyEdmonds\GovukLaravel\Helpers;

class GovukComponent
{
    public static function makeTableColumnJson(
        bool $heading,
        string $hide,
        string $label,
        bool $numeric,
        string $slotHtml,
    ): string {
        return json_encode([
            'heading' => $heading === true,
            'hide' => strlen($hide) > 1 ? $hide : null,
            'html' => $slotHtml,
            'label' => $label,
            'numeric' => $numeric === true,
        ]);
    }

    /* Replace any row placeholders based on the table column markup */
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

            if (is_scalar($value) !== true) {
                continue;
            }

            $content = str_replace("~$key", $value, $content);
        }

        return $content;
    }

    /* Convert a keyed array to an HTML attributes string */
    public static function toAttributes(array $array): string
    {
        $attributes = [];

        foreach ($array as $key => $value) {
            $attributes[] = "$key=\"$value\"";
        }

        return implode(' ', $attributes);
    }
}
