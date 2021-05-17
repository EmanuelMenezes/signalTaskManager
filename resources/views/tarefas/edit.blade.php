@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Editar Tarefa') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form class="row" action="/tarefas/{{$tarefa->id}}" method="post">
                    @csrf
                    {{method_field('PUT')}}
                        <div class="form-group col-sm-7">
                            <label for="">Título</label>
                            <input required type="text" value="{{$tarefa->title}}" name="title" class="form-control">
                        </div>
                        <div class="form-group col-sm-5">
                            <label for="est_dur">Término Planejado</label>
                            <input required type="date" value="{{$tarefa->est_dur}}" name="est_dur" class="form-control">
                        </div>

                        <div class="form-group col-12">
                            <label for="">Descrição</label>
                            <textarea required name="description" id="" cols="30" rows="6" class="form-control">{{$tarefa->description}}</textarea>
                        </div>

                        <div class="form-group col-4">
                            <label for="">Status</label>
                            <select name="status" id="" class="form-select">
                                <option selected value="Aberta">Aberta</option>
                                <option value="Em Desenvolvimento">Em Desenvolvimento</option>
                                <option value="Concluída">Concluída</option>
                                <option value="Em Atraso">Em Atraso</option>
                            </select>
                        </div>

                        <div class="form-group col-8">
                            <label for="">Dono da Tarefa</label>
                            <select name="owner" id="" class="form-select">
                                @foreach($users as $user)
                                @if($user->id == $tarefa->id)
                                <option selected value="{{ $user->id }}">{{ $user->name }}</option>
                                @else
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-12">
                            <input type="submit" class="btn btn-primary">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection