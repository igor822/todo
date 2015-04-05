<?php

namespace Task\Component;

use Task\Constants\ConsoleColors;

class ConsoleColor
{
    private static $arr = [
        'default_console' => ConsoleColors::COLOR_DEFAULT,
        'black' => ConsoleColors::COLOR_BLACK,
        'blue' => ConsoleColors::COLOR_BLUE,
        'green' => ConsoleColors::COLOR_GREEN,
        'cyan' => ConsoleColors::COLOR_CYAN,
        'red' => ConsoleColors::COLOR_RED,
        'purple' => ConsoleColors::COLOR_PURPLE,
        'light_red' => ConsoleColors::COLOR_LIGHT_RED,
        'dark_grey' => ConsoleColors::COLOR_DARK_GREY,
        'light_blue' => ConsoleColors::COLOR_LIGHT_BLUE,
        'light_green' => ConsoleColors::COLOR_LIGHT_GREEN,
        'light_cyan' => ConsoleColors::COLOR_LIGHT_CYAN,
        'light_purple' => ConsoleColors::COLOR_LIGHT_PURPLE
    ];

    public static function get($name)
    {
        return ConsoleColors::COLOR_PREFIX . static::$arr[$name];
    }

    public static function printColor($content, $color)
    {
        return sprintf("%s%s%s", self::get($color), $content, self::get('default_console'));
    }
}
