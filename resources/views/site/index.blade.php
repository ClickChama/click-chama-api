@extends('layouts.main'):

@section('body')
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-4 offset-xl-0" style="padding: 12px 12px;">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Novos Pedidos</h4>
                        <div class="container allpedidos" style="margin: 10px 0px;">
                            <div class="row justify-content-between">
                                <div class="col-12 text-start" id="total" style="padding: 6px 12px;">
                                    <div class="text-white bg-success d-flex justify-content-center align-items-center"
                                        style="width: 38px;height: 38px;padding: 2px;border-radius: 20px;"><span>0</span>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="row pedido" style="margin-top: 12px;">
                                <div class="col" style="margin-bottom: 12px;border-width: 1px;border-style: solid;border-top-color: rgb(33,;border-right-color: 37,;border-bottom-color: 41);border-left-color: 37,;border-radius: 6px;">
                                    <div style="padding-top: 12px;padding-bottom: 12px;"><span>Nome do pedido</span></div>
                                </div>
                            </div> --}}

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-xl-4 offset-xl-0" style="padding: 12px 12px;">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Em Andamento</h4>
                        <div class="container peddidos" style="margin: 10px 0px;">
                            <div class="row justify-content-between">
                                <div class="col-12 text-start" id="total-andamento" style="padding: 6px 12px;">
                                    <div class="text-white bg-success d-flex justify-content-center align-items-center"
                                        style="width: 38px;height: 38px;padding: 2px;border-radius: 20px;"><span>0</span>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="row" style="margin-top: 12px;">
                                <div class="col" style="margin-bottom: 12px;border-width: 1px;border-style: solid;border-top-color: rgb(33,;border-right-color: 37,;border-bottom-color: 41);border-left-color: 37,;border-radius: 6px;">
                                    <div style="padding-top: 12px;padding-bottom: 12px;"><span>Nenhum novo pedido</span></div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-xl-4 offset-xl-0" style="padding: 12px 12px;">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Conluídos</h4>
                        <div class="container concluidos" style="margin: 10px 0px;">
                            <div class="row justify-content-between">
                                <div class="col-12 text-start" id="total-concluido" style="padding: 6px 12px;">
                                    <div class="text-white bg-success d-flex justify-content-center align-items-center"
                                        style="width: 38px;height: 38px;padding: 2px;border-radius: 20px;"><span>0</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="status" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('statuschange') }}" method="PUT" id="form-send">
                <input type="hidden" id="statusId" name="id">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <select class="form-select" id="statusChange" name="status" aria-label="Default select example">
                            <option value="1">Aceitar</option>
                            <option value="2">Entrega</option>
                            <option value="3">Produto Entregue</option>
                            <option value="4">Cancelar</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="button" class="btn btn-primary btn-enviar">Atualizar</button>
                    </div>
            </form>
        </div>
    </div>
    </div>
@endsection
