<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\UploadedFile;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = User::students();

        return view('classes.index', ['students' => $students]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'file_1' => 'mimes:pdf,jpg,png|max:2048',
            'file_2' => 'mimes:pdf,jpg,png|max:2048',
            'file_3' => 'mimes:pdf,jpg,png|max:2048',
            'file_4' => 'mimes:pdf,jpg,png|max:2048',
            'file_5' => 'mimes:pdf,jpg,png|max:2048',
        ]);

     

        dd($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
