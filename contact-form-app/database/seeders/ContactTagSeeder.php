<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ContactTagSeeder extends Seeder
{
    public function run(): void
    {
        $contacts = \App\Models\Contact::all();
        $tags = \App\Models\Tag::all();

        if ($tags->isEmpty()) {
            return;
        }

        foreach ($contacts as $contact) {
            $contact->tags()->attach(
                $tags->random(rand(1, 3))->pluck('id')->toArray()
            );
        }
    }
}
