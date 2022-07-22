@extends('layouts.main')

@section('body')
    <div class="container">
        <div class="row">
            <div class="col-12 mb-2">
                <h2>PRODUTOS</h2>
            </div>
            <div class="col-12 mb-2"><button class="btn btn-primary" type="button" data-bs-target="#novo-produto" data-bs-toggle="modal">Novo Produto</button></div>
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Marca</th>
                                <th>Tipo</th>
                                <th>Preço</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody class="table-produto"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" role="dialog" tabindex="-1" id="editar-produto">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Editar Produto</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('product')}}" method="PUT">
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <div class="modal-body">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-8 mb-2"><label class="form-label">Marca</label><input type="text" class="form-control" name="brand"></div>
                                    <div class="col-8 mb-2"><label class="form-label">Tipo</label><input type="text" class="form-control" name="type"></div>
                                    <div class="col-8 mb-2"><label class="form-label">Preço</label><input type="number" class="form-control" name="price"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Fechar</button><button class="btn btn-primary btn-send" type="button">Salvar Alteração</button></div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" role="dialog" tabindex="-1" id="novo-produto">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Novo Produto</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('product')}}">
                    <div class="modal-body">
                        <div class="modal-body">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-8 mb-2"><label class="form-label">Marca</label><input type="text" class="form-control" name="brand"></div>
                                    <div class="col-8 mb-2"><label class="form-label">Tipo</label><input type="text" class="form-control" name="type"></div>
                                    <div class="col-8 mb-2"><label class="form-label">Preço</label><input type="number" class="form-control" name="price"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Fechar</button><button class="btn btn-primary btn-send" type="button">Salvar</button></div>
                </form>
            </div>
        </div>
    </div>
@endsection