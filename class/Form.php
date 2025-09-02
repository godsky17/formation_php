<?php 
class Form
{
    public static function checkBox(string $name, string $value, array $data = []): string
    {
        $attributes = "";
        if(isset($data[$name]) && in_array($value, $data[$name]))
        {
            $attributes .= 'checked';
        }
        return '<input type="checkbox" name="{$name}[]" value="{$value}" $attributes>';
    }
}