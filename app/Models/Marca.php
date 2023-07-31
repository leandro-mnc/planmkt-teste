<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $nome
 * @property string $codigo
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class Marca extends Model
{
    use HasFactory;

    public $table = 'marca';

    public function eletrodomesticos(): HasMany
    {
        return $this->hasMany(Eletrodomestico::class, 'id', 'marca_id');
    }
}
