<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$products = [
            [
	            'name' => 'Cell-phones',
	            'qty' => '1200',
	            'amount' => 15000,
	            'created_at' => date('Y-m-d H:i:s')
	        ],
	        [
	            'name' => 'Cars',
	            'qty' => '3',
	            'amount' => 1400000,
	            'created_at' => date('Y-m-d H:i:s')
	        ]
        ];
        foreach ($products as $product) {
        	DB::table('products')->insert($product);
        }
    }
}
