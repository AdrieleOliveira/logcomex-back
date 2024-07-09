<?php

namespace App\Services;

use App\DTOs\PokemonDTO;
use App\Interfaces\repositories\PokemonRepositoryInterface;
use App\Interfaces\services\PokemonServiceInterface;
use function Webmozart\Assert\Tests\StaticAnalysis\lower;

class PokemonService implements PokemonServiceInterface
{
    protected PokemonRepositoryInterface $pokemonRepository;

    public function __construct(PokemonRepositoryInterface $pokemonRepository)
    {
        $this->pokemonRepository = $pokemonRepository;
    }

    public function getPokemon($param): PokemonDTO
    {
        $data = $this->pokemonRepository->getPokemon(strtolower($param));

        if(!$data || !isset($data['types'][0]['type']['name']) || !isset($data['sprites']['other']['official-artwork']['front_default'])) {
            throw new \Exception('Não foi possível buscar o Pokemon!');
        }

        return new PokemonDTO([
            'nome' => $data['name'],
            'peso' => $data['weight'],
            'altura' => $data['height'],
            'tipo' => $data['types'][0]['type']['name'],
            'url_imagem' => $data['sprites']['other']['official-artwork']['front_default']
        ]);
    }
}
