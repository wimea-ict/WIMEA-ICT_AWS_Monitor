<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateStationTest extends TestCase
{
    
    /**
     * A basic test example.
     *
     * @return void
     */
    /*public function testExample()
    {
        $this->assertTrue(true);
    }*/

    public function it_can_show_create_station(){
        $user = factory(User::class)->create();
        $this
            ->actingAs($user)
            ->get(route('dd'))
            ->assertStatus(200)
            ->assertSee('Title')
            ->assertSee('Link')
            ->assertSee('Link Text')
            ->assertSee('Image');
    }
}
