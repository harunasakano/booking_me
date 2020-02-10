@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="top_content">
            <div class="status_message">
                {{ session('my_status') }}
            </div>
            <div class="top_title">
                <h1>Booking Me</h1>
                <div class="heart"></div>
            </div>
        </div>
    </div>
@endsection
