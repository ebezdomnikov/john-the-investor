@extends('layout')

@section('title', 'Companies Profiles - New')
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
            <form action="{{ route('companies.store') }}" method="POST" >
                {{ csrf_field() }}
                <div class="form-group {{ gec($errors, 'name') }}">
                    <label class="control-label" for="name">Company Name</label>
                    <input
                        type="text"
                        class="form-control" id="name"
                        name="name"
                        placeholder="Company Name"
                        value="{{ old('name') }}"
                    >
                    @if($errors->has('name'))
                        <span class="help-block">
                            @foreach($errors->get('name') as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </span>
                    @endif
                </div>
                <div class="form-group {{ gec($errors, 'stock.*') }}">
                @foreach($stockTypes as $stockType)
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="stock[{{$stockType->id}}]" {{ isChecked('stock', $stockType->id)?'checked':'' }} value="{{ $stockType->id }}">
                            {{ $stockType->name }}
                        </label>
                    </div>
                @endforeach
                @if($errors->has('stock.*'))
                    <span class="help-block">
                        @foreach($errors->get('stock.*') as $error)
                            <div>{{ implode(', ', $error) }}</div>
                        @endforeach
                    </span>
                @endif
                </div>
                <input class="btn btn-primary" type="submit" value="Submit">
            </form>
        </div>
    </div>
@endsection