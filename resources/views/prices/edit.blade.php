@extends('layout')

@section('title', 'Price - edit')
@section('control')
    <a href="{{ route('prices.index') }}">Back to list</a>
@endsection

<?php
function gec($errors, $key)
{
    return $errors->has($key)?'has-error':'';
}
?>

@section('content')
    <div class="row">
        <div class="col-lg-12">
            @include('flash')
            <form action="{{ route('prices.update', ['id' => $priceMarket->id]) }}" method="POST" >
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="PATCH">
                <div class="form-group {{ gec($errors, 'companyStock') }}">
                    <label class="control-label" for="name">Company Stock</label>
                    <select
                            id="companyStock"
                            name="companyStock"
                            class="form-control"
                    >
                        <option>-</option>
                        @foreach($companiesStocks as $item)
                            <option {{ $priceMarket->companyStock->id === $item->id?'selected':'' }} value="{{ $item->id }}">{{ $item->company->name .' - ' . $item->stock->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group {{ gec($errors, 'market') }}">
                    <label class="control-label" for="market">Market</label>
                    <select
                            id="market"
                            name="market"
                            class="form-control"
                    >
                        <option>-</option>
                        @foreach($markets as $item)
                            <option {{ $priceMarket->market->id === $item->id?'selected':'' }} value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group {{ gec($errors, 'price') }}">
                    <label class="control-label" for="price">Price</label>
                    <div class="input-group">
                        <span class="input-group-addon">&#8364;</span>
                        <input
                                type="text"
                                class="form-control" id="price"
                                name="price"
                                placeholder="Price"
                                value="{{ old('price', round($priceMarket->value/100,2)) }}"
                        >
                    </div>
                    @if($errors->has('price'))
                        <span class="help-block">
                            @foreach($errors->get('price') as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </span>
                    @endif
                </div>
                <input class="btn btn-primary" type="submit" value="Submit">
            </form>
        </div>
    </div>
@endsection