<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PokemonControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testPageIndex()
    {
        $this->get("/")
        ->assertSee("Bulbasaur");
    }

    public function testGetPokemonByName()
    {
        $response = $this->get("/getPokemonByName?name=pikachu");
        $this->assertArrayHasKey("name", $response);
    }

}
