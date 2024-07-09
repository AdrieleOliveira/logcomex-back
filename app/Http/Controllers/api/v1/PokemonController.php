<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Interfaces\services\PokemonServiceInterface;
use App\Traits\HttpResponse;
use Illuminate\Http\JsonResponse;

class PokemonController extends Controller
{
    use HttpResponse;

    protected PokemonServiceInterface $pokemonService;

    public function __construct(PokemonServiceInterface $pokemonService)
    {
        $this->pokemonService = $pokemonService;
    }

    public function getPokemons($param): JsonResponse
    {
        if(!is_string($param) && !is_int($param)) {
            return $this->error('Error', 422, ['O parâmetro deve ser do tipo int ou string.']);
        }

        try {
            $pokemonDTO = $this->pokemonService->getPokemon($param);

            return $this->response('OK', 200, $pokemonDTO->toArray());
        } catch (\Exception $e) {
            return $this->error('Error', 422, [$e->getMessage()]);
        }
    }
}
