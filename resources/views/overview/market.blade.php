@extends('layout')

@section('title', 'Market Overview')

@include('overview.control')

@section('content')
    <div class="row">
        @foreach($markets as $market)
            <div class="col-12">
                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="market-header">{{ $market->name }}</div>
                    <!-- Table -->
                    <table class="table market-table">
                        <tr>
                            <th>Company Name</th>
                            <th>Stock type</th>
                            <th>Price entered date</th>
                            <th>Price entered time</th>
                            <th>Price</th>
                        </tr>
                        <tbody>
                            @foreach($market->prices as $price)
                                <tr>
                                    <td>{{ $price->companyStock->company->name }}</td>
                                    <td>{{ $price->companyStock->stock->name }}</td>
                                    <td>{{ $price->created_at->format('d.m.Y') }}</td>
                                    <td>{{ $price->created_at->format('H:i') }}</td>
                                    <td><span class="badge market-price-badge stock-type-{{$price->companyStock->stock->type}}">&#8364; {{ number_format($price->value/100, 2, ',', ',')}}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                </div>
        @endforeach
    </div>
@endsection