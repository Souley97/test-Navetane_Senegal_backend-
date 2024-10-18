<?php

namespace Database\Seeders;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {



    $this->call(UsersTableSeeder::class);
    $this->call(ZoneSeeder::class);
    $this->call(CompetitionSeeder::class);
    $this->call(EquipeSeeder::class);
    $this->call(CategorieSeeder::class);
    $this->call(JoueurSeeder::class);
    $this->call(MatcheSeeder::class);
    $this->call(TirageSeeder::class);
    $this->call(CompetitionEquipeSeeder::class);
    $this->call(HistoriqueJoueurEquipeSeeder::class);
    $this->call(StatistiqueJoueurSeeder::class);
    $this->call(ClassementsSeeder::class);


    }






}






