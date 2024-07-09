<?php

namespace App\DTOs;

class PokemonDTO
{
    public string $nome;
    public float $peso;
    public float $altura;
    public string $tipo;
    public string $url_imagem;

    public function __construct(array $data)
    {
        $this->nome = $data['nome'];
        $this->peso = round($data['peso'] * 0.1, 2);
        $this->altura = round($data['altura'] * 10, 2);
        $this->tipo = $data['tipo'];
        $this->url_imagem = $data['url_imagem'];
    }

    public function toArray(): array
    {
        return [
            'nome' => $this->nome,
            'tipo' => $this->tipo,
            'altura' => $this->altura,
            'peso' => $this->peso,
            'url_imagem' => $this->url_imagem
        ];
    }
}
