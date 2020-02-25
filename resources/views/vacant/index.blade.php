@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="calendar">
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
                <a href="{{ route('vacant.index',['id' => \Auth::user()->id])}}/{{  $data['prev'] }}"><div>prev</div></a>
            @endif
            @if (!empty($data['next']))
                <a href="{{ route('vacant.index',['id' => \Auth::user()->id])}}/{{  $data['next'] }}"><div>next</div></a>
            @endif
        </div>
    </div>
@endsection
