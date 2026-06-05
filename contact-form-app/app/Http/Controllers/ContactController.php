<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
{
    $categories = [
        ['id' => 1, 'name' => '商品の返品について'],
        ['id' => 2, 'name' => '商品の交換について'],
        ['id' => 3, 'name' => '商品トラブル'],
        ['id' => 4, 'name' => 'ショップへのお問い合わせ'],
        ['id' => 5, 'name' => 'その他'],
];

    return view('contact.index', compact('categories'));
}

    public function confirm(Request $request)
{
$request->merge([
        'tel' => $request->tel1 . '-' . $request->tel2 . '-' . $request->tel3
    ]);

    $validated = $request->validate([
        'first_name' => 'required|string|max:50',
        'last_name' => 'required|string|max:50',
        'gender' => 'required|integer',
        'email' => 'required|email|max:255',
        'tel' => 'nullable|string|max:20',
        'address' => 'required|string|max:255',
        'building' => 'nullable|string|max:255',
        'category_id' => 'required|integer',
        'detail' => 'required|string|max:500',
    
    ]);
    $categories = [
        ['id' => 1, 'name' => '商品の返品について'],
        ['id' => 2, 'name' => '商品の交換について'],
        ['id' => 3, 'name' => '商品トラブル'],
        ['id' => 4, 'name' => 'ショップへのお問い合わせ'],
        ['id' => 5, 'name' => 'その他'],
    ];
   return view('contact.confirm', compact('validated', 'categories'));}

    public function thanks(Request $request)
    {
        return view('contact.thanks');
    }

}