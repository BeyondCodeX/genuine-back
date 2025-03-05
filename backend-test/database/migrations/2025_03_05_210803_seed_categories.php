<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('categories')->insert([
            ['name' => 'Technology', 'description' => 'Electronic items'],
            ['name' => 'Sports', 'description' => 'sports'],
            ['name'=> 'cosmetic', 'description'=> 'beauty products'],
            ['name' => 'Books', 'description' => 'Reading materials'],
            ['name' => 'Clothing', 'description' => 'Wearable items'],
            ['name' => 'Food', 'description' => 'Edible items'],
            ['name' => 'Furniture', 'description' => 'Household items'],
            ['name' => 'Stationary', 'description' => 'Writing materials'],
            ['name' => 'Toys', 'description' => 'Play items'],
            ['name' => 'Other', 'description' => 'Varoius'],
        ]);
    }
   
};
