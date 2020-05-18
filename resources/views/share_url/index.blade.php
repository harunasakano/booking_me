@extends('layouts.master')
@section('head_scripts')
@endsection
@section('body_scripts')
@endsection
@section('content')
    @csrf
    <div class="container">
        <div class="form-group">
            <h3>{{ Auth::user()->name }}さんの共有用URL</h3>
        </div>
        <div class="form-group">
            <label class="my-1 mr-2">{{ __('user_share.exit_url') }}</label>
            <p>{{ url('/') . '/' . 'guest/' . $user_vacant_share_url->url }}</p>
        </div>

        <div class="form-group">
            <label class="my-1 mr-2">{{ __('user_share.status') }}</label>
            <p>{{ $share_url_status[$user_vacant_share_url->status] }}</p>
        </div>

        <div class="form-group">
            <label class="my-1 mr-2">{{ __('user_share.updated_at') }}</label>
            <p>{{ $user_vacant_share_url->updated_at }}</p>
        </div>

        <div class="form-group">
            <form
                action="{{ action('UserVacantShareUrlController@destroy',['id' => \Auth::user()->id,'share_url' => $user_vacant_share_url->id ])}}"
                id="form_{{ $user_vacant_share_url->id }}" method="post">
                {{ csrf_field() }}
                {{ method_field('delete') }}
                <a href="#" data-id="{{ $user_vacant_share_url->id }}" onclick="deletePost(this);">
                    <button type="button" class="btn btn-primary my-1">
                        {{ __('vacant.destroy_submit') }}
                    </button>
                </a>
            </form>
        </div>

    </div>
    <script>
        function deletePost(e) {
            'use strict';

            if (confirm('このURLを削除しますか?')) {
                document.getElementById('form_' + e.dataset.id).submit();
            }
        }
    </script>
@endsection
