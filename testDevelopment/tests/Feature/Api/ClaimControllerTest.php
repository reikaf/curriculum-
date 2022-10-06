<?php

namespace Tests\Feature\Api;

use App\Models\Claim;
use App\Models\About;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Database\Factories\ClaimFactory;
use Database\Factories\UserFactory;

class ClaimControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp():void
    {
        parent::setUp();
    }

    /**
     * @test
     */
    public function Claimの新規作成()
    {
        $about = About::factory()->create();
        $params = [
            'billingName' => 'テスト:請求先名',
            'billingName_kana' => 'テスト:ふりがな',
            'address' => 'テスト:住所',
            'phoneNumber' => 'テスト:電話番号',
            'department' => 'テスト:部署',
            'name' => 'テスト:名前',
            'name_kana' => 'テスト:ふりがな',
        ];

        $response = $this->post(route('api.claim.create',$about->id), $params);
        $response->assertOk();
        $claims = Claim::all();

        $this->assertCount(1, $claims);
        $claim = $claims->first();
        $this->assertEquals($params['billingName'], $claim->billingName);
        $this->assertEquals($params['billingName_kana'], $claim->billingName_kana);
        $this->assertEquals($params['address'], $claim->address);
        $this->assertEquals($params['phoneNumber'], $claim->phoneNumber);
        $this->assertEquals($params['department'], $claim->department);
        $this->assertEquals($params['name'], $claim->name);
        $this->assertEquals($params['name_kana'], $claim->name_kana);
    }

    /**
     * @test
     */
    public function Claimの更新()
    {
        $claim = Claim::factory()->create();
        $data = [
            'billingName' => 'テスト:請求先名',
            'billingName_kana' => 'テスト:ふりがな',
            'address' => 'テスト:住所',
            'phoneNumber' => 'テスト:電話番号',
            'department' => 'テスト:部署',
            'name' => 'テスト:名前',
            'name_kana' => 'テスト:ふりがな',
        ];
        $response = $this->putJson(route('api.claim.update',[ 'id' => $claim->id ]),$data);
        $response->assertOk();
        $this->assertDatabaseHas('claims', $data);
    }

    /**
     * @test
     */
    public function Claimの更新失敗()
    {

        $claim = Claim::factory()->create();
        $data = [
            'billingName' => ['',str_repeat('a', 256)],
            'billingName_kana' => ['',str_repeat('a', 256)],
            'address' => ['',str_repeat('a', 256)],
            'phoneNumber' => ['',str_repeat('a', 256)],
            'department' => ['',str_repeat('a', 256)],
            'name' => ['',str_repeat('a', 256)],
            'name_kana' => ['',str_repeat('a', 256)]
            ];

        $response = $this->putJson(route('api.claim.update',[ 'id' => $claim->id ]),$data);
        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function Claimの削除成功()
    {
        $claim = Claim::factory()->create();
        $response = $this->deleteJson(route('api.claim.destroy',[ 'id' => $claim->id ]));
        $response->assertOk();
        $this->assertNull(Claim::find($claim->id));
    }

    /**
     * @test
     */
    public function Claimの削除失敗()
    {
        $claim = Claim::factory()->create();
        $response = $this->deleteJson(route('api.claim.destroy', [ 'id' => 999 ]));
        $response->assertStatus(404);
    }

    /**
     * @test
     */
    public function Claimの詳細取得()
    {
        $claim = Claim::factory()->create();
        $id = $claim->id;
        $response = $this->getJson(route('api.claim.show',[ 'id' => $id ]));
        $response->assertOk();
    }

    /**
     * @test
     */
    public function Claimの詳細取得の失敗()
    {
        $claim = Claim::factory()->create();
        $response = $this->getJson(route('api.claim.show', [ 'id' => 999 ]));
        $response->assertStatus(404);
    }
}
