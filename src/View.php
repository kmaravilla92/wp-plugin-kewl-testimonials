<?php

namespace Kewl\Reviews;

class View extends Singleton
{
    public static function render($template = '', $data = [])
    {
        extract($data);
        ob_start();
        include dirname(dirname(__FILE__)) . "/templates/{$template}.php";
        return ob_get_clean();
    }
}