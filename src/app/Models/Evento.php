<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table = 'tbl_eventos';
    protected $primaryKey = 'id_evento';

    public $timestamps = true;

    const CREATED_AT = 'criado_em_evento';
    const UPDATED_AT = 'atualizado_em_evento';

    protected $fillable = [
        'titulo_evento',
        'nome_evento',
        'descricao_evento',
        'foto_evento',
        'data_evento',
        'horario_evento',
        'endereco_evento',
        'tags_evento',
        'link_local_evento',
        'ordem_evento',
        'status_evento',
    ];

    protected $casts = [
        'data_evento' => 'date',
    ];

    public function getTagsArrayAttribute()
    {
        if (!$this->tags_evento) {
            return [];
        }

        return array_filter(array_map('trim', explode(',', $this->tags_evento)));
    }
}
