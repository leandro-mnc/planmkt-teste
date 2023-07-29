<?php

namespace App\Repositories;

use App\Models\Eletrodomestico;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class EletrodomesticoRepository
{
    /**
     * @property int $id
     * 
     * @return Eletrodomestico | null
     */
    public function get(int $id): Eletrodomestico | null
    {
        return Eletrodomestico::find($id);
    }

    /**
     * @property Request $request
     * 
     * @return LengthAwarePaginator
     */
    public function lista(Request $request): LengthAwarePaginator
    {
        $totalPorPagina = $request->has('total_por_pagina') ? $request->get('total_por_pagina') : 10;

        return Eletrodomestico::paginate($totalPorPagina);
    }

    /**
     * @property array $data
     * 
     * @return Eletrodomestico | null
     */
    public function insere(array $data): Eletrodomestico | null
    {
        $model = new Eletrodomestico($data);
        if ($model->save() === true) {
            return $model;
        }
        return null;
    }

    /**
     * @property array $data
     * 
     * @return Eletrodomestico | null
     */
    public function atualiza(array $data, int $id): Eletrodomestico | null
    {
        $model = $this->get($id);
        
        if ($model === null) {
            return null;
        }

        $model->fill($data);

        if ($model->save() === true) {
            return $model;
        }
        return null;
    }

    /**
     * @property int $id
     * 
     * @return int
     */
    public function delete(int $id): int
    {
        $entity = $this->get($id);

        if ($entity === null) {
            return 0;
        }

        return $entity->delete();
    }
}
