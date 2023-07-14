@extends('admin.admin')

@section('content')

@if ($cardapios->count() > 0)

@foreach ($cardapios as $index => $cardapio)
<div class="card mx-4" style="box-shadow: 0 0 20px 0 rgb(136, 136, 136)">
    <div class="card-header bg-cinza2 text-center">
        <h6 class="m-0 font-weight-bold text-primary">{{ $cardapio->restaurant->name }}</h6>
    </div>
    <div class="card-body bg-light">
        <form method="POST" id="orderForm{{ $index }}">
            @csrf
            <input type="hidden" name="menu_id" value="{{ $cardapio->id }}">
            <div class="container">

                <div class="row">

                    <div class="col-md-3">
                        <div class="form-group text-left">
                            <label class="font-weight-bold">Opções</label>
                            <div class="required-checkbox-group text-left">
                                @foreach ($opcoesMenu->where('menu_id', $cardapio->id) as $opcaoMenu)
                                @if ($opcaoMenu->option->category->name == 'Opções')
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="opcoes[{{ $cardapio->id }}][]"
                                        value="{{ $opcaoMenu->option->id }}">
                                    <label class="form-check-label">{{ $opcaoMenu->option->name }}</label>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group text-left">
                            <label class="font-weight-bold">Carnes</label>
                            <div class="required-checkbox-group text-left">
                                @foreach ($opcoesMenu->where('menu_id', $cardapio->id) as $opcaoMenu)
                                @if ($opcaoMenu->option->category->name == 'Carnes')
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="carnes[{{ $cardapio->id }}][]"
                                        value="{{ $opcaoMenu->option->id }}">
                                    <label class="form-check-label">{{ $opcaoMenu->option->name }}</label>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group text-left">
                            <label class="font-weight-bold">Acompanhamentos</label>
                            <div class="required-checkbox-group text-left">
                                @foreach ($opcoesMenu->where('menu_id', $cardapio->id) as $opcaoMenu)
                                @if ($opcaoMenu->option->category->name == 'Acompanhamentos')
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        name="acompanhamentos[{{ $cardapio->id }}][]"
                                        value="{{ $opcaoMenu->option->id }}">
                                    <label class="form-check-label">{{ $opcaoMenu->option->name }}</label>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 text-left">
                        <div class="form-group">
                            <label class="font-weight-bold">Tamanho</label>
                            <div class="required-radio-group text-left" id="tamanho-group-{{ $index }}">
                                @foreach ($tamanhos as $tamanho)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tamanho_{{ $cardapio->id }}"
                                        value="{{ $tamanho->id }}">
                                    <label class="form-check-label">{{ $tamanho->name }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-3"></div>
                    <div class="col-md-3"></div>

                    <div class="col-md-3 text-left">
                        <div class="form-group">
                            <label class="font-weight-bold">Pagamento</label>
                            <div class="required-radio-group text-left" id="pagamento-group-{{ $index }}">
                                @foreach ($pagamentos as $pagamento)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="f_pagamento[{{ $cardapio->id }}]"
                                        value="{{ $pagamento->id }}">
                                    <label class="form-check-label">{{ $pagamento->name }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="font-weight-bold">Refrigerante</label>
                            <input type="text" class="form-control" maxlength="25"
                                name="f_refrigerante[{{ $cardapio->id }}]">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="font-weight-bold">Troco Para</label>
                            <input type="text" class="form-control campo-numerico" maxlength="6"
                                name="f_troco[{{ $cardapio->id }}]">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="font-weight-bold">Observações</label>
                            <input type="text" class="form-control" maxlength="50" name="f_obs[{{ $cardapio->id }}]">
                        </div>
                    </div>
                </div>


                <div class="col-12 shadow p-3 mb-5 bg-white rounded">
                    <div class="text-left small">
                        <label class="font-weight-bold">Valores</label><br>
                        @foreach ($prices as $price)
                        @if ($price->restaurant_id == $cardapio->restaurant->id)
                        {{ $price->size->name }} - R$ {{ $price->price }}<br>
                        @endif
                        @endforeach
                    </div>
                </div>
                <div class="col-12 text-right">
                    <button type="submit" class="btn btn-primary bg-cinza">Fazer Pedido</button>
                </div>

            </div>
        </form>
    </div>
</div>


<br>


@endforeach

@else
<div class="text-center mt-4">
    <p class="h3">Não há cardápios disponíveis no momento.</p>
    <p class="lead">Por favor, verifique novamente mais tarde.</p>
</div>
@endif



@endsection
