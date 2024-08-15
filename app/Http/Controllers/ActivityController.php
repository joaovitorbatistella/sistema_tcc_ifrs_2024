<?php

namespace App\Http\Controllers;

use App\Models\UserClassActivityStep;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\UserClassActivity;
use App\Models\TCC;

class ActivityController extends Controller
{
    public function index($class_id=null)
    {
        $user_id = auth()->user()->id; // Obtendo o ID do usuário autenticado
    
        // Separar as atividades em andamento, futuras e históricas
        $todoActivities = UserClassActivity::getTodoActivities($user_id, $class_id)->get();
        $historicalActivities = UserClassActivity::getHistoricalActivities($user_id, $class_id)->get();
    
        return view('turma.overviewturma', [
            'todoActivities' => $todoActivities,
            'historicalActivities' => $historicalActivities
        ]);
    }
    
    public function show($id)
    {
        $activity = UserClassActivity::findOrFail($id);
    
        return view('turma.activity-details', [
            'activity' => $activity
        ]);
    }

    public function advance(Request $request, $id)
    {
        $data = (object) $request->all();
        // Lógica para avançar a atividade
        $step = UserClassActivityStep::findOrFail($id);

        if ($step) {
            $step->completed = 1;
            $step->notes = $data->comment;
            $step->delivered_at = Carbon::now();
            $step->save();

            $allCompleted = !UserClassActivityStep::where('user_class_activity_id', $step->user_class_activity_id)
                                                 ->where('completed', 0)
                                                 ->exists();

            if($allCompleted && $activity = $step->activity) {
                $activity->delivered_at = Carbon::now();
                $activity->save();
            }
    
            return redirect()->route('class-controller.index')->with('success', 'Atividade avançada com sucesso!');
        } else {
            return redirect()->route('class-controller.index')->with('error', 'Atividade não encontrada.');
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