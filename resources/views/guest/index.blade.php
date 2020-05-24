@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="calendar">
            <div class="status_message">
                {{ session('my_status') }}
            </div>
            <table class="table">
                <h5 class="">{{ $data['head'] }}</h5>
                <thead>
                <tr>
                    <th>月</th>
                    <th>火</th>
                    <th>水</th>
                    <th>木</th>
                    <th>金</th>
                    <th>土</th>
                    <th>日</th>
                </tr>
                </thead>
                <tbody>
                {!! $data['html'] !!}
                </tbody>
            </table>
            @if (!empty($data['prev']))
                <div class="prev_link">
                    <a href="{{ route('guest.vacant',['param' => $param])}}/{{  $data['prev'] }}">Back</a>
                </div>
            @endif
            @if (!empty($data['next']))
                <div class="next_link">
                    <a href="{{ route('guest.vacant',['param' => $param])}}/{{  $data['next'] }}">Next</a>
                </div>
            @endif
        </div>
    </div>
@endsection
