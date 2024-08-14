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
            $relativePath = str_replace('public/', '', $path);
            $fileModel = new Append();
            $fileModel->name = $file->getClientOriginalName();
            $fileModel->user_id = auth()->user()->id;
            $fileModel->type_id = $request->input('type_id');
            $fileModel->public = 1;
            $fileModel->path = $relativePath;
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

    public function downloadFile($id)
    {
        $file = Append::find($id);

        if ($file) {
            $path = storage_path("app/{$file->path}");
            if (file_exists($path)) {
                return response()->download($path);
            }
        }

        return response()->json(['success' => false, 'message' => 'Arquivo não encontrado.']);
    }

    public function search(Request $request)
    {
        $search = $request->input('search', '');
        $typeId = $request->input('type_id');
        $orderBy = $request->input('order_by', 'name');

        try {
            $query = Append::query();

            $query->where('public', 1);

            if (!empty($search)) {
                $query->where('name', 'like', "%$search%");
            }

            if (!empty($typeId)) {
                $query->where('type_id', $typeId);
            }

            if ($orderBy === 'date') {
                $query->orderBy('updated_at', 'desc');
            } else {
                $query->orderBy('name', 'asc');
            }

            $files = $query->get();

            return response()->json($files);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro'], 500);
        }
    }

    public function recentFiles()
    {
        $files = Append::orderBy('created_at', 'desc')->limit(5)->get();
        return response()->json($files);
    }
}
