<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use function Laravel\Prompts\alert;

class ProfessoresController extends Controller
{
    public readonly User $professor;

    public function __construct()
    {
        $this->professor = new User();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $professores = $this->professor->all();
        return view('professor.index',['professores' => $professores]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('professor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $created = $this->professor->create([
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
            alert('Criado Com Sucesso');
            return redirect()->route('professores-controller.index');
        }
        return redirect()->back()->with('message', 'Erro');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $professor)
    {
        return view('professor.show',['professor' => $professor]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $professor)
    {
        return view('professor.edit',['professor' => $professor]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $updated = $this->professor->where('id', $id)->update($request->except(['_token', '_method']));

        if($updated){
            alert('Atualizado Com Sucesso');
            return redirect()->route('professores-controller.index');
            
        }
        return redirect()->back()->with('message', 'Erro');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->professor->where('id', $id)->delete();
        return redirect()->route('professores-controller.index');
    }

    public function verificarRG(Request $request)
    {
        $rg = $request->input('rg');
        $existeRG = User::where('rg', $rg)->exists();
        return response()->json(['existe' => $existeRG]);
    }

    public function verificarCPF(Request $request)
    {
        $cpf = $request->input('cpf');
        $existeCPF = User::where('cpf', $cpf)->exists();
        return response()->json(['existe' => $existeCPF]);
    }

    public function verificarEmail(Request $request)
    {
        $email = $request->input('email');
        $existeEmail = User::where('email', $email)->exists();
        return response()->json(['existe' => $existeEmail]);
    }
}
