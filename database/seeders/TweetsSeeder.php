<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tweet;
use App\Models\Image;

class TweetsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tweet::factory(10)->create();
        $tweets = Tweet::all();
        foreach ($tweets as $tweet) {
            for ($i = 0; $i < 4; $i++) {
                $image = Image::factory()->create();
                $tweet->images()->attach($image->id);
            }
        }
    }
}