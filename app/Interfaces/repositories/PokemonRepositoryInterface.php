<?php

namespace App\Interfaces\repositories;

interface PokemonRepositoryInterface
{
    public function getPokemon($param): array;
}
