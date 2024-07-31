<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Append;
use Illuminate\Support\Str;

class FileController extends Controller
{
    public function uploadFile(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('public/uploads');
            $fileModel = new Append();
            $fileModel->name = $file->getClientOriginalName();
            $fileModel->user_id = auth()->user()->id;
            $fileModel->type_id = $request->input('type_id');
            $fileModel->public = 1;
            $fileModel->path = Storage::url($path);
            $fileModel->created_at = now();
            $fileModel->updated_at = now();
            $fileModel->save();

            return response()->json(['success' => true, 'file' => $fileModel]);
        }

        return response()->json(['message' => 'Nenhum arquivo encontrado.'], 400);
    }

    public function listFiles()
    {
        $files = Append::all();
        return response()->json($files);
    }

    public function deleteFile($id)
    {
        $file = Append::findOrFail($id);
        Storage::delete(str_replace('/storage/', 'public/', $file->path));
        $file->delete();
        return response()->json(['success' => true, 'message' => 'Arquivo deletado com sucesso!']);
    }

    public function download($fileId)
    {
        $file = Append::findOrFail($fileId);
        $filePath = storage_path('app/public/' . $file->path);

        if (!file_exists($filePath)) {
            abort(404);
        }

        return response()->download($filePath);
    }
}
