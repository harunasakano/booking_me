@extends('layouts.master')
@section('head_scripts')
    <link rel="stylesheet" href="http://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet"
          href="http://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css"/>
@endsection
@section('body_scripts')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script type="text/javascript"
            src="http://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
@endsection
@section('content')
    <form method="POST" action="{{ route('vacant.update',['id' => \Auth::user()->id,'vacant' => $vacant->id ])}}">
        @csrf
        <input name="_method" type="hidden" value="PUT">
        <div class="container">

            <div class="form-group">
                <h2>{{ __('vacant.edit') }}</h2>
            </div>

            <div class="form-group">
                <label for="date_form">空き日選択</label>
                <div class="input-group date" id="my_datetimepicker" data-target-input="nearest">
                    <input type="text" id="date_form" name="date" class="form-control datetimepicker-input"
                           data-target="#my_datetimepicker" placeholder="日時を選択"/>
                    <div class="input-group-append" data-target="#my_datetimepicker" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="my-1 mr-2" for="status_form">{{ __('vacant.status') }}</label>
                <select class="custom-select" name="status" id="status_form">
                    @foreach( $vacant_status as $status_word)
                        <option
                            value={{ $status_word }} @if (!empty($vacant->status) && $vacant->status == $status_word ) selected @endif >
                            {{ $status_word }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary my-1">
                    {{ __('vacant.update_submit') }}
                </button>
            </div>

        </div>
        <script>

            $(function () {
                $('#my_datetimepicker').datetimepicker({
                    language: 'ja',
                    format: "YYYY/MM/DD HH:00",
                    autoclose: true,
                    sideBySide: true,
                    minDate: new Date(),
                    defaultDate: "{{ Session::get("vacant_old_date") }}",
                });
            });

        </script>
    </form>
@endsection
