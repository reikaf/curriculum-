<?php

namespace Tests\Feature\Api;

use App\Models\About;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Database\Factories\AboutFactory;
use Database\Factories\UserFactory;

class AboutControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp():void
    {
        parent::setUp();
    }

    /**
     * @test
     */
    public function Aboutの新規作成()
    {
        $params = [
            'companyName' => 'テスト:会社名',
            'companyName_kana' => 'テスト:ふりがな',
            'address' => 'テスト:住所',
            'phoneNumber' => 'テスト:電話番号',
            'name' => 'テスト:名前',
            'name_kana' => 'テスト:ふりがな'
        ];

        $response = $this->post(route('api.about.create'), $params);
        $response->assertOk();
        $abouts = About::all();

        $this->assertCount(1, $abouts);

        $about = $abouts->first();

        $this->assertEquals($params['companyName'], $about->companyName);
        $this->assertEquals($params['companyName_kana'], $about->companyName_kana);
        $this->assertEquals($params['address'], $about->address);
        $this->assertEquals($params['phoneNumber'], $about->phoneNumber);
        $this->assertEquals($params['name'], $about->name);
        $this->assertEquals($params['name_kana'], $about->name_kana);
    }

    /**
     * @test
     */
    public function Aboutの更新()
    {
        $about = About::factory()->create();
        $data = [
            'companyName' => 'テスト:会社名',
            'companyName_kana' => 'テスト:ふりがな',
            'address' => 'テスト:住所',
            'phoneNumber' => 'テスト:電話番号',
            'name' => 'テスト:名前',
            'name_kana' => 'テスト:ふりがな'
        ];
        $response = $this->putJson(route('api.about.update',[ 'id' => $about->id ]),$data);
        $response->assertOk();
        $this->assertDatabaseHas('abouts', $data);
    }

    /**
     * @test
     */
    public function Aboutの更新失敗()
    {

        $about = About::factory()->create();
        $data = [
            'companyName' => ['',str_repeat('a', 256)],
            'companyName_kana' => ['',str_repeat('a', 256)],
            'address' => ['',str_repeat('a', 256)],
            'phoneNumber' => ['',str_repeat('a', 256)],
            'name' => ['',str_repeat('a', 256)],
            'name_kana' => ['',str_repeat('a', 256)],
            ];

        $response = $this->putJson(route('api.about.update',[ 'id' => $about->id ]),$data);
        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function Aboutの削除成功()
    {
        $about = About::factory()->create();
        $response = $this->deleteJson(route('api.about.destroy',[ 'id' => $about->id ]));
        $response->assertOk();
        $this->assertNull(About::find($about->id));
    }

    /**
     * @test
     */
    public function Aboutの削除失敗()
    {
        $about = About::factory()->create();
        $response = $this->deleteJson(route('api.about.destroy', [ 'id' => 999 ]));
        $response->assertStatus(404);
    }

    /**
     * @test
     */
    public function Aboutの詳細取得()
    {
        $about = About::factory()->create();
        $id = $about->id;
        $response = $this->getJson(route('api.about.show',[ 'id' => $about->id ]));
        $response->assertOk();
    }

    /**
     * @test
     */
    public function Aboutの詳細取得の失敗()
    {
        $about = About::factory()->create();
        $response = $this->getJson(route('api.about.show', [ 'id' => 999 ]));
        $response->assertStatus(404);
    }
}
