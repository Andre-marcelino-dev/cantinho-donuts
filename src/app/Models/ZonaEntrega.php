<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZonaEntrega extends Model
{
    protected $table = 'tbl_zonas_entrega';
    protected $primaryKey = 'id_zona_entrega';

    // criado_em_zona_entrega e atualizado_em_zona_entrega são preenchidos pelo banco
    public $timestamps = false;

    protected $fillable = [
        'nome_zona_entrega',
        'apelido_zona_entrega',
        'km_min_zona_entrega',
        'km_max_zona_entrega',
        'taxa_zona_entrega',
        'prazo_zona_entrega',
        'cor_zona_entrega',
        'status_zona_entrega',
    ];

    protected $casts = [
        'km_min_zona_entrega' => 'float',
        'km_max_zona_entrega' => 'float',
        'taxa_zona_entrega'   => 'float',
    ];

    // Cores dos cards no site (a coluna guarda a chave)
    const CORES = [
        'rose'  => ['Rosa', '#b94e5c'],
        'gold'  => ['Dourado', '#b8893f'],
        'choco' => ['Chocolate', '#4a2a1d'],
        'mint'  => ['Verde', '#3f8f5a'],
        'blue'  => ['Azul', '#3d6a9e'],
    ];

    public function bairros()
    {
        return $this->hasMany(BairroEntrega::class, 'id_zona_entrega', 'id_zona_entrega')
            ->orderBy('nome_bairro_entrega');
    }

    // Zonas ativas da mais perto para a mais longe
    public static function ativas()
    {
        return self::with('bairros')
            ->where('status_zona_entrega', 'ATIVO')
            ->orderBy('km_min_zona_entrega')
            ->orderBy('km_max_zona_entrega')
            ->get();
    }

    public function corHex(): string
    {
        return self::CORES[$this->cor_zona_entrega][1] ?? self::CORES['rose'][1];
    }

    // "até 3 km" / "3 a 6 km"
    public function faixaKm(): string
    {
        $km = fn ($v) => rtrim(rtrim(number_format($v, 1, ',', ''), '0'), ',');

        return $this->km_min_zona_entrega > 0
            ? $km($this->km_min_zona_entrega) . ' a ' . $km($this->km_max_zona_entrega) . ' km'
            : 'até ' . $km($this->km_max_zona_entrega) . ' km';
    }

    public function taxaFormatada(): string
    {
        return $this->taxa_zona_entrega > 0
            ? 'R$ ' . number_format($this->taxa_zona_entrega, 2, ',', '.')
            : 'Grátis';
    }
}
