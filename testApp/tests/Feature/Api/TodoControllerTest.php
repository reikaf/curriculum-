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

        $todo = Todo::create([
            'title' => 'テスト:タイトル',
            'content' => 'テスト:内容'
        ]);

        $this->assertEquals($params['title'], $todo->title);
        $this->assertEquals($params['content'], $todo->content);

        $todo->fill(['title' => 'テスト:タイトル']);
        $todo->save();

        $todo2 = Todo::find($todo->id);
        $this->assertEquals($params['title'], $todo2->title);
        $this->assertEquals($params['content'], $todo2->content);
    }
}
