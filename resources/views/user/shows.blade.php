@extends('layouts.master')
@section('content')
    <div class="container">
        <section class="user_show_wrapper">
            <ul class="user_info">
                <div class="vacant-link">
                    <a href="{{ route('vacant.create',['id' => \Auth::user()->id])}}">空いてる日を登録する！</a>
                </div>
            </ul>
        </section>
    </div>
@endsection
