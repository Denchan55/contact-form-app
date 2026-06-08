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

    $tags = \App\Models\Tag::all(); // ← これを追加！

    return view('contact.index', compact('categories', 'tags'));
}


public function confirm(StoreContactRequest $request)
{
    $request->merge([
        'tel' => $request->tel1 . '-' . $request->tel2 . '-' . $request->tel3
    ]);

    $validated = $request->validated();

    session(['contact_input' => $validated]);

    $categories = [
        ['id' => 1, 'name' => '商品の返品について'],
        ['id' => 2, 'name' => '商品の交換について'],
        ['id' => 3, 'name' => '商品トラブル'],
        ['id' => 4, 'name' => 'ショップへのお問い合わせ'],
        ['id' => 5, 'name' => 'その他'],
    ];

    // ★ 追加：選択されたタグだけ取得
    $tags = \App\Models\Tag::whereIn('id', $validated['tag_ids'] ?? [])->get();

    return view('contact.confirm', compact('validated', 'categories', 'tags'));
}


public function back()
{
    return redirect()
        ->route('contact.index')
        ->withInput(session('contact_input'));
}

    public function thanks(Request $request)
{
    $input = session('contact_input');

    Contact::create($input);

    session()->forget('contact_input');

    return view('contact.thanks');
}
public function adminIndex(Request $request)
{
    $query = Contact::query();

    // キーワード検索（名前 or メール）
    if ($request->filled('keyword')) {
        $keyword = $request->keyword;
        $query->where(function ($q) use ($keyword) {
            $q->where('first_name', 'like', "%{$keyword}%")
            ->orWhere('last_name', 'like', "%{$keyword}%")
            ->orWhere('email', 'like', "%{$keyword}%");
        });
    }

    // 性別
    if ($request->filled('gender') && $request->gender != 0) {
        $query->where('gender', $request->gender);
    }

    // お問い合わせの種類
    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    // 日付検索（created_at の日付一致）
    if ($request->filled('date')) {
        $query->whereDate('created_at', $request->date);
    }

    // 結果取得
    $contacts = $query->latest()->paginate(10)->appends($request->query());

    // カテゴリ一覧
    $categories = Category::all();

    // ★ タグ管理用（これがないと Blade のタグ管理が消える）
    $tags = \App\Models\Tag::all();

    return view('admin.contacts.index', compact('contacts', 'categories', 'tags'));
}
public function adminShow($id)
{
    $contact = Contact::with(['category', 'tags'])->findOrFail($id);

    return view('admin.contacts.show', compact('contact'));
}


}