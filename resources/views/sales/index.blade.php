@extends('layouts.master')

@section('content')
    <div class="container">
        <table class="table orders_datatable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Data da Venda</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Status</th>
                    <th scope="col">Vendendor</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Forma de pagamento</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sales as $sale)
                    <tr>
                        <td></td>
                        <td>{{ date('d/m/Y', strtotime($sale->date)) }}</td>
                        <td>R$ {{ $sale->totalPrice }}</td>
                        @foreach ($saleStatuses as $status => $description)
                            @if ($sale->status == $status)
                                <td>{{ $description }}</td>
                            @endif
                        @endforeach
                        <td>{{ $sale->user->name }}</td>
                        <td>{{ $sale->client->name }}</td>
                        <td>{{ $sale->payment->method ?? '' }}</td>
                        <td>
                            <form action="{{ route('sales.generatePDF', $sale->id) }}">
                                <button class="btn btn-danger p-2" type="submit">+ <i class="bi bi-filetype-pdf"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
