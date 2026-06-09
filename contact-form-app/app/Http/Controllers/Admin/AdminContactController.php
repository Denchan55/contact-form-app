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

    public function export()
{
    $fileName = 'contacts_' . now()->format('Ymd_His') . '.csv';

    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => "attachment; filename={$fileName}",
    ];

    $callback = function () {
        $handle = fopen('php://output', 'w');

        // CSVヘッダー
        fputcsv($handle, [
            'ID',
            '名前',
            'メールアドレス',
            '電話番号',
            '性別',
            'カテゴリ',
            'タグ',
            'お問い合わせ内容',
            '作成日',
        ]);

        // データ取得
        $contacts = Contact::with(['category', 'tags'])->get();

        foreach ($contacts as $contact) {
            fputcsv($handle, [
                $contact->id,
                $contact->name,
                $contact->email,
                $contact->tel,
                $contact->gender,
                $contact->category->name ?? '',
                $contact->tags->pluck('name')->join(','),
                $contact->body,
                $contact->created_at->format('Y-m-d H:i:s'),
            ]);
        }

        fclose($handle);
    };

    return response()->streamDownload($callback, $fileName, $headers);
}

}
