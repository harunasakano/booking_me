@extends('layouts.master')
@section('head_scripts')
@endsection
@section('body_scripts')
@endsection
@section('content')

    <form method="POST" action="{{ route('share_url.store',['id' => Auth::user()->id,])}}">
        @csrf
        <div class="container">
            <div class="form-group">
                <h2>{{ __('user_share.doing_share') }}</h2>
                <p>あなたの空き日共有用のURLを発行します。</p>
                <p>共有したお相手がURLを開くと、あなたの空き日の閲覧、予約が可能になります。</p>
                <p>URLはランダムな英数字の組み合わせで決まります。 </p>
                後で変更・削除・URLごと非公開にする設定が可能です。</p>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary my-1">
                    {{ __('user_share.submit') }}
                </button>
            </div>

        </div>
    </form>
@endsection
