<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* $professions = DB::select('select id from professions where title = ? LIMIT 0,1',[ 'Back-end Developer']);
        dd($professions[0]->id); */
        //minuto 12
        $professions =  DB::table('professions')->select('id')->where('title','=','Back-end Developer')->first();
        //dd($professions);
        DB::table('users')->insert([
            'name' => 'Pedro Porras',
            'email' => 'pporras@pm.me',
            'password' => bcrypt('laravel'),
            'profession_id' => $professions->id
        ]);
    }
}
