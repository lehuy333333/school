@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>{{$department->name}} - Properties</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('departments.index') }}"> Back</a>
                @can('property-create')
                    <a class="btn btn-success" href="{{ route('departments.properties.create', $department->id)}}"> Create New Property</a>
                @endcan
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered mt-2">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Amount</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($properties as $property)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $property->name }}</td>
                <td>{{ $property->amount }}</td>
                <td>
                    <form action="{{ route('properties.destroy', $property->id) }}" method="POST">
                        {{-- <a class="btn btn-info" href="{{ route('properties.show', $property->id) }}">Show</a> --}}
                        @can('property-edit')
                            <a class="btn btn-primary" href="{{ route('properties.edit', $property->id) }}">Edit</a>
                        @endcan
                        @csrf
                        @method('DELETE')
                        @can('property-delete')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        @endcan
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {!! $properties->links() !!}
@endsection
