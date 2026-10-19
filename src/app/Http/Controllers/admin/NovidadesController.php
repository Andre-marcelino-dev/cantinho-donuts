<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Cliente;

// Clientes que marcaram "Receber novidades e promoções" no app
class NovidadesController extends Controller
{
    public function index()
    {
        $clientes = $this->clientesQueAceitaram();

        // Lista de e-mails pronta para colar no campo "Cco" de um e-mail
        $emails = $clientes->pluck('email_cliente')->filter()->unique()->implode(', ');

        return view('admin.novidades.index', compact('clientes', 'emails'));
    }

    // Planilha (CSV) que abre no Excel
    public function exportar()
    {
        $clientes = $this->clientesQueAceitaram();

        return response()->streamDownload(function () use ($clientes) {
            $arquivo = fopen('php://output', 'w');
            fwrite($arquivo, "\xEF\xBB\xBF"); // acentos certos no Excel
            fputcsv($arquivo, ['Nome', 'E-mail', 'Telefone', 'Cliente desde'], ';');
            foreach ($clientes as $cliente) {
                fputcsv($arquivo, [
                    $cliente->nome_cliente,
                    $cliente->email_cliente,
                    $cliente->telefone_cliente,
                    $cliente->criado_em_cliente ? $cliente->criado_em_cliente->format('d/m/Y') : '',
                ], ';');
            }
            fclose($arquivo);
        }, 'clientes-novidades-' . now('America/Sao_Paulo')->format('Y-m-d') . '.csv', [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    private function clientesQueAceitaram()
    {
        return Cliente::where('novidades_cliente', 'SIM')
            ->where('status_cliente', 'ATIVO')
            ->orderBy('nome_cliente')
            ->get();
    }
}
