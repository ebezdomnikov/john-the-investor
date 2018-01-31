@extends('layout')

@section('title', 'Company Stock Overview')

@include('overview.control')

@section('content')
        <div class="row overview-container">
            @foreach($stocks as $item)
                <div class="overview-item col-sm-12 col-xs-12 col-sm-4 col-lg-4">
                    <div class="overview-item-header stock-type-{{$item['stock']->stock->type}}">
                        <div>{{$item['stock']->company->name}}</div>
                        <small>{{$item['stock']->stock->name}}</small>
                    </div>
                    <div class="markets-container">
                        @foreach($item['markets'] as $market)
                        <div class="market-item">
                            <div class="market-title">{{$market->market->name}}</div>
                            <div><span class="badge market-price-badge stock-type-{{$item['stock']->stock->type}}">&#8364; {{ number_format($market->marketSum/100, 2, ',', ',')}}</span></div>
                        </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
@endsection