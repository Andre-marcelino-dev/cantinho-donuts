<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cupom extends Model
{
    protected $table = 'tbl_cupons';
    protected $primaryKey = 'id_cupom';

    // criado_em_cupom e atualizado_em_cupom são preenchidos pelo banco
    public $timestamps = false;

    protected $fillable = [
        'codigo_cupom',
        'valor_desconto_cupom', // porcentagem: 10 = 10% de desconto
        'data_inicio_cupom',
        'data_fim_cupom',
        'status_cupom',
    ];

    // Busca um cupom pelo código que pode ser usado hoje (ativo e dentro da validade)
    public static function validoHoje(?string $codigo): ?self
    {
        if (!$codigo) return null;

        $hoje = now('America/Sao_Paulo')->toDateString();

        return self::where('codigo_cupom', strtoupper(trim($codigo)))
            ->where('status_cupom', 'ATIVO')
            ->whereDate('data_inicio_cupom', '<=', $hoje)
            ->whereDate('data_fim_cupom', '>=', $hoje)
            ->first();
    }

    // Desconto em reais sobre um valor (só os produtos, sem a entrega)
    public function descontoSobre(float $valor): float
    {
        return round($valor * $this->valor_desconto_cupom / 100, 2);
    }
}
