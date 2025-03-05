<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('products')->insert([
            ['name' => 'Smartphone', 'description' => 'Latest model smartphone', 'quantity' => 2, 'category_id' => 1],
            ['name' => 'Novel', 'description' => 'Bestselling novel', 'quantity' => 3, 'category_id' => 4],
            ['name' => 'T-shirt', 'description' => 'Comfortable cotton t-shirt', 'quantity' => 54, 'category_id' => 5],
            ['name' => 'pc', 'description' => 'pc', 'quantity' => 1, 'category_id' => 1],
            ['name' => 'Tablet', 'description' => 'airpad', 'quantity' => 12, 'category_id' => 1],

            ['name' => 'Pants', 'description' => 'descript', 'quantity' => 12, 'category_id' => 5],
            ['name'=> 'car', 'description'=> '','quantity'=> 1, 'category_id'=> 1],
            ['name' => 'Laptop', 'description' => 'Laptop', 'quantity' => 1, 'category_id' => 1],
            ['name' => 'Shoes', 'description' => 'Shoes', 'quantity' => 12, 'category_id' => 5],
            ['name'=> 'bottle', 'description'=> '','quantity'=> 1, 'category_id'=> 1],
            ['name' => 'Sweater', 'description' => 'Sweater', 'quantity' => 12, 'category_id' => 9],
            ['name' => 'Headphones', 'description' => 'Headphones', 'quantity' => 12, 'category_id' => 1],





        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
