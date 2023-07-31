<?php

namespace Tests\Unit\Repositories;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;
use App\Repositories\EletrodomesticoRepository;
use App\Models\Eletrodomestico;

class EletrodomesticoTest extends TestCase
{
    Use RefreshDatabase;
    
    public function test_get_eletrodomestico() {
        $this->seed();
        
        $this->insertData();
        
        $repository = new EletrodomesticoRepository();
        
        $data = $repository->get(1);

        $this->assertTrue($data instanceOf Eletrodomestico);
    }
    
    public function test_lista_eletrodomestico() {
        $this->seed();

        $this->insertData();

        $repository = new EletrodomesticoRepository();

        $data = $repository->lista(new Request());

        $this->assertTrue($data->count() > 0);
    }

    public function test_insere_eletrodomestico() {
        $this->seed();

        $repository = new EletrodomesticoRepository();

        $data = $repository->insere([
            'nome' => 'Ferro de Passar',
            'descricao' => 'Ferro muito top',
            'tensao' => '110v',
            'status' => 1,
            'marca_id' => 1
        ]);

        $this->assertTrue($data instanceOf Eletrodomestico);
    }
    
    public function test_atualiza_eletrodomestico() {
        $this->seed();
        
        $data = $this->insertData();

        $repository = new EletrodomesticoRepository();

        $newData = $repository->atualiza([
            'nome' => 'Ferro de Passar muito Top',
            'descricao' => 'Ferro muito top',
            'tensao' => '110v',
            'status' => 1,
            'marca_id' => 1
        ], $data->id);

        $this->assertEquals('Ferro de Passar muito Top', $newData->nome);
    }
    
    public function test_delete_eletrodomestico() {
        $this->seed();

        $data = $this->insertData();

        $repository = new EletrodomesticoRepository();

        $deleted = $repository->delete($data->id);

        $this->assertTrue($deleted == 1);
    }

    private function insertData(): Eletrodomestico {
        // Salva na base de dados test para os testes
        $entity = new Eletrodomestico([
            'id' => 1,
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

