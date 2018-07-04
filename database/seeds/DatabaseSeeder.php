<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->insert([
              ['id' => 1,'name' => 'Maheshwari Panchayat','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
              ['id' => 2,'name' => 'Navyuvak Mandal','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
              ['id' => 3,'name' => 'Mahila Mandal','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
              ['id' => 4,'name' => 'Varishth Nagrik','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
              ['id' => 5,'name' => 'Maheshwari Jilha Sangathan','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
              ['id' => 6,'name' => 'Maheshwari Seva Manch','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
              ['id' => 7,'name' => 'Maheshwari Aadhar Samati','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
              ['id' => 8,'name' => 'Maheshwari Group 8','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
              ['id' => 9,'name' => 'Maheshwari Group 9','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
        ]);

        DB::table('sub_groups')->insert([
              ['id' => 1,'group_id' => 1,'name' => 'Executive Body','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
              ['id' => 2,'group_id' => 2,'name' => 'Executive Body','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
              ['id' => 3,'group_id' => 2,'name' => 'Members','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
              ['id' => 4,'group_id' => 2,'name' => 'Past President','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
              ['id' => 5,'group_id' => 3,'name' => 'Executive Body','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
              ['id' => 6,'group_id' => 4,'name' => 'Executive Body','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
              ['id' => 7,'group_id' => 5,'name' => 'Executive Body','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
              ['id' => 8,'group_id' => 6,'name' => 'Executive Body','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
              ['id' => 9,'group_id' => 7,'name' => 'Executive Body','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
              ['id' => 10,'group_id' => 8,'name' => 'Executive Body','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
              ['id' => 11,'group_id' => 9,'name' => 'Executive Body','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
              ['id' => 12,'group_id' => 2,'name' => 'App Formation Team','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
        ]);

        DB::table('positions')->insert([
              ['name' => 'President','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
              ['name' => 'Past President','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
              ['name' => 'Vice President','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
              ['name' => 'Secretary','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
              ['name' => 'Joint Secretary','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
              ['name' => 'Treasure','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
              ['name' => 'Joint Treasure','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
              ['name' => 'Sangathan Mantri','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
              ['name' => 'P.R.O','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
              ['name' => 'Promotional Head','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
              ['name' => 'Executive Member','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
              ['name' => 'Memberes','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
              ['name' => 'IIP','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
              ['name' => 'Chief Editor','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
              ['name' => 'Editor','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
              ['name' => 'Editorial board member','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
              ['name' => 'Joint Secretary Temple','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
              ['name' => 'Secretary Temple','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
              ['name' => 'Joint Sanghatan Mantri','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
        ]);
    }
}
