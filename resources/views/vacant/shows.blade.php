@extends('layouts.master')
@section('head_scripts')
    <link rel="stylesheet"
          href="http://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css"/>
@endsection
@section('content')
    <div class="container">

        <div class="form-group">
            <form action="{{ action('VacantController@destroy',['id' => \Auth::user()->id,'vacant' => $vacant->id ]) }}"
                  id="form_{{ $vacant->id }}" method="post">
                {{ csrf_field() }}
                {{ method_field('delete') }}
                <h2>{{ __('vacant.show') }}</h2>
                <a href="#" data-id="{{ $vacant->id }}" onclick="deletePost(this);">
                    <div class="delete-icon"><span></span></div>
                </a>
            </form>
        </div>

        <div class="form-group">
            <label for="vacant_date">空き日</label>
            <div id="vacant_date">{{ $vacant->date }}</div>
        </div>

        <div class="form-group">
            <label class="my-1 mr-2" for="vacant_status">{{ __('vacant.status') }}</label>
            <div id="vacant_status">{{ $vacant->status }}</div>
        </div>

        <div class="form-group">
            <a href="{{ route('vacant.edit',['id' => \Auth::user()->id,'vacant' => $vacant->id ])}}">
                <button type="button" class="btn btn-primary my-1">
                    {{ __('vacant.edit_submit') }}
                </button>
            </a>
        </div>
    </div>
    </form>
    <script>
        function deletePost(e) {
            'use strict';

            if (confirm('この日を削除しますか?')) {
                document.getElementById('form_' + e.dataset.id).submit();
            }
        }
    </script>
@endsection
