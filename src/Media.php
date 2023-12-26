<?php

namespace Kewl\Reviews;

use Kewl\Reviews\Singleton;

class Media extends Singleton
{
    public function init()
    {
        add_action('after_setup_theme', [$this, 'add_custom_image_sizes']);
    }

    public function add_custom_image_sizes()
    {
        add_image_size( 'kr_image_small', 80, 80 );
    }
}