<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $areas = ['Asia','Europe','America','Africa','Oceania'];
      foreach($areas as $area){
        DB::table('destinations')->insert(
          [
            'id' => null,
            'area' => $area,
            'created_at' => Carbon::today(),
            'updated_at' => Carbon::today()
          ]);
      }
    }
}
