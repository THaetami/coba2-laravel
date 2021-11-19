<?php

namespace Database\Seeders;

use App\Models\Puisi;
use App\Models\Author;
use App\Models\Drakor;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         Author::create([
            'name' => 'Tatang Haetami',
            'username' => 'Tatang119',
            'email' => 'tatanghaetami.97@gmail.com',
            'password' => bcrypt('12345')
        ]);

        Author::factory(3)->create();

        Puisi::factory(20)->create();

        Drakor::factory(20)->create();
    }
}
