@extends('layouts.master')
@section('content')
    <div class="container">
        <section class="user_show_wrapper">
            <div class="status_message">
                {{ session('my_status') }}
            </div>
            <ul class="user_info">
                <div class="vacant-link">
                    <p>空いてる日を登録する！</p>
                    <a href="{{ route('vacant.create',['id' => \Auth::user()->id])}}">登録フォーム</a>
                </div>
                <div class="share-link">
                    <p>空いてる日をシェアする！</p>
                    <a href="#">共有用リンク</a>
                </div>
            </ul>
        </section>
    </div>
@endsection
