@extends('layout')

@section('title', 'Markets')
@section('control')
    <a href="{{route('markets.create')}}"><button class="btn btn-success">Add market</button></a>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            @include('flash')
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th></th>
                </tr>
                @foreach($markets as $market)
                    <tr>
                        <td>{{ $market->id }}</td>
                        <td>{{ $market->name }}</td>
                        <td>
                            <form method="POST" id="marketDeleteForm{{ $market->id }}" action="{{route('markets.destroy', ['id' => $market->id])}}">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE">
                                <a href="{{route('markets.edit', ['id' => $market->id])}}">Edit</a>
                                <a onmouseup="confirmedSubmit('marketDeleteForm{{ $market->id }}')" href="#">Del</a>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
            {{ $markets->links() }}
        </div>
    </div>
@endsection