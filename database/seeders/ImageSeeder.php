<?php

namespace Database\Seeders;

use App\Models\Place;
use Illuminate\Container\Container;
use Illuminate\Database\Seeder;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use Faker\Generator;

class ImageSeeder extends Seeder
{
    private Generator $faker;

    public function __construct() {
        $this->faker = Container::getInstance()->make(Generator::class);
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $places = Place::pluck('id');

        foreach($places as $id){
            $placeImgPath = "img/places/$id";

            Storage::disk('public')->makeDirectory($placeImgPath);

            $path = $this->faker->image(
                storage_path("app/public/img/places/$id"),
                50, 50,
                null, true
            );

            $pathParts = explode('/', $path);
            $imgName = $pathParts[count($pathParts) - 1];

            Storage::disk('public')
                ->move($placeImgPath . "/$imgName", $placeImgPath . '/logo.png');
        }
    }
}
