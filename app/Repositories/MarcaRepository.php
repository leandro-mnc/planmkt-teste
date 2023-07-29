<?php 

namespace App\Repositories;

use App\Models\Marca;

class MarcaRepository
{
    /**
     * @property int $id
     * 
     * @return Marca
     */
    public function get(int $id)
    {
        return Marca::find($id);
    }

    /**
     * @property string $codigo
     * 
     * @return Marca
     */
    public function getByCodigo(string $codigo)
    {
        return Marca::where('codigo', $codigo)->first();
    }

    /**
     * @property int $id
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getListaAtivos(): \Illuminate\Database\Eloquent\Collection
    {
        return Marca::where('status', 1)->orderBy('nome')->get();
    }
}
