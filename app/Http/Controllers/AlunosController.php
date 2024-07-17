<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserGroup;

use function Laravel\Prompts\alert;
use function Laravel\Prompts\info;

class AlunosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alunos = User::students();
        return view('aluno.index',['alunos' => $alunos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('aluno.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $created = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'course' => $request->input('course'),
            'rg' => $request->input('rg'),
            'cpf' => $request->input('cpf'),
            'gender' => $request->input('gender'),
            'birthday' => $request->input('birthday'),
            'nationality' => $request->input('nationality'),
            'special_need' => $request->input('special_need'),
            'martial_status' => $request->input('martial_status'),
            'family_income' => $request->input('family_income'),
            'family_number' => $request->input('family_number'),
            'password' => $request->input('password'),
        ]);

        if($created){
            UserGroup::create([
                'user_id'  => $created->id,
                'group_id' => 4
            ]);

            alert('Criado Com Sucesso');
            return redirect()->route('alunos-controller.index');
        }
        return redirect()->back()->with('message', 'Erro');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $aluno)
    {
        return view('aluno.show',['aluno' => $aluno]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $aluno)
    {
        return view('aluno.edit',['aluno' => $aluno]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $updated = User::where('id', $id)->update($request->except(['_token', '_method']));

        if($updated){
            alert('Atualizado Com Sucesso');
            return redirect()->route('alunos-controller.index');
            
        }
        return redirect()->back()->with('message', 'Erro');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::where('id', $id)->delete();
        return redirect()->route('alunos-controller.index');
    }

    public function verificarRG(Request $request)
    {
        $id = $request->input('id');
        $rg = $request->input('rg');
        $existeRG = User::where('rg', $rg)
                        ->where('id', '!=', $id)
                        ->exists();
        return response()->json(['existe' => $existeRG]);
    }

    public function verificarCPF(Request $request)
    {
        $id = $request->input('id');
        $cpf = $request->input('cpf');
        $existeCPF = User::where('cpf', $cpf)
                        ->where('id', '!=', $id)
                        ->exists();
        return response()->json(['existe' => $existeCPF]);
    }

    public function verificarEmail(Request $request)
    {
        $id = $request->input('id');
        $email = $request->input('email');
        $existeEmail = User::where('email', $email)
                        ->where('id', '!=', $id)
                        ->exists();
        return response()->json(['existe' => $existeEmail]);
    }
}
