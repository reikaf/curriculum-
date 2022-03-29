<?php

namespace Tests\Feature\Api;

use App\Models\Todo;
use App\Models\Update;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TodoControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp():void
    {
        parent::setUp();
    }

    /**
     * @test
     */
    public function Todoの新規作成()
    {
        $params = [
            'title' => 'テスト:タイトル',
            'content' => 'テスト:内容'
        ];

        $res = $this->postJson(route('api.todo.create'), $params);
        $res->assertOk();
        $todos = Todo::all();

        $this->assertCount(1, $todos);

        $todo = $todos->first();

        $this->assertEquals($params['title'], $todo->title);
        $this->assertEquals($params['content'], $todo->content);

    }

    /**
     * @test
     */
    public function Todoの更新()
    {
        $params = [
            'title' => 'テスト:タイトル',
            'content' => 'テスト:内容'
        ];

        $res = $this->postJson(route('api.update.create'), $params);
        $res->assertOk();
        $updates = Update::all();

        $this->assertCount(1, $updates);

        $update = $updates->first();

        $this->assertEquals($params['title'], $update->title);
        $this->assertEquals($params['content'], $update->content);

    }
}
