@extends('layout')

@section('title', 'Companies Profiles')
@section('control')
    <a href="{{route('companies.create')}}"><button class="btn btn-success">Add company</button></a>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            @include('flash')
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Stocks</th>
                    <th>Markets</th>
                    <th></th>
                </tr>
                @foreach($companies as $company)
                    <tr>
                        <td>{{ $company->id }}</td>
                        <td>{{ $company->name }}</td>
                        <td>{{ $company->stocks->pluck('name')->implode(',') }}</td>
                        <td>{{ $company->markets->pluck('market.name')->implode(',') }}</td>
                        <td>
                            <form method="POST" id="companyDeleteForm{{ $company->id }}" action="{{route('companies.destroy', ['id' => $company->id])}}">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE">
                                <a href="{{route('companies.edit', ['id' => $company->id])}}">Edit</a>
                                <a onmouseup="confirmedSubmit('companyDeleteForm{{ $company->id }}')" href="#">Del</a>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
            {{ $companies->links() }}
        </div>
    </div>
@endsection