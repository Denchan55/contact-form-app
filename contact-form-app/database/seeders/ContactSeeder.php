<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\Tag;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('ja_JP');

        // タグ一覧を取得
        $tags = Tag::all()->pluck('id')->toArray();

        for ($i = 0; $i < 20; $i++) {

            // Contact を作成
            $contact = Contact::create([
                'first_name' => $faker->lastName,
                'last_name' => $faker->firstName,
                'gender' => $faker->randomElement([1, 2, 3]),
                'email' => $faker->unique()->safeEmail,
                'tel' => $faker->phoneNumber,
                'address' => $faker->address,
                'building' => $faker->secondaryAddress,
                'category_id' => $faker->numberBetween(1, 5),
                'detail' => $faker->realText(50),
                'created_at' => $faker->dateTimeBetween('-30 days', 'now'),
            ]);

            // タグを 0〜3 個ランダムで付与
            $randomTags = $faker->randomElements($tags, rand(0, 3));
            $contact->tags()->sync($randomTags);
        }
    }
}
