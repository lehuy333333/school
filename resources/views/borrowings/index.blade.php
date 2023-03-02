@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Borrowings</h2>
            </div>
            <div class="pull-right">
                @can('department-create')
                    <a class="btn btn-success" href="{{ route('borrowings.create') }}"> Create New Borrowing</a>
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
            <th>Property</th>
            <th>Department</th>
            <th>Start</th>
            <th>End</th>
            <th>Status</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($borrowings as $borrowing)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $borrowing->property->name }}</td>
                <td>{{ $borrowing->department->name }}</td>
                <td>{{ $borrowing->start_at}}</td>
                <td>{{ $borrowing->end_at}}</td>
                <td>
                    <form action="{{ route('borrowings.destroy', $borrowing->id) }}" method="POST">
                        {{-- <a class="btn btn-info" href="{{ route('departments.show', $department->id) }}">Show</a> --}}
                        @can('borrowing-edit')
                            <a class="btn btn-primary" href="{{ route('borrowings.edit', $borrowing->id) }}">Edit</a>
                        @endcan
                        @csrf
                        @method('DELETE')
                        @can('borrowing-delete')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        @endcan
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {!! $borrowings->links() !!}
@endsection
