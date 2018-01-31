@extends('layout')

@section('title', 'Highest Market Prices')

@include('overview.control')

@section('content')
    <div class="row">
        <div class="col-lg-4">
            @foreach($highTrades as $highTrade)
                <div class="hightrade-item stock-type-{{$highTrade->companyStock->stock->type}}">
                    <div class="hightrade-container ">
                    <div class="hightrade-company-name">{{ $highTrade->companyStock->company->name }}</div>
                    <div class="hightrade-stock-name">{{ $highTrade->companyStock->stock->name }}</div>
                    <div class="hightrade-price">
                        &#8364; {{ number_format($highTrade->highPrice/100, 2, ',', ',')  }}</div>
                    </div>
                    <div class="hightrade-market-title hightrade-market-title-stock-{{$highTrade->companyStock->stock->type}} stock-type-{{$highTrade->companyStock->stock->type}}">{{ $highTrade->market->name }}</div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

