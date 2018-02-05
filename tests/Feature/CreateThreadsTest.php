<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateThreadsTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function guests_may_not_create_threads()
    {

        $this->expectException('Illuminate\Auth\AuthenticationException');

        $thread = make('App\Thread');
        $this->post('/threads', $thread->toArray());
    }
    /** @test */
    public function an_authenticated_user_can_create_new_forum_threads()
    {
        //Given we have a signed in user
        $this->signIn();
        $thread = make('App\Thread'); //Returns an array

        $this->post('/threads', $thread->toArray());
        //Then when we visit the thread page
        $this->get($thread->path())->assertSee($thread->title)->assertSee($thread->body);
    }
}
