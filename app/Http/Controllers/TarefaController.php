<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarefa;
use App\Models\User;
use DateTime;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class TarefaController extends Controller
{
    public function index()
    {
        $users = User::all();
        $tarefas = Tarefa::all();


        return view('tarefas.index', compact('tarefas'), compact('users'));
    }

    public function create()
    {
        $users = User::all();
        return view('tarefas.create', compact('users'));
    }

    public function store(Request $request)
    {   
        $request->validate([
            'title' => 'required',
            'status' => 'required',
            'description' => 'required',
            'owner' => 'required',
            'est_dur' => 'required',
            ]);

        $tarefa = new Tarefa();
        $tarefa->title = $request->title;
        $tarefa->status = $request->status;
        $tarefa->description = $request->description;
        $tarefa->owner = $request->owner;
        $tarefa->est_dur = $request->est_dur;
        if($request->owner != Auth()->user()->id){
            $tarefa->set_by = Auth()->user()->id;
        }else{
            $tarefa->set_by = $request->owner;
        }
        $tarefa->save();
        return redirect('/')->with('success', 'Tarefa Criada com Sucesso');
    }

    public function show(Tarefa $tarefa)
    {
        return view('tarefas.show', compact('tarefa'));
    }

    public function edit(Tarefa $tarefa)
    {
        $users = User::all();
        return view('tarefas.edit', compact('tarefa'), compact('users'));
    }

    public function update(Tarefa $tarefa, Request $request)
    {
        $request->validate([
            'title' => 'required',
            'status' => 'required',
            'description' => 'required',
            'owner' => 'required',
            'est_dur' => 'required',
            ]);

        $tarefa->title = $request->title;
        $tarefa->status = $request->status;
        $tarefa->description = $request->description;
        $tarefa->owner = $request->owner;
        $tarefa->est_dur = $request->est_dur;

        $tarefa->save();
        return redirect('/')->with('success','Tarefa atualizada com sucesso!');
    }
    public function oupdate(Tarefa $tarefa, Request $request)
    {
        $request->validate([
            'owner' => 'required',
            ]);

        $tarefa->owner = $request->owner;
        $tarefa->set_by = Auth()->user()->id;


        $tarefa->save();

    }
    public function supdate(Tarefa $tarefa, Request $request)
    {
        $request->validate([
            'status' => 'required',
            ]);

        $tarefa->status = $request->status;
        $tarefa->save();

    }

    public function destroy(Tarefa $tarefa)
    {
        $tarefa->delete();
        return redirect('/')->with('success','Tarefa deletada com sucesso!');
    }
}
