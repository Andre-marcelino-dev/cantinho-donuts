<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Configurações da loja no formato chave → valor (tbl_configuracoes)
class Configuracao extends Model
{
    protected $table = 'tbl_configuracoes';
    protected $primaryKey = 'id_configuracao';

    // atualizado_em_configuracao é preenchido pelo banco
    public $timestamps = false;

    protected $fillable = [
        'chave_configuracao',
        'valor_configuracao',
    ];

    // Valores usados se a chave ainda não existir no banco
    const PADROES = [
        'taxa_entrega'     => '6.00',
        'previsao_entrega' => '45 - 60 min',
    ];

    public static function valor(string $chave): string
    {
        return self::where('chave_configuracao', $chave)->value('valor_configuracao')
            ?? self::PADROES[$chave] ?? '';
    }

    public static function definir(string $chave, string $valor): void
    {
        self::updateOrCreate(['chave_configuracao' => $chave], ['valor_configuracao' => $valor]);
    }

    public static function taxaEntrega(): float
    {
        return round((float) self::valor('taxa_entrega'), 2);
    }

    public static function previsaoEntrega(): string
    {
        return self::valor('previsao_entrega');
    }
}
