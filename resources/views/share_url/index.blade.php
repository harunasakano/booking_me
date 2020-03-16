@extends('layouts.master')
@section('head_scripts')
@endsection
@section('body_scripts')
@endsection
@section('content')
    @csrf
    <div class="container">
        <div class="form-group">
            <h3>{{ Auth::user()->name }}さんの共有用URL情報</h3>
        </div>
        <div class="form-group">
            <label class="my-1 mr-2">{{ __('user_share.exit_url') }}</label>
            <p>{{ $user_vacant_share_url->url }}</p>
        </div>

        <div class="form-group">
            <label class="my-1 mr-2">{{ __('user_share.status') }}</label>
            <p>{{ $share_url_status[$user_vacant_share_url->status] }}</p>
        </div>

        <div class="form-group">
            <label class="my-1 mr-2">{{ __('user_share.updated_at') }}</label>
            <p>{{ $user_vacant_share_url->updated_at }}</p>
        </div>
    </div>
@endsection
