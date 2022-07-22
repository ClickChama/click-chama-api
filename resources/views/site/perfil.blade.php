@extends('layouts.main')

@section('body')
    <div class="container perfil">
        <form action="{{route('auth.seller.update')}}" method="PUT">
            <div class="row">
                <div class="col-12">
                    <h1>Meu cadastro</h1>
                </div>
                <div class="col">
                    <p>Dados da Conta</p>
                    <div class="row mb-2">
                        <div class="col-4 mb-2"><label class="form-label">Nome Completo</label><input type="text" class="form-control" name="name"></div>
                        <div class="col-4 mb-2"><label class="form-label">Telefone de Contato</label><input type="text" class="form-control" name="phone"></div>
                        <div class="col-4 mb-2"><label class="form-label">E-Mail</label><input type="text" class="form-control" name="email" disabled=""></div>
                        <div class="col-4 mb-2"><label class="form-label">Nova Senha</label><input type="password" class="form-control" name="password"></div>
                    </div>
                    <p>Dados Visíveis no Aplicativo</p>
                    <div class="row mb-2">
                        <div class="col-4 mb-2"><label class="form-label">Nome no Aplicativo</label><input type="text" class="form-control" name="app_name"></div>
                        <div class="col-4 mb-2"><label class="form-label">Telefone</label><input type="text" class="form-control" name="app_phone"></div>
                    </div>
                    <p>Dados Internos</p>
                    <div class="row">
                        <div class="col-4 mb-2"><label class="form-label">CNPJ</label><input type="text" class="form-control" name="cnpj"></div>
                        <div class="col-4 mb-2"><label class="form-label">Razão Social</label><input type="text" class="form-control" name="corporate_name"></div>
                        <div class="col-4 mb-2"><label class="form-label">CEP</label><input type="text" class="form-control" name="zip_code"></div>
                        <div class="col-4 mb-2"><label class="form-label">Rua</label><input type="text" class="form-control" name="address"></div>
                        <div class="col-4 mb-2"><label class="form-label">Numero</label><input type="text" class="form-control" name="number"></div>
                        <div class="col-4 mb-2"><label class="form-label">Bairro</label><input type="text" class="form-control" name="district"></div>
                        <div class="col-4 mb-2"><label class="form-label">Cidade</label><input type="text" class="form-control" name="city"></div>
                        <div class="col-4 mb-2"><label class="form-label">Estado</label><input type="text" class="form-control" name="state"></div>
                        <div class="col-4 mb-2"><label class="form-label">Complemento</label><input type="text" class="form-control" name="complement"></div>
                        <div class="col-4 mb-2"><label class="form-label">Raio de Entrega</label><input type="number" class="form-control" name="delivery_radius"></div>
                        <div class="col-4 mb-2"><label class="form-label">Tempo de Entrega</label><input type="number" class="form-control" name="delivery_time"></div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <button type="button" class="btn btn-primary btn-send">Salvar Alterações</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection