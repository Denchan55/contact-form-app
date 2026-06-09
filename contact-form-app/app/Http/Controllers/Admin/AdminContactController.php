<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Tag;
use Illuminate\Http\Request;

class AdminContactController extends Controller
{
    public function index(Request $request)
    {
        $contacts = Contact::with(['category', 'tags'])
            ->latest()
            ->paginate(10);

        $tags = Tag::all();
        $categories = Category::all();

        return view('admin.contacts.index', compact('contacts', 'tags', 'categories'));
    }

    public function show($id)
    {
        $contact = Contact::with(['category', 'tags'])->findOrFail($id);

        return view('admin.contacts.show', compact('contact'));
    }
}
