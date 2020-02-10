@extends('layouts.master')
@section('head_scripts')
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css"/>
@endsection
@section('content')
    <form method="POST" action="{{ route('vacant.edit',['id' => \Auth::user()->id,'vacant' => $vacant->id ])}}" >
        @csrf
        <div class="container">

            <div class="form-group">
                <h2>{{ __('vacant.show') }}</h2>
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
                <button type="submit" class="btn btn-primary my-1">
                    {{ __('vacant.edit_submit') }}
                </button>
            </div>

        </div>
    </form>
@endsection
