<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;
use App\Http\Requests\createRequest;

class CustomRequestErrorTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     * @dataProvider dataproviderExample
     */
    public function testError(array $data, bool $expect)
    {
        $request = new createRequest();
        $rules = $request->rules();
        $validator = Validator::make($data, $rules);
        $result = $validator->passes();
        $this->assertEquals($expect, $result);
    }

    public function dataproviderExample()
    {
        return [
            '正常' => [
                [
                    'title' => 'タイトル',
                    'content' => '内容'
                ],
                true
            ],
            '必須項目エラー' => [
                [
                    'title' => '',
                    'content' => ''
                ],
                false
            ],
            '最大文字数エラー' => [
                [
                    'title' => str_repeat('a', 256),
                    'content' => str_repeat('a', 256)
                ],
                false
            ],
        ];
    }
}
