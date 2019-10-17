<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            ]); */
        
        
        
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
    }
}
