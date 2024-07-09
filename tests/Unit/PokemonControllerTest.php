<?php

namespace Tests\Unit;

use App\DTOs\PokemonDTO;
use App\Http\Controllers\api\v1\PokemonController;
use App\Interfaces\services\PokemonServiceInterface;
use Illuminate\Http\JsonResponse;
use Tests\TestCase;
use Mockery;

class PokemonControllerTest extends TestCase
{
    public function testGetPokemons()
    {
        $service = Mockery::mock(PokemonServiceInterface::class);
        $service->shouldReceive('getPokemon')
            ->once()
            ->with('pikachu')
            ->andReturn(new PokemonDTO([
                'nome' => 'pikachu',
                'peso' => 60,
                'altura' => 4,
                'tipo' => 'electric',
                'url_imagem' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/25.png'
            ]));

        $controller = new PokemonController($service);
        $response = $controller->getPokemons('pikachu');

        $this->assertInstanceOf(JsonResponse::class, $response);
        $data = $response->getData(true);
        $data = $data['data'];

        $this->assertEquals('pikachu', $data['nome']);
        $this->assertEquals(6, $data['peso']);
        $this->assertEquals(40, $data['altura']);
        $this->assertEquals('electric', $data['tipo']);
        $this->assertEquals('https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/25.png', $data['url_imagem']);
    }

    public function testGetPokemonsInvalidParameter()
    {
        $controller = new PokemonController(Mockery::mock(PokemonServiceInterface::class));
        $response = $controller->getPokemons(12.0);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $data = $response->getData(true);
        $data = $data['errors'][0];

        $this->assertEquals('O parâmetro deve ser do tipo int ou string.', $data);
    }
}
