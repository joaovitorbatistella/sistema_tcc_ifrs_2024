<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use function Laravel\Prompts\alert;

class TurmasController extends Controller
{

    public User $aluno;

    public function __construct()
    {
        $this->aluno = new User();
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alunos = $this->aluno->all();
        return view('turma.cadastroturma');
    }

    function step1(Request $request)
    {
        /*array_push(
            $values, 
            $request->input('semestre'),
            $request->input('ano'),
            $request->input('coordenador')
    );*/

        return response()->json(['status' => 'success', 'next' => 'step2']);
    }

    function step2(Request $request)
    {
    

        return response()->json(['status' => 'success', 'next' => 'step3']);
    }

    function step3(Request $request)
    {
    

        return response()->json(['status' => 'success', 'next' => 'finished']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $turmas = $this->turma->all();
        return view('turma.create',['turmas' => $turmas]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'semestre' => 'required|integer',
            'ano' => 'required|integer',
            'coordenador' => 'required|integer',
            'alunos' => 'required|array',
            'atividades' => 'required|array',
            'atividades.*.nome' => 'required|string|max:255',
            'atividades.*.descricao' => 'required|string',
            'atividades.*.prazo' => 'required|date',
        ]);
    
        $turma = Turma::create([
            'semestre' => $validatedData['semestre'],
            'ano' => $validatedData['ano'],
            'coordenador_id' => $validatedData['coordenador'],
        ]);
    
        $turma->alunos()->sync($validatedData['alunos']);
    
        foreach ($validatedData['atividades'] as $atividadeData) {
            $atividade = new Atividade($atividadeData);
            $turma->atividades()->save($atividade);
        }
    
        return response()->json(['status' => 'success', 'redirect' => route('turma.index')]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $turma)
    {
        return view('turma.show',['turma' => $turma]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $turma)
    {
        return view('turma.edit',['turma' => $turma]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $updated = $this->turma->where('id', $id)->update($request->except(['_token', '_method']));

        if($updated){
            alert('Atualizado Com Sucesso');
            return redirect()->route('turmas-controller.index');
            
        }
        return redirect()->back()->with('message', 'Erro');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->turma->where('id', $id)->delete();
        return redirect()->route('turmas-controller.index');
    }
}
