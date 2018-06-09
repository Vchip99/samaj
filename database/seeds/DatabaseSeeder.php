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
        DB::table('business_categories')->insert([
            ['id' => 1,'name' => 'Accountant','have_sub_category' => 0,'created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 2,'name' => 'Advocate','have_sub_category' => 0,'created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 3,'name' => 'Architect','have_sub_category' => 0,'created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 4,'name' => 'Bichayat/Decoration','have_sub_category' => 0,'created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 5,'name' => 'Broker','have_sub_category' => 1,'created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 6,'name' => 'Builder & Land developer','have_sub_category' => 0,'created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 7,'name' => 'CA','have_sub_category' => 0,'created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 8,'name' => 'Catering','have_sub_category' => 0,'created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 9,'name' => 'Cloth Store','have_sub_category' => 0,'created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 10,'name' => 'Coaching Classes','have_sub_category' => 0,'created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 11,'name' => 'Designer Graphics and Other','have_sub_category' => 1,'created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 12,'name' => 'Dealer','have_sub_category' => 1,'created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 13,'name' => 'Doctor','have_sub_category' => 0,'created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 14,'name' => 'Electrical','have_sub_category' => 0,'created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 15,'name' => 'Event Management','have_sub_category' => 0,'created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 16,'name' => 'General Store','have_sub_category' => 0,'created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 17,'name' => 'Grain Merchant','have_sub_category' => 0,'created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 18,'name' => 'Hardware','have_sub_category' => 0,'created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 19,'name' => 'Industry','have_sub_category' => 0,'created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 20,'name' => 'Kirana','have_sub_category' => 0,'created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 21,'name' => 'Medical','have_sub_category' => 0,'created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 22,'name' => 'Politician','have_sub_category' => 0,'created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 23,'name' => 'Printing & Designing','have_sub_category' => 0,'created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 24,'name' => 'Related to Software Services','have_sub_category' => 0,'created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 25,'name' => 'Restaurant','have_sub_category' => 0,'created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 26,'name' => 'Sonaar (Work in Gold & Silver)','have_sub_category' => 0,'created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 27,'name' => 'Sweet Mart','have_sub_category' => 0,'created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 28,'name' => 'Trainer','have_sub_category' => 0,'created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 29,'name' => 'Transport','have_sub_category' => 0,'created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 30,'name' => 'Travel Agent','have_sub_category' => 0,'created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 31,'name' => 'Water Can','have_sub_category' => 0,'created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 32,'name' => 'Wholesale Dealer','have_sub_category' => 0,'created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
        ]);

		DB::table('business_sub_categories')->insert([
            ['id' => 1,'business_category_id' => 5,'name' => 'Cotton','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 2,'business_category_id' => 5,'name' => 'Finance','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 3,'business_category_id' => 5,'name' => 'Grain','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 4,'business_category_id' => 5,'name' => 'LIC Agent','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 5,'business_category_id' => 5,'name' => 'Property','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 6,'business_category_id' => 5,'name' => 'Share Broker','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 7,'business_category_id' => 12,'name' => 'Bike/Car','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 8,'business_category_id' => 12,'name' => 'Laptop','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 9,'business_category_id' => 12,'name' => 'Mobile','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 10,'business_category_id' => 12,'name' => 'TV/Refrigerator','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
		]);
    }
}
