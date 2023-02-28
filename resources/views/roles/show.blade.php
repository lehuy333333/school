@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Role</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $role->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Permissions:</strong>
                @if (!empty($rolePermissions))
                    <div class="row">
                        <?php
                        $abc = '';
                        $len = count($rolePermissions);
                        ?>

                        @foreach ($rolePermissions as $key => $v)
                            <?php
                            if ($key === 0) {
                                echo '<div class="col-lg-4">';
                            }
                            
                            if ($abc != substr($v->name, 0, strpos($v->name, '-')) && $key === 0) {
                                $abc = substr($v->name, 0, strpos($v->name, '-'));
                            
                                echo '<b>' . strtoupper($abc) . '</b><div class="block">';
                            } elseif ($abc != substr($v->name, 0, strpos($v->name, '-')) && $key !== 0) {
                                $abc = substr($v->name, 0, strpos($v->name, '-'));
                                echo '</div></div><div class="col-lg-4">';
                                echo '<b>' . strtoupper($abc) . '</b><div class="block">';
                            }
                            ?>
                            <label class="label label-success">{{ $v->name }},</label>
                            <?php
                            if ($key === $len - 1) {
                                echo '</div></div>';
                            }
                            ?>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
