<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Atividade;
use Illuminate\Http\Request;

class AtividadeController extends Controller
{

    public function dashboard()
    {
        $atividades = Atividade::latest()
            ->take(5)
            ->get();

        return view('dashboard', compact('atividades'));
    }
    public function index(Request $request)
    {
        // Valida o formato do mês recebido
        $request->validate([
            'mes' => ['nullable', 'date_format:Y-m'],
        ]);

        // Se nenhum mês for informado, utiliza o mês atual
        $mes = $request->input('mes') ?: now()->format('Y-m');

        // Calcula o primeiro e o último dia do mês selecionado
        $inicioMes = Carbon::createFromFormat('Y-m-d', $mes . '-01');
        $fimMes = $inicioMes->copy()->endOfMonth();

        // Busca somente as atividades daquele mês
        $atividades = Atividade::whereBetween('data', [
            $inicioMes->toDateString(),
            $fimMes->toDateString()
        ])
            ->orderByDesc('data')
            ->orderByDesc('inicio')
            ->get();

        return view('atividades.index', compact('atividades', 'mes'));
    }

    public function create()
    {
        return view('atividades.create');
    }

    public function store(Request $request)
    {
        $dados = $this->validarDados($request);

        Atividade::create($dados);

        return redirect()
            ->route('atividades.index')
            ->with('sucesso', 'Atividade cadastrada com sucesso!');
    }

    public function edit(Atividade $atividade)
    {
        return view('atividades.edit', compact('atividade'));
    }

    public function update(Request $request, Atividade $atividade)
    {
        $dados = $this->validarDados($request);

        $atividade->update($dados);

        return redirect()
            ->route('atividades.index')
            ->with('sucesso', 'Atividade atualizada com sucesso!');
    }

    public function destroy(Atividade $atividade)
    {
        $atividade->delete();

        return redirect()
            ->route('atividades.index')
            ->with('sucesso', 'Atividade excluída com sucesso!');
    }

    private function validarDados(Request $request): array
    {
        return $request->validate([
            'data' => ['required', 'date'],
            'inicio' => ['required', 'date_format:H:i'],
            'fim' => ['required', 'date_format:H:i'],
            'usuario' => ['required', 'string', 'max:255'],
            'descricao' => ['required', 'string'],
            'solucao' => ['required', 'string'],
        ]);
    }
}
