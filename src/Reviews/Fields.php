<?php

namespace Kewl\Reviews\Reviews;

use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Kewl\Reviews\Singleton;

class Fields extends Singleton
{
    public function init()
    {
        add_action('carbon_fields_register_fields', [$this, 'register_fields']);
    }

    public function register_fields()
    {
        Container::make('post_meta', 'Testimonial Data')
            ->where('post_type', '=', PostType::POST_TYPE)
            ->add_fields([
                Field::make('text', 'headline', 'Headline'),
                Field::make('radio', 'rating', 'Rating')
                    ->set_options(array_combine(
                        range(1, 5),
                        range(1, 5)
                    )),
                Field::make('text', 'attestant', 'Attestant'),
                Field::make('image', 'attestant_image', 'Attestant Image'),
                Field::make('text', 'attestant_role', 'Attestant Role'),
                Field::make('textarea', 'testimony', 'Testimony'),
            ]);
    }
}