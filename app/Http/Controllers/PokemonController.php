<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Pokemon;

class PokemonController extends Controller
{
    public function pokemons(){
        $pokemon = new Pokemon();
        $allPokemon = $pokemon->getAllPokemons();
        return view('index', ["data" => $this->getDetailsPokemons($allPokemon, $pokemon)]);
    }

    public function getPagePokemons(Request $request){
        $pokemon = new Pokemon();
        $allPokemon = $pokemon->getAllPokemons($request->get("route"));
        return $this->getDetailsPokemons($allPokemon, $pokemon);
    }

     public function getPokemonByName(Request $request){
        $pokemon = new Pokemon($request->get("name"));
        $detailsPokemon = $pokemon->searchPokemonByName();
        return empty($detailsPokemon) ? [] : $this->parseData($detailsPokemon);
    }

    public function getDetailsPokemons($allPokemon, $pokemon){
        $result = ["next" => $allPokemon->next, "previous" => $allPokemon->previous, "pokemones" => []];
        foreach ($allPokemon->results as $value) {
            $details = $pokemon->searchPokemonByRoute($value->url);
            array_push($result["pokemones"], $this->parseData($details));
        }
        return $result;
    }

    public function parseData($details){
        return [
            "name" => $details->name,
            "image" => $details->sprites->front_default,
            "hp" => $details->stats[0]->base_stat,
            "experience" => $details->base_experience,
            "attack" => $details->stats[1]->base_stat,
        ];
    }


}
