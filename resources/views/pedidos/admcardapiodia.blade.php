@extends('admin.admin')

@section('content')

@if ($cardapios->count() > 0)

@foreach ($cardapios as $index => $cardapio)
<div class="card">
    <div class="card-header bg-light text-center">
        <h6 class="m-0 font-weight-bold text-primary">{{ $cardapio->restaurant->name }}</h6>
    </div>
    <div class="card-body justify-content-center">
        <form method="POST" id="orderForm{{ $index }}">
            @csrf
            <input type="hidden" name="menu_id" value="{{ $cardapio->id }}">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-2 text-center">
                        <label class="font-weight-bold">Opções</label>
                        <div class="required-checkbox-group">
                            @foreach ($opcoesMenu->where('menu_id', $cardapio->id) as $opcaoMenu)
                            @if ($opcaoMenu->option->category->name == 'Opções')
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="opcoes[{{ $cardapio->id }}][]"
                                    value="{{ $opcaoMenu->option->id }}">
                                <span>{{ $opcaoMenu->option->name }}</span>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-2 text-center">
                        <label class="font-weight-bold">Carnes</label>
                        <div class="required-checkbox-group">
                            @foreach ($opcoesMenu->where('menu_id', $cardapio->id) as $opcaoMenu)
                            @if ($opcaoMenu->option->category->name == 'Carnes')
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="carnes[{{ $cardapio->id }}][]"
                                    value="{{ $opcaoMenu->option->id }}">
                                <span>{{ $opcaoMenu->option->name }}</span>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-2 text-center">
                        <label class="font-weight-bold">Acompanhamentos</label>
                        <div class="required-checkbox-group">
                            @foreach ($opcoesMenu->where('menu_id', $cardapio->id) as $opcaoMenu)
                            @if ($opcaoMenu->option->category->name == 'Acompanhamentos')
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    name="acompanhamentos[{{ $cardapio->id }}][]" value="{{ $opcaoMenu->option->id }}">
                                <span>{{ $opcaoMenu->option->name }}</span>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-2 text-center">
                        <label class="font-weight-bold">Tamanho</label>
                        <div class="required-radio-group" id="tamanho-group-{{ $index }}">
                            @foreach ($tamanhos as $tamanho)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tamanho_{{ $cardapio->id }}"
                                    value="{{ $tamanho->id }}">
                                <span>{{ $tamanho->name }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-2 text-center">
                        <label class="font-weight-bold">Pagamento</label>
                        <div class="required-radio-group" id="pagamento-group-{{ $index }}">
                            @foreach ($pagamentos as $pagamento)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="f_pagamento[{{ $cardapio->id }}]"
                                    value="{{ $pagamento->id }}">
                                <span>{{ $pagamento->name }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label class="font-weight-bold">Refrigerante</label>
                            <input type="text" class="form-control" name="f_refrigerante[{{ $cardapio->id }}]">
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label class="font-weight-bold">Troco Para</label>
                            <input type="text" class="form-control campo-numerico" name="f_troco[{{ $cardapio->id }}]">
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label class="font-weight-bold">Observações</label>
                            <input type="text" class="form-control" name="f_obs[{{ $cardapio->id }}]">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-right">
                        <button type="submit" class="btn btn-primary">Fazer Pedido</button>
                    </div>
                </div>
        </form>
    </div>
</div>
@endforeach

@else
<div class="text-center mt-4">
    <p class="h3">Não há cardápios disponíveis no momento.</p>
    <p class="lead">Por favor, verifique novamente mais tarde.</p>
</div>
@endif


@endsection