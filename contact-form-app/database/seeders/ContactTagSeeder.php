<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class ContactTagSeeder extends Seeder
{
    public function run(): void
    {
        $contacts = Contact::all();
        $tags = Tag::all();

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
