@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Departments</h2>
            </div>
            <div class="pull-right">
                @can('department-create')
                    <a class="btn btn-success" href="{{ route('departments.create') }}"> Create New Department</a>
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
            <th width="280px">Action</th>
        </tr>
        @foreach ($departments as $department)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $department->name }}</td>
                <td>
                    <form action="{{ route('departments.destroy', $department->id) }}" method="POST">
                        {{-- <a class="btn btn-info" href="{{ route('departments.show', $department->id) }}">Show</a> --}}
                        @can('department-show')
                            <a class="btn btn-info" href="{{ route('departments.show', $department->id) }}"><i class="fa-solid fa-eye"></i></a>
                        @endcan
                        @can('department-edit')
                            <a class="btn btn-primary" href="{{ route('departments.edit', $department->id) }}"><i
                                class="fa-solid fa-pencil"></i></a>
                        @endcan
                        @can('property-list')
                            <a class="btn btn-secondary" href="{{ route('departments.properties.index', $department) }}"><i class="fa-solid fa-list"></i></a>
                        @endcan
                        @csrf
                        @method('DELETE')
                        @can('department-delete')
                            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                        @endcan
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {!! $departments->links() !!}
@endsection
