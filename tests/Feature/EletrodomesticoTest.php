<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Eletrodomestico;

class EletrodomesticoTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_lista_response(): void {
        $this->seed();
        
        // Salva na base de dados test para fazer o teste da listagem
        $this->insertData();

        $response = $this->call(
            'GET',
            '/api/eletrodomestico',
            [],
            [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]
        );
        
        $response->assertStatus(200);
        $response->assertJson(['data' => ['total' => 1]]);
    }

    public function test_insert_response(): void
    {
        $this->seed();
        
        $response = $this->call(
            'POST',
            '/api/eletrodomestico',
            [
                'nome' => 'Ferro de Passar',
                'descricao' => 'Ferro muito top',
                'tensao' => '110v',
                'status' => 'ativo',
                'marca' => 'electrolux'
            ],
            [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]
        );
        
        $response->assertStatus(201);
    }
    
    public function test_update_response(): void {
        $this->seed();

        // Salva na base de dados test para fazer o teste da atualização
        $entity = $this->insertData();

        // Data
        $data = [
            'nome' => 'Ferro de Passar Testado',
            'descricao' => 'Ferro muito top',
            'tensao' => '110v',
            'status' => 'ativo',
            'marca' => 'electrolux'
        ];
        
        // Request
        $response = $this->call(
            'PUT',
            '/api/eletrodomestico/' . $entity->id,
            $data,
            [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]
        );

        // Validation
        $response->assertStatus(200);
        $response->assertJson(['data' => ['nome' =>  $data['nome']]]);
    }
    
    public function test_delete_response(): void {
        $this->seed();
        
        // Salva na base de dados test para fazer o teste da remoção
        $entity = $this->insertData();

        $response = $this->call(
            'DELETE',
            '/api/eletrodomestico/' . $entity->id,
            [],
            [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]
        );

        $response->assertStatus(200);
    }

    private function insertData(): Eletrodomestico {
        // Salva na base de dados test para os testes
        $entity = new Eletrodomestico([
            'nome' => 'Ferro de Passar',
            'descricao' => 'Ferro muito top',
            'tensao' => '110v',
            'status' => 1,
            'marca_id' => 1
        ]);
        $entity->save();
        
        return $entity;
    }
}
