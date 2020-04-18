@extends('layouts.master')
@section('head_scripts')
@endsection
@section('body_scripts')
@endsection
@section('content')

        <div class="container">
            <div class="form-group">
                <form action="{{ action('UserVacantShareUrlController@destroy',['id' => \Auth::user()->id,'share_url' => $user_vacant_share_url->id ]) }}" id="form_{{ $user_vacant_share_url->id }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                    <h3>{{ Auth::user()->name }}さんの共有用URL編集</h3>
                    <a href="#" data-id="{{ $user_vacant_share_url->id }}" onclick="deletePost(this);">
                        <div class="delete-icon"><span></span></div>
                    </a>
                    <p>共有用URLを変更すると、新たにURLが発行され、現在の共有用URLは無効となります。</p>
                </form>
            </div>
            <div class="form-group">
                <label class="my-1 mr-2">{{ __('user_share.exit_url') }}</label>
                <p>{{ $user_vacant_share_url->url }}</p>
                <select class="custom-select" name="status" id="status_form">
                    <option value="">URLは変更しない</option>
                    <option value="url_update">URLを更新する</option>
                </select>
            </div>

            <div class="form-group">
                <label class="my-1 mr-2" for="status_form">{{ __('user_share.status') }}</label>
                <select class="custom-select" name="status" id="status_form">
                    @foreach( $share_url_status as $status_word)
                        <option
                            value={{ $status_word }} @if($status_word == $user_vacant_share_url->status) selected @endif>
                            {{ $status_word }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="my-1 mr-2">{{ __('user_share.updated_at') }}</label>
                <p>{{ $user_vacant_share_url->updated_at }}</p>
            </div>
        </div>
    <script>
        function deletePost(e) {
            'use strict';

            if (confirm('共有用URLを削除しますか?')) {
                document.getElementById('form_' + e.dataset.id).submit();
            }
        }
    </script>
@endsection
