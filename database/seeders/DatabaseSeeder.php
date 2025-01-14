<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;



use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Destination;
use App\Models\Mission;
use App\Models\Driver;
use App\Models\Car;
use App\Models\Expediteur;
use App\Models\Setting;
use App\Models\Mail;
use App\Models\Courrire;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $citiesPath = database_path('seeders/sql/cities.sql');
        $regionPath = database_path('seeders/sql/region.sql');

        $regionSql = File::get($regionPath);
        $citiesSql = File::get($citiesPath);

        // DB::unprepared($regionSql);
        // DB::unprepared($citiesSql);

        $this->command->info('SQL file imported successfully!');

        if(!User::where('name', 'admin')->first()){
            $user = User::create([
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make("password"),
                'role' => "ADMIN"
            ]);

            $idress = User::create([
                'name' => 'idress',
                'email' => 'idress@gmail.com',
                'password' => Hash::make("password"),
                'role' => "ADMIN"
            ]);

            Setting::create([
                'user_id' => $idress->id,
                "data_bs_theme" => "light",
                "data_layout_position" => "fixed",
                "data_topbar" => "light",
                "data_sidebar" => "dark",
                'region_id' => 9,
                "name" => "Maroc Meteo Du Agadir Souse Massa Region"
            ]);

            Setting::create([
                'user_id' => $user->id,
                "data_bs_theme" => "light",
                "data_layout_position" => "fixed",
                "data_topbar" => "light",
                "data_sidebar" => "dark",
                'region_id' => 9,
                "name" => "Maroc Meteo Du Agadir Souse Massa Region"
            ]);

        }

        // Expediteur::factory(10)->create();
        // Destination::factory(10)->create();
        // Courrire::factory(100)->create();
        // Mail::factory(50)->create();
        // Car::factory(10)->create();
        // Driver::factory(10)->create();
        Mission::factory(10)->create();
        
        $this->command->info('Seeder imported successfully!');
        
    }

}
