<?php

namespace Kewl\Reviews\Reviews;

use Kewl\Reviews\Singleton;
use Kewl\Reviews\Widgets\PostType as WidgetsPostType;

class PostType extends Singleton
{
    const POST_TYPE = 'kewl-review';

    public function init()
    {
        add_action('init', [$this, 'register']);
    }

    public function register()
    {
        $labels = [
            'name' => 'Reviews',
            'singular_name' => 'Review',
            'menu_name' => 'Reviews',
            'name_admin_bar' => 'Review',
            'add_new' => 'Add New',
            'add_new_item' => 'Add New Review',
            'new_item' => 'New Review',
            'edit_item' => 'Edit Review',
            'view_item' => 'View Review',
            'all_items' => 'All Reviews',
            'search_items' => 'Search Reviews',
            'parent_item_colon' => 'Parent Reviews:',
            'not_found' => 'No Reviews found.',
            'not_found_in_trash' => 'No Reviews found in Trash.',
            'featured_image' => 'Review Cover Image',
            'set_featured_image' => 'Set cover image',
            'remove_featured_image' => 'Remove cover image',
            'use_featured_image' => 'Use as cover image',
            'archives' => 'Review archives',
            'insert_into_item' => 'Insert into Review',
            'uploaded_to_this_item' => 'Uploaded to this Review',
            'filter_items_list' => 'Filter Reviews list',
            'items_list_navigation' => 'Reviews list navigation',
            'items_list' => 'Reviews list',
        ];
        $args = [
            'label' => 'Review',
            'labels' => $labels,
            'description' => '',
            'public' => true,
            'publicly_queryable' => false,
            'show_ui' => true,
            'show_in_menu' => 'edit.php?post_type=' . WidgetsPostType::POST_TYPE,
            'menu_icon' => 'dashicons-testimonial',
            'supports' => [
                'title',
            ],
        ];
        register_post_type(self::POST_TYPE, $args);
    }
}