@extends('layouts.master')

@section('content')
    <div class="col-md-12 m-auto">
        <form action="{{ route('orders.store') }}" method="POST">
            @csrf
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Novo Pedido</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="client" class="form-label">Cliente</label>
                                <input type="text" class="form-control" name="client" value="{{ old("client") }}"/>
                                @error('client')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="address" class="form-label">Endereço</label>
                                <input type="text" class="form-control" name="address" value="{{ old("address") }}" />
                                @error('address')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Itens:</label>
                        </div>
                        <div id="item_set_base">
                            <div class="row m-auto" id="item_set_1">
                                <div class="mb-3 col-md-4">
                                    <label for="name" class="form-label">Nome</label>
                                    <select class="form-control" id="name_1" name="product_id[]">
                                        <option selected disabled>Selecione...</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="quantity" class="form-label">Quantidade</label>
                                    <input type="number" class="form-control" id="quantity_1" name="quantity[]" />
                                </div>
                                <div class="col-md-2 m-auto mx-0 p-0">
                                    <button onclick="addGroup()" class="btn btn-primary" style="margin-top: 20px"
                                        type="button">+</button>
                                    <button class="btn btn-danger d-none mx-1" id="delete_group" style="margin-top: 14px"
                                        type="button">x</button>
                                </div>
                            </div>
                        </div>
                        <div id="set-clone">
                        </div>
                        <div class="row py-2">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Cadastrar</button>
                                <a href="{{ route('orders.index') }}" type="reset"
                                    class="btn btn-outline-secondary">Cancelar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        var index = 1;

        function addGroup() {
            index++
            $('#set-clone')
                .append($('#item_set_base')
                    .clone()
                    .children('div')
                    .attr("id", 'set_clone_' + index + ''));
            $('#set_clone_' + index + ' #name_1').attr('id', 'name_' + index).val("");
            $('#set_clone_' + index + ' #quantity_1').attr('id', 'quantity_' + index).val("");
            $('#set_clone_' + index + ' #delete_group').attr("onclick", 'delGroup(' + index + ')').removeClass('d-none');
        }

        function delGroup(n) {
            $("#set_clone_" + n).remove();
            $("#countL").attr("value", ($("#countL").val() - 1));
            index--
        }
    </script>
@endsection
