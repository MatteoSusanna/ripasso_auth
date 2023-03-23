<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $generi = [ 'Azione', 'Avventura', 'Commedia', 'Drammatico', 'Fantasy', 'Horror', 'Mistero', 'Romantico', 'Sport', 'Musicale', 'Psicologico', 'Storico', 'Superpoteri', 'Mecha'];

        foreach($generi as $genere){
            $newGenere = new Category();
            $newGenere->nome = $genere;
            $newGenere->save();
        }
    }
}
