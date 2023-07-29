<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $nome
 * @property string $descricao
 * @property string $tensao
 * @property int $marca_id
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property Marca $marca
 */
class Eletrodomestico extends Model
{
    use HasFactory;

    public $table = 'eletrodomestico';

    public $fillable = [
        'nome',
        'descricao',
        'tensao',
        'status',
        'marca_id',
    ];

    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn (int $value) => ($value === 1 ? 'Ativo' : 'Inativo'),
        );
    }

    public function marca(): BelongsTo
    {
        return $this->belongsTo(Marca::class, 'marca_id', 'id');
    }
}
