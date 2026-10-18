<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Entradas e saídas de matéria-prima (tbl_controle_materia_prima)
class MovimentacaoEstoque extends Model
{
    protected $table = 'tbl_controle_materia_prima';
    protected $primaryKey = 'id_controle';

    public $timestamps = false;

    protected $fillable = [
        'id_materia_prima',
        'tipo_controle', // ENTRADA ou SAIDA
        'qtde_controle',
        'data_controle',
        'obs_controle',
    ];

    public function materiaPrima()
    {
        return $this->belongsTo(MateriaPrima::class, 'id_materia_prima', 'id_materia_prima');
    }

    // Registra uma entrada ou saída e atualiza a quantidade da matéria-prima.
    // A matéria-prima fica travada durante a operação, e a saída não pode deixar o estoque negativo.
    public static function registrar(int $idMateriaPrima, string $tipo, float $quantidade, ?string $observacao = null): self
    {
        return \Illuminate\Support\Facades\DB::transaction(function () use ($idMateriaPrima, $tipo, $quantidade, $observacao) {
            $materia = MateriaPrima::whereKey($idMateriaPrima)->lockForUpdate()->firstOrFail();
            $atual = (float) $materia->qtde_atual_materia_prima;
            $nova = $tipo === 'ENTRADA' ? $atual + $quantidade : $atual - $quantidade;

            if ($nova < -0.0005) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'qtde_controle' => sprintf(
                        'Estoque insuficiente: há %s %s de %s.',
                        rtrim(rtrim(number_format($atual, 3, ',', '.'), '0'), ','),
                        $materia->unid_med_materia_prima,
                        $materia->nome_materia_prima
                    ),
                ]);
            }

            $materia->qtde_atual_materia_prima = round(max($nova, 0), 3);
            $materia->save();

            return self::create([
                'id_materia_prima' => $materia->id_materia_prima,
                'tipo_controle'    => $tipo,
                'qtde_controle'    => round($quantidade, 3),
                'data_controle'    => now('America/Sao_Paulo')->format('Y-m-d H:i:s'),
                'obs_controle'     => $observacao ?: null,
            ]);
        });
    }
}
