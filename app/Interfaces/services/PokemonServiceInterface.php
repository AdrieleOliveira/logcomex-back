<?php

namespace App\Interfaces\services;

use App\DTOs\PokemonDTO;

interface PokemonServiceInterface
{
    public function getPokemon($param): PokemonDTO;
}
