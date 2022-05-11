<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Invoice;
use App\Models\Item;
use App\Models\Order;
use App\Models\SubCategory;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $password = bcrypt('password');
        $faker = Factory::create();
        // $user1 = User::create(['name' => 'andijaya', 'email' => 'andijayawizard@gmail.com', 'password' => bcrypt('andijaya')]);
        $user1 = User::create(['name' => $faker->name, 'email' => $faker->email, 'password' => $password]);

        for ($i = 0; $i <= 4; $i++) {
            $brand = Brand::create(['nama' => $faker->word, 'rgks' => $faker->word, 'ktrg' => $faker->word]);
        }

        $category1 = Category::create(['name' => $faker->word]);
        $category2 = Category::create(['name' => $faker->word]);

        $subCategory1 = SubCategory::create(['name' => $faker->word, 'category_id' => $category1->id]);
        $subCategory2 = SubCategory::create(['name' => $faker->word, 'category_id' => $category1->id]);

        $subCategory3 = SubCategory::create(['name' => $faker->word, 'category_id' => $category2->id]);
        $subCategory4 = SubCategory::create(['name' => $faker->word, 'category_id' => $category2->id]);

        $item1 = Item::create([
            'sub_category_id' => 2,
            'name' => $faker->name,
            'description' => $faker->text,
            'type' => $faker->word,
            'price' => $faker->randomNumber(2),
            'quantity_in_stock' => $faker->randomNumber(2)
        ]);
        $item2 = Item::create([
            'sub_category_id' => 2,
            'name' => $faker->name,
            'description' => $faker->text,
            'type' => $faker->word,
            'price' => $faker->randomNumber(3),
            'quantity_in_stock' => $faker->randomNumber(2)
        ]);
        $item3 = Item::create([
            'sub_category_id' => 4,
            'name' => $faker->name,
            'description' => $faker->text,
            'type' => $faker->word,
            'price' => $faker->randomNumber(4),
            'quantity_in_stock' => $faker->randomNumber(2)
        ]);
        $item4 = Item::create([
            'sub_category_id' => 4,
            'name' => $faker->name,
            'description' => $faker->text,
            'type' => $faker->word,
            'price' => $faker->randomNumber(1),
            'quantity_in_stock' => $faker->randomNumber(3)
        ]);

        $order1 = Order::create([
            'status' => 'confirmed',
            'total_value' => $faker->randomNumber(3),
            'taxes' => $faker->randomNumber(1),
            'shipping_charges' => $faker->randomNumber(2),
            'user_id' => $user1->id
        ]);
        $order2 = Order::create([
            'status' => 'waiting',
            'total_value' => $faker->randomNumber(3),
            'taxes' => $faker->randomNumber(1),
            'shipping_charges' => $faker->randomNumber(2),
            'user_id' => $user1->id
        ]);

        $order1->items()->attach($item1);
        $order1->items()->attach($item2);
        $order1->items()->attach($item3);

        $order2->items()->attach($item1);
        $order2->items()->attach($item4);

        $invoice1 = Invoice::create([
            'raised_at' => $faker->dateTimeThisMonth(),
            'status' => 'settled',
            'totalAmount' => $faker->randomNumber(3),
            'order_id' => $order1->id
        ]);
    }
}