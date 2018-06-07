<?php

use Illuminate\Database\Seeder;

class GroupMember extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->insert([
            ['id' => 1,'name' => 'Group 1','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 2,'name' => 'Group 2','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 3,'name' => 'Group 3','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 4,'name' => 'Group 4','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 5,'name' => 'Group 5','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 6,'name' => 'Group 6','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
        ]);

        DB::table('sub_groups')->insert([
            ['id' => 1,'group_id' => 1,'name' => 'Sub Group 1','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 2,'group_id' => 1,'name' => 'Sub Group 2','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 3,'group_id' => 1,'name' => 'Sub Group 3','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 4,'group_id' => 2,'name' => 'Sub Group 1','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 5,'group_id' => 3,'name' => 'Sub Group 1','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 6,'group_id' => 4,'name' => 'Sub Group 1','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 7,'group_id' => 5,'name' => 'Sub Group 1','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 8,'group_id' => 6,'name' => 'Sub Group 1','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],

        ]);

        DB::table('positions')->insert([
            ['id' => 1,'group_id' => 1,'sub_group_id' => 1,'name' => 'Position 1','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 2,'group_id' => 1,'sub_group_id' => 1,'name' => 'Position 2','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 3,'group_id' => 1,'sub_group_id' => 1,'name' => 'Position 3','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 4,'group_id' => 1,'sub_group_id' => 1,'name' => 'Position 4','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 5,'group_id' => 1,'sub_group_id' => 2,'name' => 'Position 1','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 6,'group_id' => 1,'sub_group_id' => 2,'name' => 'Position 2','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 7,'group_id' => 1,'sub_group_id' => 2,'name' => 'Position 3','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 8,'group_id' => 1,'sub_group_id' => 2,'name' => 'Position 4','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 9,'group_id' => 1,'sub_group_id' => 3,'name' => 'Position 1','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 10,'group_id' => 1,'sub_group_id' => 3,'name' => 'Position 2','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 11,'group_id' => 1,'sub_group_id' => 3,'name' => 'Position 3','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 12,'group_id' => 1,'sub_group_id' => 3,'name' => 'Position 4','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 13,'group_id' => 2,'sub_group_id' => 4,'name' => 'Position 1','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 14,'group_id' => 2,'sub_group_id' => 4,'name' => 'Position 2','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 15,'group_id' => 2,'sub_group_id' => 4,'name' => 'Position 3','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 16,'group_id' => 2,'sub_group_id' => 4,'name' => 'Position 4','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 17,'group_id' => 3,'sub_group_id' => 5,'name' => 'Position 1','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 18,'group_id' => 3,'sub_group_id' => 5,'name' => 'Position 2','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 19,'group_id' => 3,'sub_group_id' => 5,'name' => 'Position 3','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 20,'group_id' => 3,'sub_group_id' => 5,'name' => 'Position 4','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 21,'group_id' => 4,'sub_group_id' => 6,'name' => 'Position 1','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 22,'group_id' => 4,'sub_group_id' => 6,'name' => 'Position 2','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 23,'group_id' => 4,'sub_group_id' => 6,'name' => 'Position 3','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 24,'group_id' => 4,'sub_group_id' => 6,'name' => 'Position 4','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 25,'group_id' => 5,'sub_group_id' => 7,'name' => 'Position 1','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 26,'group_id' => 5,'sub_group_id' => 7,'name' => 'Position 2','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 27,'group_id' => 5,'sub_group_id' => 7,'name' => 'Position 3','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 28,'group_id' => 5,'sub_group_id' => 7,'name' => 'Position 4','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 29,'group_id' => 6,'sub_group_id' => 8,'name' => 'Position 1','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 30,'group_id' => 6,'sub_group_id' => 8,'name' => 'Position 2','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 31,'group_id' => 6,'sub_group_id' => 8,'name' => 'Position 3','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
            ['id' => 32,'group_id' => 6,'sub_group_id' => 8,'name' => 'Position 4','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')],
        ]);
    }
}
