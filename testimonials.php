<?php
/**
 * Plugin Name: Testimonials
 */

namespace Kewl\Reviews;

use Carbon_Fields\Carbon_Fields;
use Kewl\Reviews\Reviews\ {
    PostType as ReviewsPostType,
    Fields as ReviewsFields,
};
use Kewl\Reviews\Widgets\ {
    PostType as WidgetsPostType,
    Fields as WidgetsFields,
    Shortcode
};
use Kewl\Reviews\REST\ {
    Reviews as ReviewsAPI
};
use Kewl\Reviews\Admin\ {
    Assets as AdminAssets,
};

require_once 'vendor/autoload.php';

define( 'KR_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'KR_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

add_action('after_setup_theme', function () {
    Carbon_Fields::boot();
});

ReviewsPostType::get_instance()->init();
ReviewsFields::get_instance()->init();
WidgetsPostType::get_instance()->init();
WidgetsFields::get_instance()->init();
Shortcode::get_instance()->init();
Media::get_instance()->init();
Assets::get_instance()->init();

// REST API
ReviewsAPI::get_instance()->init();

// Admin
AdminAssets::get_instance()->init();