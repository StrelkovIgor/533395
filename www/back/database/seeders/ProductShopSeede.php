<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Shop;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductShopSeede extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->testData();
    }

    public function testData(int $numberLines = 100)
    {
        for($i = 0; $i < $numberLines; $i++ ){
            $date = Carbon::now();
            $date->addHours($i);

            DB::table('product_shop')->insert([
                'product_id' => Product::inRandomOrder()->first()->id,
                'shop_id' => Shop::inRandomOrder()->first()->id,
                'article' => "ART{$i}",
                'import' => $date
            ]);
        }

    }
}
