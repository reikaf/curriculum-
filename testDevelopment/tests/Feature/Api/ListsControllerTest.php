<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ListsControllerTest extends TestCase
{

    use DatabaseTransactions;

    public function setUp():void
    {
        parent::setUp();
    }

    /**
     * @test
     *
     */
    public function index表示成功()
    {
        $response = $this->getJson(route('api.list.index'));
        $response->assertOk();
    }
}
