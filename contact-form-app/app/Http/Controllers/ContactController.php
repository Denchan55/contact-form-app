<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use App\Http\Requests\StoreContactRequest;


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

public function confirm(StoreContactRequest $request)

{
    // 電話番号結合
    $request->merge([
        'tel' => $request->tel1 . '-' . $request->tel2 . '-' . $request->tel3
    ]);

    // FormRequest の validated() を使う
    $validated = $request->validated();

    // セッションに保存
    session(['contact_input' => $validated]);

    $categories = [
        ['id' => 1, 'name' => '商品の返品について'],
        ['id' => 2, 'name' => '商品の交換について'],
        ['id' => 3, 'name' => '商品トラブル'],
        ['id' => 4, 'name' => 'ショップへのお問い合わせ'],
        ['id' => 5, 'name' => 'その他'],
    ];

    return view('contact.confirm', compact('validated', 'categories'));
}

public function back()
{
    // ★ セッションの値を old() に流し込む
    return redirect()
        ->route('contact.index')
        ->withInput(session('contact_input'));
}

    public function thanks(Request $request)
{
    // セッションに保存していた入力値を取得
    $input = session('contact_input');

    // DB に保存
    Contact::create($input);

    // セッションの入力値を削除（任意）
    session()->forget('contact_input');

    return view('contact.thanks');
}
public function adminIndex()
{
    $contacts = Contact::latest()->paginate(10);
    $categories = Category::all();

    return view('admin.contacts.index', compact('contacts', 'categories'));
}

}