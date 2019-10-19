<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Profession;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       /*  DB::insert('insert into professions (title) values (:title)', [
            'title' => 'Back-end Developer',
            'title' => 'Front-end Developer'
            ]); 

        DB::table('professions')->insert([
            'title' => 'Back-end Developer'
        ]);
         DB::table('professions')->insert([
            'title' => 'Front-end Developer'
        ]);
        DB::table('professions')->insert([
            'title' => 'FullStack Developer'
        ]);
        DB::table('professions')->insert([
            'title' => 'Web Designer'
        ]);
        DB::table('professions')->insert([
            'title' => 'QA Developer'
        ]);
        */
        
        Profession::create([
            'title' => 'Back-end Developer'
        ]);
        Profession::create([
            'title' => 'Front-end Developer'
        ]);
        Profession::create([
            'title' => 'FullStack Developer'
        ]);
        Profession::create([
            'title' => 'Web Designer'
        ]);
        Profession::create([
            'title' => 'QA Developer'
        ]);
        //createcion de 17 profesiones aleatorias.
        factory(Profession::class)->times(17)->create();
        
       
    }
}
