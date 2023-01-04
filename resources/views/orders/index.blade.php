@extends('layouts.master')

@section('content')
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
           @foreach($orders as $order)
                <tr>
                    <td></td>
                    <td>{{ $order->date }}</td>
                    <td>{{ $order->price }}</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $order->client->name }}</td>
                    <td>{{ $order->payment->method }}</td>
                    <td></td>
                </tr>
           @endforeach
        </tbody>
    </table>
@endsection
