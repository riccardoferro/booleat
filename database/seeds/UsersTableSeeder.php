<?php

use Illuminate\Database\Seeder;
use App\User;
use Faker\Generator as Faker;
use App\Category;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $newUser = new User();
        $newUser->name = "Lucio Melis";
        $newUser->email = "lucio92@gmail.com";
        $newUser->password = Hash::make('123456');
        $newUser->company = "La Parolaccia";
        $newUser->address = "Via Torrente 45";
        $newUser->partita_iva = "12345678402";
        $newUser->image = 'company-default.png';
        $newUser->slug = User::generateToSlug($newUser->company);
        $newUser->save();

        $newUser = new User();
        $newUser->name = "Cristian Tulbu";
        $newUser->email = "critulbu@gmail.com";
        $newUser->password = Hash::make('123456');
        $newUser->company = "Tulbu Sushi";
        $newUser->address = "Via Fiume 31";
        $newUser->partita_iva = "12345678912";
        $newUser->image = 'company-default.png';
        $newUser->slug = User::generateToSlug($newUser->company);
        $newUser->save();

        $newUser = new User();
        $newUser->name = "Daniele Gelsomino";
        $newUser->email = "danigelso@gmail.com";
        $newUser->password = Hash::make('123456');
        $newUser->company = "Gelso Food";
        $newUser->address = "Viale Aldo Moro 7";
        $newUser->partita_iva = "12345678931";
        $newUser->image = 'company-default.png';
        $newUser->slug = User::generateToSlug($newUser->company);
        $newUser->save();

        $newUser = new User();
        $newUser->name = "Silvio Antonioli";
        $newUser->email = "milvioilgrande@gmail.com";
        $newUser->password = Hash::make('123456');
        $newUser->company = "Pizzeria da Silvione";
        $newUser->address = "Piazza San Marco 1";
        $newUser->partita_iva = "12345678759";
        $newUser->image = 'company-default.png';
        $newUser->slug = User::generateToSlug($newUser->company);
        $newUser->save();

        $newUser = new User();
        $newUser->name = "Riccardo Ferro";
        $newUser->email = "riccaferro@gmail.com";
        $newUser->password = Hash::make('123456');
        $newUser->company = "La Torta di Ferro";
        $newUser->address = "Via Gallo 14";
        $newUser->partita_iva = "12345678446";
        $newUser->image = 'company-default.png';
        $newUser->slug = User::generateToSlug($newUser->company);
        $newUser->save();

        $restaurantsImage = config('restaurants');


        for ($i = 0; $i < 10; $i++) {
            $rand = rand(0, count($restaurantsImage) - 1);
            $user = new User();
            $user->name = $faker->name();
            $user->email = $faker->email();
            $user->password = Hash::make('123456');
            $user->company = $faker->company();
            $user->address = $faker->address();
            $user->partita_iva = $faker->shuffle('12345678985');
            $user->image = $restaurantsImage[$rand];
            $user->slug = User::generateToSlug($user->company);
            $user->save();

            for ($j = 0; $j < rand(2, 8); $j++) {

                $user->plates()->create([
                    'price' => $faker->randomFloat(2, 4, 30),
                    'name' => $faker->words(2, true),
                    'description' => $faker->paragraph(),
                    'visible' => rand(0, 1),
                    'image' => 'uploads/TZu4UEBnBxDeD0GUMdjwbpOcLcIRDAT9XWHe4wwZ.png'
                ]);
            }
            $categories = Category::all();
            for ($k = 0; $k < rand(1, 3); $k++) {
                $user->categories()->attach($categories->random(1)->pluck('id')->toArray());
            }
        }
    }
}
