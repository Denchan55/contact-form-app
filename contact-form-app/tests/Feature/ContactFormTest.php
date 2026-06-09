<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    public function test_confirm_page_accepts_valid_input()
{
    $response = $this->post('/contacts/confirm', [
    'first_name' => '山田',
    'last_name' => '太郎',
    'gender' => 1,
    'email' => 'test@example.com',
    'tel1' => '090',
    'tel2' => '1234',
    'tel3' => '5678',
    'tel' => '09012345678', // hidden と同じ
    'address' => '東京都',
    'building' => 'ビル101',
    'category_id' => 1,
    'detail' => 'お問い合わせ内容です。',
]);
    $response->assertStatus(200);
}
public function test_confirm_page_rejects_invalid_input()
{
    $response = $this->post('/contacts/confirm', [
        'first_name' => '',
        'last_name' => '',
        'gender' => 99,
        'email' => 'invalid-email',
        'tel1' => 'abc',
        'tel2' => 'def',
        'tel3' => 'ghi',
        'tel' => 'abc',
        'address' => '',
        'building' => '',
        'category_id' => 999,
        'detail' => '',
    ]);

    // バリデーションエラーは 302 リダイレクト
    $response->assertStatus(302);

    // エラーが出るべき項目
    $response->assertSessionHasErrors([
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'category_id',
        'detail',
    ]);
}
public function test_thanks_page_saves_data()
{
    // ① session にデータを入れる
    $data = [
        'first_name' => '山田',
        'last_name' => '太郎',
        'gender' => 1,
        'email' => 'test@example.com',
        'tel' => '09012345678',
        'address' => '東京都',
        'building' => 'ビル101',
        'category_id' => 1,
        'detail' => 'お問い合わせ内容です。',
    ];

    session(['contact_input' => $data]);

    // ② thanks に POST
    $response = $this->post('/contacts/thanks');

    // ③ DB に保存されているか
    $this->assertDatabaseHas('contacts', [
        'email' => 'test@example.com',
    ]);

    // ④ thanks ページが表示される
    $response->assertStatus(200);
}

public function test_admin_contact_list_displays_contacts()
{
    // ★ 管理者としてログイン（admin guard）
    $admin = \App\Models\Admin::factory()->create();
    $this->actingAs($admin, 'admin');
    // テストデータを作成
    $contact = \App\Models\Contact::factory()->create([
        'first_name' => '山田',
        'last_name' => '太郎',
        'email' => 'yamada@example.com',
    ]);

    // 管理画面にアクセス
    $response = $this->get('/admin/contacts');

    // ステータス200
    $response->assertStatus(200);

    // 一覧にデータが表示されていること
    $response->assertSee('山田');
    $response->assertSee('太郎');
    $response->assertSee('yamada@example.com');
}
public function test_admin_contact_search_by_keyword()
{
    // 検索にヒットするデータ
    $hit = \App\Models\Contact::factory()->create([
        'first_name' => '佐藤',
        'last_name' => '花子',
        'email' => 'hanako@example.com',
    ]);

    // 検索にヒットしないデータ
    $miss = \App\Models\Contact::factory()->create([
        'first_name' => '鈴木',
        'last_name' => '一郎',
        'email' => 'ichiro@example.com',
    ]);

    // keyword=花 で検索
    $response = $this->get('/admin/contacts?keyword=花');

    $response->assertStatus(200);

    // ヒットするデータは表示される
    $response->assertSee('佐藤');
    $response->assertSee('花子');

    // ヒットしないデータは表示されない
    $response->assertDontSee('鈴木');
    $response->assertDontSee('一郎');
}

}
