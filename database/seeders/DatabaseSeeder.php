<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // $this->call(LaratrustSeeder::class);
        DB::table('users')->insert([
            'name' => 'Indrie Nooraini',
            'email' => 'indrie.nooraini@staff.unsika.ac.id',
            'password' => Hash::make('unsika'),
        ]);
    }
}
