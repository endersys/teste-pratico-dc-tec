@extends('layouts.master')

@section('content')
    <div class="col-md-12 m-auto">
        <form action="{{ route('orders.payOrder', $order->id) }}" method="POST">
            @csrf
            <div class="col-md-12">
                <div class="card mb-4 p-5 col-md-12">
                    <div class="row m-auto">
                        <h3 class="card-header">Pagar Pedido N° {{ $order->id }}</h3>
                        <div class="card-body col-md-4">
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <label class="form-label mx-3">Cliente:</label><span>{{ $order->client->name }}</span>
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label
                                        class="form-label mx-3">Endereço:</label><span>{{ $order->client->address }}</span>
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label class="form-label mx-3">Preço:</label><span id="order_price"
                                        data-price="{{ $order->totalPrice }}">R$ {{ $order->totalPrice }}</span>
                                </div>
                            </div>
                            <div class="mb-2">
                                <label for="price" class="form-label mx-3">Itens:</label>
                            </div>
                            <ul class="mx-3">
                                @foreach ($order->orderProducts as $item)
                                    <div>
                                        <li>{{ $item->product->name }} - {{ $item->quantity }}</li>
                                    </div>
                                @endforeach
                            </ul>
                            <div class="row py-2">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Pagar</button>
                                    <a href="{{ route('orders.index') }}" type="reset"
                                        class="btn btn-outline-secondary">Cancelar</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body col-md-8 p-0">
                            <div class="row">
                                <div class="mb-3 col-md-12 d-flex">
                                    <div>
                                        <label class="form-label">Quantidade de Parcelas</label>
                                        <input type="number" class="form-control" name="address" value=""
                                            id="installment-quantity-field" />
                                    </div>
                                    <div class="mt-4 mx-4">
                                        <button onclick="addGroup()" type="button" class="btn btn-primary">Gerar
                                            Parcelas</button>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="d-none" id="installment_set_base">
                                    <div class="mb-3 col-md-12 d-flex" id="installment_set_1">
                                        <div class="col-md-3" style="margin-right: 15px;">
                                            <label class="form-label">Data</label>
                                            <input type="date" class="form-control" name="date[]" id="date_1" />
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Valor</label>
                                            <input type="number" class="form-control" name="value[]" id="value_1"
                                                placeholder="R$ 0.0" step="any" />
                                        </div>
                                    </div>
                                </div>
                                <div id="set-clone">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        function padTo2Digits(num) {
            return num.toString().padStart(2, '0');
        }

        function addGroup() {
            $('#set-clone')
                .children('div')
                .remove();

            var orderPrice = Number($('#order_price').attr('data-price'));
            var installments = Number($('#installment-quantity-field').val());

            var installmentValue = orderPrice / installments;

            var date = new Date();
            var currentDay = date.getDate();
            var currentMonth = date.getMonth() + 1;
            var currentYear = date.getFullYear();

            for (let index = 0; index < installments; index++) {
                $('#set-clone')
                    .append($('#installment_set_base')
                        .clone()
                        .children('div')
                        .attr("id", 'set_clone_' + index + ''));

                var together = [currentYear, padTo2Digits(currentDay), padTo2Digits(currentMonth + index)].join('-');

                $('#set_clone_' + index + ' #date_1').attr('id', 'date_' + index).val(together);
                $('#set_clone_' + index + ' #value_1').attr('id', 'value_' + index).val(installmentValue);
                $('#set_clone_' + index + ' #note_1').attr('id', 'note_' + index).val("");
            }
        }
    </script>
@endsection
