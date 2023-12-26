<?php

namespace Kewl\Reviews\Reviews\Models;

use JsonSerializable;

class Review implements JsonSerializable
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function get_id()
    {
        return $this->id;
    }

    public function get_headline()
    {
        return carbon_get_post_meta($this->id, 'headline');
    }

    public function get_rating()
    {
        return carbon_get_post_meta($this->id, 'rating');
    }

    public function get_attestant()
    {
        return carbon_get_post_meta($this->id, 'attestant');
    }

    public function get_attestant_image()
    {
        return carbon_get_post_meta($this->id, 'attestant_image');
    }

    public function get_attestant_role()
    {
        return carbon_get_post_meta($this->id, 'attestant_role');
    }

    public function get_testimony()
    {
        return carbon_get_post_meta($this->id, 'testimony');
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->get_id(),
            'headline' => $this->get_headline(),
            'rating' => $this->get_rating(),
            'attestant' => $this->get_attestant(),
            'attestant_image' => $this->get_attestant_image(),
            'attestant_role' => $this->get_attestant_role(),
            'testimony' => $this->get_testimony(),
            'date' => $this->get_date(),
        ];
    }
}