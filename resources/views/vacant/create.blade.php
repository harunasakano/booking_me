@extends('layouts.master')
@section('head_scripts')
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"/>
@endsection
@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment-with-locales.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>

    <form method="POST" action="{{ route('vacant.store',['id' => \Auth::user()->id]) }}">
        @csrf
        <div class="container">
            <div class="register-form-group">
                <div class='input-group date' id='datetimepicker1'>
                    <h5>{{ __('vacant.vacant') }}</h5>
                    <input type='text' name='date' class="form-control"/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
                <div class="vacant_date_status">
                    <h5>{{ __('vacant.status') }}</h5>
                    <select name="status">
                        @foreach( $vacant_status as $status_word)
                            <option value={{ $status_word }}>{{ $status_word }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="submit">
                    {{ __('vacant.submit') }}
                </button>

            </div>
        </div>

        <script>
            jQuery(function ($) {
                $('#datetimepicker1').datetimepicker();
            });
        </script>
    </form>
@endsection
