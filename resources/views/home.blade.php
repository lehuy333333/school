@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">{{ __('Calendar') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="month">
                                <ul>
                                    <li>{{ \Carbon\Carbon::now()->format('F') }}<br><span
                                            style="font-size:18px">{{ \Carbon\Carbon::now()->year }}</span></li>
                                </ul>
                            </div>
                            <div class="weekdays">Mo</div>
                            <div class="weekdays">Tu</div>
                            <div class="weekdays">We</div>
                            <div class="weekdays">Th</div>
                            <div class="weekdays">Fr</div>
                            <div class="weekdays">Sa</div>
                            <div class="weekdays">Su</div>
                            @php
                                $btn_ennable = 'disabled';
                                $start = \Carbon\Carbon::today()->startOfMonth();
                                $end = \Carbon\Carbon::today()->endOfMonth();
                                
                                $date = $start;
                                
                                for ($i = 1; $i < $date->dayOfWeek; $i++) {
                                    echo '<div class="days"></div>';
                                }
                                while ($date <= $end) {
                                    if ($date->day === \Carbon\Carbon::now()->day) {
                                        echo '<div class="days"><a class="btn active" href="">' . $date->day . '</a></div>';
                                        $btn_ennable = '';
                                    } else {
                                        echo '<div class="days" ><a class="btn '.$btn_ennable.'" href="" >' . $date->day . '</a></div>';
                                    }
                                    $date->addDays(1);
                                }
                            @endphp 
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        ul {
            list-style-type: none;
        }

        .month {
            width: 100%;
            background: #1abc9c;
            text-align: center;
        }

        .month ul {
            margin: 0;
            padding: 0;
        }

        .month ul li {
            color: white;
            text-transform: uppercase;
        }

        .weekdays {
            width: 14.28%;
            background-color: #ddd;
        }

        .days {
            width: 14.28%;
            height: 75px;
            border: 1px !important
        }

        .days .active {
            background: #1abc9c;
            color: white !important
        }
    </style>
@endsection
