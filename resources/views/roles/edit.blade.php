@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Role</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('roles.index') }}">Back</a>
            </div>
        </div>
    </div>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {!! Form::model($role, ['method' => 'PATCH', 'route' => ['roles.update', $role->id]]) !!}
    <div class="row">
        <?php
        $abc = '';
        $len = count($permission);
        ?>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Permission:</strong>
                <br />
                <div class="row">
                    @foreach ($permission as $key => $value)
                        <?php
                        if ($key === 0) {
                            echo '<div class="col-lg-4">';
                        }
                        
                        if ($abc != substr($value->name, 0, strpos($value->name, '-')) && $key === 0) {
                            $abc = substr($value->name, 0, strpos($value->name, '-'));
                        
                            echo '<b>' . strtoupper($abc) . '</b><div class="block">';
                        } elseif ($abc != substr($value->name, 0, strpos($value->name, '-')) && $key !== 0) {
                            $abc = substr($value->name, 0, strpos($value->name, '-'));
                            echo '</div></div><div class="col-lg-4">';
                            echo '<b>' . strtoupper($abc) . '</b><div class="block">';
                        }
                        ?>
                        <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, ['class' => 'name']) }}
                            {{ $value->name }}</label>
                        <br />
                        <?php
                        if ($key === $len - 1) {
                            echo '</div></div>';
                        }
                        ?>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
