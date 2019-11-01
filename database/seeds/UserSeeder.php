<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Profession;
use App\Book;

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
        //$professionId =  DB::table('professions')->select('id')->where('title','=','Back-end Developer')->first();
        //$professionId =  DB::table('professions')->where('title','=','Back-end Developer')->first();
        //$professionId =  DB::table('professions')->where(['title' => 'Back-end Developer'])->first();
        /**$professionId =  DB::table('professions')
            ->where('title', 'Back-end Developer')
            ->value('id');*/
        //Metodos magicos whereTitle
       /*  $professionId =  DB::table('professions')
            ->whereTitle('Back-end Developer')
            ->value('id'); */
        $professionId =  Profession::where(['title' => 'Back-end Developer'])->value('id');

        //dd($professionId);
        /* DB::table('users')->insert([
            'name' => 'Pedro Porras',
            'email' => 'pporras@pm.me',
            'password' => bcrypt('laravel'),
            'profession_id' => $professionId
        ]); */

        /* $professions = Profession::all();
        dd($professions); */
        /**User::create([
            'name' => 'Pedro Porras',
            'email' => 'pporras@pm.me',
            'password' => bcrypt('laravel'),
            'profession_id' => $professionId,
            'is_admin' => true
        ]);
       User::create([
            'name' => 'Pablo Medina',
            'email' => 'pmedina@ht.com',
            'password' => bcrypt('123laravel'),
            'profession_id' => $professionId
        ]);
        User::create([
            'name' => 'Mateo Lopez',
            'email' => 'mlopez@mail.com',
            'password' => bcrypt('laravel123'),
            'profession_id' => null
        ]);*/
        factory(User::class)->create([
            'name' => 'Pedro Porras',
            'email' => 'pporras@pm.me',
            'password' => bcrypt('laravel'),
            'profession_id' => $professionId,
            'is_admin' => true
        ]);

        factory(User::class)->create([
            'profession_id' => $professionId
        ]);

        //Creación de 75 usuarios aleatorios
        //factory(User::class,75)->create();
        factory(User::class,10)->create();
        factory(Book::class,30)->create();

    }
}
