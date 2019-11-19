<?php

use Illuminate\Database\Seeder;
use Partymeister\Competitions\Models\Competition;

/**
 * Class AccountsTableSeeder
 * @package Partymeister\Accounting\Database\Seeds
 */
class EntriesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $competition = Competition::first();
        Artisan::call('partymeister:competitions:generate:entry '.$competition->id.' 5');
    }
}
