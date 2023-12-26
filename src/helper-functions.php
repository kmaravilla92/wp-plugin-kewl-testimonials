<?php

use Kewl\Reviews\View;

function kr_view($template = '', $data = []) {
    return View::render($template, $data);
}