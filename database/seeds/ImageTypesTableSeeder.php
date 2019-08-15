<?php

use Illuminate\Database\Seeder;

class ImageTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("
        	INSERT INTO
        		`image_types` (`id`, `name`, `slug`)
        	VALUES
        		(1, 'Traditional', 'traditional'),
        		(2, 'Digital', 'digital')
        	ON DUPLICATE KEY UPDATE
        		`name` = VALUES(`name`),
        		`slug` = VALUES(`slug`),
        		`created_at` = CURRENT_TIMESTAMP;
        ");
    }
}
