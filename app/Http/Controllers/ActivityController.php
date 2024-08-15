<?php

namespace App\Http\Controllers;

use App\Models\UserClassActivityStep;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\UserClassActivity;

class ActivityController extends Controller
{
    public function index($class_id=null)
    {
        $user =  auth()->user();
        $user_id = $user->id; // Obtendo o ID do usuário autenticado
        $group = $user->group()->first();

        $activities = UserClassActivity::userActivity($user_id, $class_id);
    
        // Separar as atividades em andamento, futuras e históricas
        $ongoingActivities = $activities->where('delivered_at', null)->where('due_at', '>=', now())->get();
        $futureActivities = $activities->where('delivered_at', null)->where('due_at', '>', now())->get();
        $historicalActivities = $activities->whereNotNull('delivered_at')->get();
    
        return view('turma.overviewturma', [
            'ongoingActivities' => $ongoingActivities,
            'futureActivities' => $futureActivities,
            'historicalActivities' => $historicalActivities,
            'group' => $group
        ]);
    }
    
    public function show($id)
    {
        $activity = UserClassActivity::findOrFail($id);
        $actualStep = UserClassActivityStep::getMinStepId($id);
    
        return view('turma.activity-details', [
            'activity' => $activity,
            'actualStep' => $actualStep
        ]);
    }

    public function advance(Request $request, $id)
    {
        // Lógica para avançar a atividade
        $activity = UserClassActivityStep::findOrFail($id);

        if ($activity) {
            $activity->completed = 1;
            $activity->save();
    
            return redirect()->route('dashboard')->with('success', 'Atividade avançada com sucesso!');
        } else {
            return redirect()->route('dashboard')->with('error', 'Atividade não encontrada.');
        }
        
    }

    public function return(Request $request, $id)
    {
        // Lógica para devolver a atividade
        $file = $request->file('file');
        $comment = $request->input('comment');
        $user = $request->input('user');
        
        // Processar os dados conforme necessário
        
        return redirect()->route('activities.show', ['id' => $id]);
    }
}