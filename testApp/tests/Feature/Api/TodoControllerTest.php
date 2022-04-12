<?php

namespace Tests\Feature\Api;

use App\Models\Todo;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Database\Factories\TodoFactory;

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

        $todo->fill($params);
        $todo->save();

        $todo2 = Todo::find($todo->id);
        $this->assertEquals($params['title'], $todo2->title);
        $this->assertEquals($params['content'], $todo2->content);
    }

    /**
     * @test
     */
    public function Todoの更新失敗()
    {

        $todo = Todo::factory()->create();
        $data = [
            'title' => ['',str_repeat('a', 256)],
            'content' => ['',str_repeat('a', 256)]
            ];

        $response = $this->postjson(route('api.todo.update',[ 'todo' => $todo->id ]),$data);
        $response->assertStatus(405);
    }

    /**
     * @test
     */
    public function Todoの削除成功()
    {
        $todo = Todo::factory()->create();
        $response = $this->delete(route('api.todo.destroy',[ 'todo' => $todo->id ]));
        $response->assertStatus(200);
        $this->assertEmpty(Todo::find($todo->id));
    }

    /**
     * @test
     */
    public function Todoの削除失敗()
    {
        $response = $this->delete(route('api.todo.destroy', [ 'todo' => 999 ]));
        $response->assertStatus(404);
    }

    /**
     * @test
     */
    public function Todoの詳細取得()
    {
        $todo = Todo::factory()->create();
        $id = $todo->id;
        $response = $this->get("todo/{$id}/edit");
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function Todoの詳細取得の失敗()
    {
        $todo = Todo::factory()->create();
        $response = $this->get(route('api.todo.edit', [ 'todo' => 999 ]));
        $response->assertStatus(404);
    }
}
