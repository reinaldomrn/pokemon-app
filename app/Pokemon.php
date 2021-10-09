
<?php

    class Pokemon {

        public $namePokemon;
        private $pathPokemonApi;

        public function __construct($pokemon = "", $pathPokemonApi = "https://pokeapi.co/api/v2/pokemon")
        {
            $this->namePokemon = $pokemon;
            $this->pathPokemonApi = $pathPokemonApi;
        }

        public function searchPokemonByName(){
            return $this->callApiPokemon("{$this->pathPokemonApi}/{$this->namePokemon}");
        }

        public function searchPokemonByRoute($route)
        {
            return $this->callApiPokemon($route);
        }

        public function getAllPokemons($route = "")
        {
            return $this->callApiPokemon(empty($route) ? $this->pathPokemonApi : $route);
        }

        public function callApiPokemon($route){
            $api = curl_init($route);
            curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($api);
            curl_close($api);
            return json_decode($response);
        }

    }