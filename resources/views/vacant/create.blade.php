@extends('layouts.master')
@section('head_scripts')
    <link rel="stylesheet" href="http://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css"/>
@endsection
@section('body_scripts')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
@endsection
@section('content')
    <form method="POST" action="{{ route('vacant.store',['id' => \Auth::user()->id])}}" autocomplete="off">
        @csrf
        <div class="container">
            <div class="form-group">
                <div class="input-group date" id="my_datetimepicker" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#my_datetimepicker"
                           placeholder="日時を選択"/>
                    <div class="input-group-append" data-target="#my_datetimepicker" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div>{{ __('vacant.status') }}</div>
                <select name="status">
                    @foreach( $vacant_status as $status_word)
                        <option value={{ $status_word }}>{{ $status_word }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <button type="submit" class="submit">
                    {{ __('vacant.submit') }}
                </button>
            </div>

        </div>
        <script>
            $(function () {
                $('#my_datetimepicker').datetimepicker({
                    format: 'YYYY年MM月DD日HH時',
                    autoclose: true,
                    language: 'ja',
                    sideBySide: true,
                    minDate: Date(),
                });
            });
        </script>
    </form>

@endsection
