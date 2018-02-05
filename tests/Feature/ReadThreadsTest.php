<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReadThreadsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(){
        parent::setUp();

        $this->thread = factory('App\Thread')->create();
    }

    /** @test */
    public function a_user_can_view_all_threads()
    {
        $response = $this->get('/threads');
        $response->assertSee($this->thread->title);
        //$response->assertStatus(200);
    }

    /** @test */
    public function a_user_can_read_a_single_thread()
    {
        $response = $this->get('/threads/'.$this->thread->id);
        $response->assertSee($this->thread->title);
    }

    /** @test */
    public function a_user_can_read_read_replies_that_are_associated_with_a_thread()
    {
        $reply = factory('App\Reply')->create(['thread_id' => $this->thread->id]);

        $this->get('/threads/'.$this->thread->id)->assertSee($reply->body);
    }

}
