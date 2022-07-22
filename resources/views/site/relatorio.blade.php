@extends('layouts.main')

@section('body')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Relatorios</h1>
                <div class="row">
                    <div class="col-12">
                        <h4>Filtro</h4>
                    </div>
                    <div class="col-12 col-sm-4 mb-2"><label class="form-label">Endereço</label><input type="text" class="form-control" name="address"></div>
                    <div class="col-12 col-sm-4 mb-2"><label class="form-label">Data</label><input type="text" class="form-control" name="date" value="01/07/2022 30/07/2022"></div>
                    <div class="col-12 col-sm-4 d-flex align-items-end mb-2">
                        <div style="width: 100%;"><button class="btn btn-info" type="button" style="width: 100%;">pesquisar</button></div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Endereço</th>
                                <th>Produto</th>
                                <th>Pagto.</th>
                                <th>Valor</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Vinicius</td>
                                <td>Rua tereza moreira, 110</td>
                                <td>1x P13 ultragas</td>
                                <td>CC</td>
                                <td>114,89</td>
                                <td><i class="fa fa-check-circle-o text-success" style="font-size: 21px;"></i></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection