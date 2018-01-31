@extends('layout')

@section('title', 'Price - New')
@section('control')
    <a href="{{ route('companies.index') }}">Back to list</a>
@endsection

<?php
function gec($errors, $key)
{
    return $errors->has($key)?'has-error':'';
}
function isChecked($name, $value)
{
    $checks = old($name);
    if (is_array($checks)) {
        return in_array($value, $checks);
    }

    return $checks;
}

?>

@section('content')
    <div class="row">
        <div class="col-lg-12">
            @include('flash')
            <form action="{{ route('prices.store') }}" method="POST" >
                {{ csrf_field() }}
                <div class="form-group {{ gec($errors, 'companyStock') }}">
                    <label class="control-label" for="name">Company Stock</label>
                    <select
                        id="companyStock"
                        name="companyStock"
                        class="form-control"
                    >
                        <option>-</option>
                        @foreach($companiesStocks as $item)
                            <option value="{{ $item->id }}">{{ $item->company->name .' - ' . $item->stock->name }}</option>
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
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
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
                            value="{{ old('price') }}"
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