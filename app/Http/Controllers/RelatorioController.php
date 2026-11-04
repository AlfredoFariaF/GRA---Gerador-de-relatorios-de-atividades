
<?php

namespace App\Http\Controllers;

use App\Models\Atividade;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

class RelatorioController extends Controller
{
    public function index()
    {
        return view('relatorios.index', [
            'mes' => now()->format('Y-m')
        ]);
    }

    public function gerar(Request $request)
    {
        $dados = $request->validate([
            'mes' => ['required', 'date_format:Y-m'],
        ]);

        $mes = Carbon::createFromFormat('Y-m', $dados['mes']);

        $atividades = Atividade::whereYear('data', $mes->year)
            ->whereMonth('data', $mes->month)
            ->orderBy('data')
            ->orderBy('inicio')
            ->get();

        if ($atividades->isEmpty()) {
            return back()
                ->withInput()
                ->withErrors([
                    'mes' => 'Não existem atividades cadastradas para esse mês.'
                ]);
        }

        $documento = new PhpWord();

        $documento->setDefaultFontName('Arial');
        $documento->setDefaultFontSize(12);

        $secao = $documento->addSection([
            'marginTop' => 700,
            'marginBottom' => 1000,
            'marginLeft' => 850,
            'marginRight' => 850,
        ]);

        // Cabeçalho e título
        $titulo = 'Relatório das Atividades Desenvolvidas em '
            . $mes->locale('pt_BR')->translatedFormat('F')
            . ' de ' . $mes->year;

        $secao->addText(
            $titulo,
            [
                'name' => 'Times New Roman',
                'size' => 15,
                'bold' => true,
            ],
            ['alignment' => 'center', 'spaceAfter' => 300]
        );

        // Criação dos blocos de atividades
        foreach ($atividades as $indice => $atividade) {

            $tabela = $secao->addTable([
                'borderSize' => 6,
                'borderColor' => '000000',
                'cellMargin' => 80,
                'width' => 100 * 50,
            ]);

            $inicio = $atividade->getRawOriginal('inicio');
            $fim = $atividade->getRawOriginal('fim');

            $data = Carbon::parse($atividade->data)
                ->format('d/m/Y');

            // Primeira linha
            $tabela->addRow();

            $tabela->addCell(500)->addText(
                (string) ($indice + 1),
                ['bold' => true]
            );

            $tabela->addCell(1500)->addText('Data', ['bold' => true]);
            $tabela->addCell(3500)->addText($data, ['bold' => true]);
            $tabela->addCell(1500)->addText('Início:', ['bold' => true]);
            $tabela->addCell(3500)->addText(
                substr($inicio, 0, 5),
                ['bold' => true]
            );

            // Usuário requerente
            $tabela->addRow();
            $tabela->addCell(10500, ['gridSpan' => 5])
                ->addText([
                    ['text' => 'Usuário Requerente: ', 'bold' => true],
                    ['text' => $atividade->usuario],
                ]);

            // Descrição
            $tabela->addRow();
            $tabela->addCell(10500, ['gridSpan' => 5])
                ->addText([
                    ['text' => 'Descrição do Problema: ', 'bold' => true],
                    ['text' => $atividade->descricao],
                ]);

            // Solução
            $tabela->addRow();
            $tabela->addCell(10500, ['gridSpan' => 5])
                ->addText([
                    ['text' => 'Solução Apresentada: ', 'bold' => true],
                    ['text' => $atividade->solucao],
                ]);

            // Data e duração/horário
            $tabela->addRow();
            $tabela->addCell(10500, ['gridSpan' => 5])
                ->addText([
                    ['text' => 'Data/Hora: ', 'bold' => true],
                    ['text' => $data . ' | ' . substr($inicio, 0, 5)],
                    ['text' => '     Duração/Horário: ', 'bold' => true],
                    ['text' => substr($inicio, 0, 5) . '~' . substr($fim, 0, 5)],
                ]);

            $secao->addTextBreak(1);
        }

        // Rodapé
        $rodape = $secao->addFooter();

        $rodape->addText(
            now()->format('d/m/Y') . '                                      Alfredo Faria Ferreira',
            ['size' => 10],
            ['alignment' => 'center']
        );

        $rodape->addText(
            '- Suporte Técnico em Informática -',
            ['size' => 10],
            ['alignment' => 'center']
        );

        // Geração do arquivo
        $nomeArquivo = 'Relatorio_Atividades_'
            . $mes->format('m_Y') . '.docx';

        $caminho = storage_path('app/' . $nomeArquivo);

        $writer = IOFactory::createWriter($documento, 'Word2007');
        $writer->save($caminho);

        return response()->download($caminho)->deleteFileAfterSend(true);
    }
}
