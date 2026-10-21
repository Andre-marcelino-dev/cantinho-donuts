<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BairroEntrega extends Model
{
    protected $table = 'tbl_bairros_entrega';
    protected $primaryKey = 'id_bairro_entrega';

    public $timestamps = false;

    protected $fillable = [
        'id_zona_entrega',
        'nome_bairro_entrega',
        'cep_inicio_bairro_entrega', // só números (8 dígitos)
        'cep_fim_bairro_entrega',
    ];

    public function zona()
    {
        return $this->belongsTo(ZonaEntrega::class, 'id_zona_entrega', 'id_zona_entrega');
    }

    // "08160-000 a 08169-999" (vazio se não tiver faixa)
    public function faixaCep(): string
    {
        if (!$this->cep_inicio_bairro_entrega) return '';

        $fmt = fn ($c) => substr($c, 0, 5) . '-' . substr($c, 5);

        return $fmt($this->cep_inicio_bairro_entrega) . ' a ' . $fmt($this->cep_fim_bairro_entrega ?: $this->cep_inicio_bairro_entrega);
    }
}
