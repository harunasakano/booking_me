@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="top_content">
            <div class="status_message">
                {{ session('my_status') }}
            </div>
            <section class="top_text">
                <h1>Booking Me</h1>
                <div class="heart"></div>
            </section>
        </div>
    </div>
@endsection
