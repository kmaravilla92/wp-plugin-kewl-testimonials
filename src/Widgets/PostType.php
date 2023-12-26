<?php

namespace Kewl\Reviews\Widgets;

use Kewl\Reviews\Singleton;

class PostType extends Singleton
{
    const POST_TYPE = 'kewl-review-widget';

    public function init()
    {
        add_action('init', [$this, 'register']);
    }

    public function register()
    {
        $labels = [
            'name' => 'Reviews Widgets',
            'singular_name' => 'Reviews Widget',
            'menu_name' => 'Reviews Widgets',
            'name_admin_bar' => 'Reviews Widget',
            'add_new' => 'Add New',
            'add_new_item' => 'Add New Reviews Widget',
            'new_item' => 'New Reviews Widget',
            'edit_item' => 'Edit Reviews Widget',
            'view_item' => 'View Reviews Widget',
            'all_items' => 'All Reviews Widgets',
            'search_items' => 'Search Reviews Widgets',
            'parent_item_colon' => 'Parent Reviews Widgets:',
            'not_found' => 'No Reviews Widgets found.',
            'not_found_in_trash' => 'No Reviews Widgets found in Trash.',
            'featured_image' => 'Reviews Widget Cover Image',
            'set_featured_image' => 'Set cover image',
            'remove_featured_image' => 'Remove cover image',
            'use_featured_image' => 'Use as cover image',
            'archives' => 'Reviews Widget archives',
            'insert_into_item' => 'Insert into Reviews Widget',
            'uploaded_to_this_item' => 'Uploaded to this Reviews Widget',
            'filter_items_list' => 'Filter Reviews Widgets list',
            'items_list_navigation' => 'Reviews Widgets list navigation',
            'items_list' => 'Reviews Widgets list',
        ];
        $args = [
            'label' => 'Review',
            'labels' => $labels,
            'description' => '',
            'public' => true,
            'publicly_queryable' => false,
            'show_ui' => true,
            'menu_icon' => 'dashicons-testimonial',
            'supports' => [
                'title',
            ],
            // 'taxonomies' => [],
        ];
        register_post_type(self::POST_TYPE, $args);
    }
}