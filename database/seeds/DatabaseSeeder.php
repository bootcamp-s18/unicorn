<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      $names = ['John', 'Ringo', 'Paul', 'George'];

        foreach ($names as $name) {

          DB::table('users')->insert([
            'name' => $name,
            'email' => strtolower($name) . '@example.com',
            'password' => bcrypt(strtolower($name)),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
          ]);

        }

        DB::table('contacts')->insert([
          'first_name' => 'Sam',
          'last_name' => 'Jackson',
          'personal_email' => 'sam@example.com',
          'cell_phone' => 8595550687,
          'address' => '300 North Broadway Lexington KY 40508',
          'creator_id' => '1',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ]);

        DB::table('contacts')->insert([
          'first_name' => 'Jackson',
          'last_name' => 'Samson',
          'personal_email' => 'jack@example.com',
          'cell_phone' => 8595551234,
          'address' => '300 North Broadway Lexington KY 40508',
          'creator_id' => '1',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ]);

        DB::table('contacts')->insert([
          'first_name' => 'Sally',
          'last_name' => 'Ride',
          'personal_email' => 'sally@example.com',
          'cell_phone' => 8595559876,
          'address' => 'NASA, Houston, TX',
          'creator_id' => '1',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ]);

        DB::table('contacts')->insert([
          'first_name' => 'Samantha',
          'last_name' => 'Jackson',
          'personal_email' => 'samantha@example.com',
          'cell_phone' => 8595557654,
          'address' => '100 Elm Street, Lexington KY 40508',
          'creator_id' => '1',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ]);

    }
}
