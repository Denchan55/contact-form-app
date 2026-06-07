<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class AdminTagController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        Tag::create(['name' => $request->name]);
        return back();
    }

    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag)
    {
        $request->validate(['name' => 'required']);
        $tag->update(['name' => $request->name]);
        return redirect()->route('admin.contacts.index');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return back();
    }
}
