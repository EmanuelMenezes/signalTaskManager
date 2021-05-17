@extends('layouts.app')

@section('content')


<div class="modal" id="exampleModal" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tarefa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row">
                <div class="form-group col-sm-5">
                    <label for="est_dur">Término Planejado</label>
                    <input readonly id="dataest" type="date" name="est_dur" class="form-control">
                </div>
                <div class="form-group col-4">
                    <label for="">Status</label>
                    <select disabled name="status" id="statusselect" class="form-select">
                        <option selected value="Aberta">Aberta</option>
                        <option value="Em Desenvolvimento">Em Desenvolvimento</option>
                        <option value="Concluída">Concluída</option>
                        <option value="Em Atraso">Em Atraso</option>
                    </select>
                </div>

                <div class="form-group col-12">
                    <label for="">Descrição</label>
                    <textarea readonly name="description" id="descricao" cols="30" rows="6" class="form-control"></textarea>
                </div>



                <div class="form-group col-8">
                    <label for="">Dono da Tarefa</label>
                    <select disabled name="owner" id="donoselect" class="form-select">
                        @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>

                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-11 card">
            <div class="card-header">
                <a href="tarefas/create" class="btn btn-primary mb-2">Criar Tarefa</a>
            </div>
            <br>
            <table class="table table-bordered">
                <h3>Suas Tarefas</h3>
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Colaborador</th>
                        <th style="width: 212px;">Status</th>
                        <th style="width: 130px;">Data Prevista</th>
                        <th style="width:220px">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tarefas as $tarefa)
                    @if(Auth()->user()->id == $tarefa->owner)
                    <tr id="tr{{ $tarefa->id }}">
                        <td>{{ $tarefa->title }}</td>
                        <td>
                            <select onchange="transfer('{{ $tarefa->id }}')" name="owner" id="select{{ $tarefa->id }}" class="form-select">
                                @foreach($users as $user)
                                @if($user->id == $tarefa->owner)
                                <option selected value="{{ $user->name }}">{{ $user->name }}</option>
                                @else
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endif
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select onchange="sTransfer('{{ $tarefa->id }}')" name="status" id="selectstat{{ $tarefa->id }}" class="form-select">
                                <option selected value="Aberta">Aberta</option>
                                <option value="Em Desenvolvimento">Em Desenvolvimento</option>
                                <option value="Concluída">Concluída</option>
                                <option value="Em Atraso">Em Atraso</option>
                            </select>
                        </td>
                        <td id="{{ date('d/m/Y', strtotime($tarefa->est_dur)) }}">{{ date('d/m/Y', strtotime($tarefa->est_dur)) }}</td>
                        <td>
                            <button onclick="openModal('{{$tarefa->title}}', '{{$tarefa->status}}', '{{$tarefa->description}}', '{{$tarefa->owner}}', '{{$tarefa->est_dur}}')" class="btn btn-transparent actionBtn fast-menu blue">
                                Ver
                            </button>
                            <a href="tarefas/{{$tarefa->id}}/edit" class="btn btn-transparent actionBtn fast-menu blue">Editar</a>
                            <form action="tarefas/{{$tarefa->id}}" id="delete{{$tarefa->id}}" method="post" class="d-inline">
                                {{ csrf_field() }}
                                @method('DELETE')

                            </form>
                            <button class="btn btn-transparent actionBtn fast-menu red" onclick="showAlert('{{$tarefa->id}}')">Deletar</button>
                        </td>
                    </tr>
                    <script>
                    setStatus('selectstat{{ $tarefa->id}}', '{{$tarefa->status}}');
                    </script>

                    @endif
                    @endforeach

                </tbody>
            </table>
            <table class="table table-bordered">
                <h3>Tarefas que você vinculou</h3>
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Colaborador</th>
                        <th style="width: 212px;">Status</th>
                        <th style="width: 130px;">Data Prevista</th>
                        <th style="width:220px">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tarefas as $tarefa)
                    @if(Auth()->user()->id == $tarefa->set_by && Auth()->user()->id != $tarefa->owner)
                    <tr id="tr{{ $tarefa->id }}">
                        <td>{{ $tarefa->title }}</td>
                        <td>
                            <select onchange="transfer('{{ $tarefa->id }}')" name="owner" id="select{{ $tarefa->id }}" class="form-select   q">
                                @foreach($users as $user)
                                @if($user->id == $tarefa->owner)
                                <option selected value="{{ $user->id }}">{{ $user->name }}</option>
                                @else
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endif
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select onchange="sTransfer('{{ $tarefa->id }}')" name="status" id="selectstat{{ $tarefa->id }}" class="form-select q">
                                <option selected value="Aberta">Aberta</option>
                                <option value="Em Desenvolvimento">Em Desenvolvimento</option>
                                <option value="Concluída">Concluída</option>
                                <option value="Em Atraso">Em Atraso</option>
                            </select>
                        </td>
                        <td>{{ date('d/m/Y', strtotime($tarefa->est_dur)) }}</td>
                        <td>
                            <button onclick="openModal('{{$tarefa->title}}', '{{$tarefa->status}}', '{{$tarefa->description}}', '{{$tarefa->owner}}', '{{$tarefa->est_dur}}')" class="btn btn-transparent actionBtn fast-menu blue">
                                Ver
                            </button>
                            <a href="tarefas/{{$tarefa->id}}/edit" class="btn btn-transparent actionBtn fast-menu blue">Editar</a>
                            <form action="tarefas/{{$tarefa->id}}" id="delete{{$tarefa->id}}" method="post" class="d-inline">
                                {{ csrf_field() }}
                                @method('DELETE')

                            </form>
                            <button class="btn btn-transparent actionBtn fast-menu red" onclick="showAlert('{{$tarefa->id}}')">Deletar</button>
                        </td>
                    </tr>
                    <script>
                    setStatus('selectstat{{ $tarefa->id}}', '{{$tarefa->status}}');
                    </script>
                    @endif
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
function openModal(title, status, description, owner, est_dur) {
    $('#exampleModalLabel').text(title);
    $('#statusselect').val(status);
    $('#donoselect').val(owner);
    $('#descricao').text(description);
    $('#dataest').val(est_dur);
    $('#exampleModal').modal('show');
}
</script>
@endsection