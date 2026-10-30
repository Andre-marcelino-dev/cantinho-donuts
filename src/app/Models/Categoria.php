<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Produto;

class Categoria extends Model
{
    protected $table = 'tbl_categorias';
    protected $primaryKey = 'id_categoria';


    public $timestamps = true;

    const CREATED_AT = 'criado_em_categoria';
    const UPDATED_AT = 'atualizado_em_categoria';

    protected $fillable = [
        'nome_categoria',
        'descricao_categoria',
        'foto_categoria',
        'status_categoria',
        'ordem_categoria'
    ];

    // Imagem do card na Home: a enviada no painel, senão o cupcake
    // antigo daquela categoria (cup-cak{id}.svg), senão o cupcake padrão
    public function urlFoto(): string
    {
        $foto = $this->foto_categoria;
        if ($foto && is_file(public_path('davilla/images/categoria/' . $foto))) {
            return asset('davilla/images/categoria/' . $foto);
        }

        $antiga = 'davilla/IMG/cup-cak' . $this->id_categoria . '.svg';
        if (is_file(public_path($antiga))) {
            return asset($antiga);
        }

        return asset('davilla/IMG/cup-cak1.svg');
    }

    public function ProdutosCategoria(){
        return $this->hasMany(Produto::class, 'id_categoria', 'id_categoria');
    }


}

