<?php

use Illuminate\Database\Seeder;

class TestimoniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Testimony::create(
            ['user_name' => 'sly', 'message' => 'i love you', 'user_id' => 1]
        );
    }
}
