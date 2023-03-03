@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Borrowing</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('home') }}"> Back</a>
            </div>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('borrowings.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-xs-8 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Date:</strong>
                    <input type="date" name="date" class="form-control" disabled
                        value="{{ \Carbon\Carbon::parse($date_pick)->format('Y-m-d') }}">
                </div>
                <div class="form-group">
                    <strong>Department:</strong>
                    {!! Form::select('department_id', [null=>'Please Select'] + $departments, [], ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <strong>Property:</strong>
                    <select id="properties" class="form-control" name="property_id"></select>
                </div>
                <div class="form-group">
                    <strong>Start time:</strong>
                    <input type="time" name="start_time" class="form-control">
                </div>
                <div class="form-group">
                    <strong>End time:</strong>
                    <input type="time" name="end_time" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection
