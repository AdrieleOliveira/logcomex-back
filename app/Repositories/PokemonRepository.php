<?php

namespace App\Repositories;

use App\Interfaces\repositories\PokemonRepositoryInterface;
use GuzzleHttp\Client;

class PokemonRepository implements PokemonRepositoryInterface
{
    protected Client $client;

    public function __construct(Client $client){
        $this->client = $client;
    }

    public function getPokemon($param): array
    {
        $url = "https://pokeapi.co/api/v2/pokemon/" . $param;

        try {
            $response = $this->client->get($url);
            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e){
            throw new \Exception('Erro ao realizar requisição!');
        }
    }
}
