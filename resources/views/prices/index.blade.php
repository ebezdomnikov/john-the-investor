@extends('layout')

@section('title', 'Prices')
@section('control')
    <a href="{{route('prices.create')}}"><button class="btn btn-success">Add Price</button></a>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            @include('flash')
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Company</th>
                    <th>Stock</th>
                    <th>Market</th>
                    <th>Price</th>
                    <th></th>
                </tr>
                @foreach($prices as $price)
                    <tr>
                        <td>{{ $price->id }}</td>
                        <td>{{ $price->companyStock->company->name }}</td>
                        <td>{{ $price->companyStock->stock->name }}</td>
                        <td>{{ $price->market->name }}</td>
                        <td>&#8364; {{ number_format($price->value/100, 2, ',', ',')}}</td>
                        <td>
                            <form method="POST" id="priceDeleteForm{{ $price->id }}" action="{{route('prices.destroy', ['id' => $price->id])}}">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE">
                                <a href="{{route('prices.edit', ['id' => $price->id])}}">Edit</a>
                                <a onmouseup="confirmedSubmit('priceDeleteForm{{ $price->id }}')" href="#">Del</a>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
            {{ $prices->links() }}
        </div>
    </div>
@endsection