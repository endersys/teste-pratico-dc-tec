@extends('layouts.master')

@section('content')
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Data do pedido</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Status</th>
                    <th scope="col">Vendendor</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Forma de pagamento</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td></td>
                        <td>{{ $order->date }}</td>
                        <td>R$ {{ $order->totalPrice }}</td>
                        <td>{{ $order->status }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->client->name }}</td>
                        <td>{{ $order->payment->method ?? '' }}</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="">
                                        <i class="bi bi-wallet2 me-2"></i>Pagar pedido
                                    </a>
                                    <a class="dropdown-item" href="{{ route('orders.edit', $order->id) }}">
                                        <i class="bx bx-edit-alt me-2"></i>Editar
                                    </a>
                                    <a class="dropdown-item" href="">
                                        <i class="bx bx-trash-alt me-2"></i>Excluir
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
