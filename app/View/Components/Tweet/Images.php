<?php

namespace App\View\Components\Tweet;

use Illuminate\View\Component;

class Images extends Component
{
    public $images;

    public function __construct($images)
    {
        $this->images = $images;
    }

    public function render()
    {
        return view('components.tweet.images');
    }
}