<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Pokemon;
use Tests\TestCase;

class PokemonClassTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAllPokemons()
    {
        $pokemons = new Pokemon();
        $response = $pokemons->getAllPokemons();
        $this->assertObjectHasAttribute("results", $response);
    }

    public function testPaginate()
    {
        $pokemons = new Pokemon();
        $response = $pokemons->getAllPokemons("https://pokeapi.co/api/v2/pokemon?offset=20&limit=20");
        $this->assertObjectHasAttribute("results", $response);
    }

    public function testDetailsPokemon()
    {
        $pokemons = new Pokemon();
        $response = $pokemons->searchPokemonByRoute("https://pokeapi.co/api/v2/pokemon/1/");
        $this->assertObjectHasAttribute("name", $response);
    }

    public function testSearchPokemon()
    {
        $pokemons = new Pokemon("pikachu");
        $response = $pokemons->searchPokemonByName();
        $this->assertObjectHasAttribute("name", $response);
    }

    public function testSearchPokemonNotFound()
    {
        $pokemons = new Pokemon("pepito");
        $response = $pokemons->searchPokemonByName();
        $this->assertNull($response);
    }


}
