@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="table-responsive">
            <table class="table">
                @foreach( $vacant as $vacant_s )
                    <tr>
                        <td class="">
                            <a href="#" class="list-group-item list-group-item-action">{{ $vacant_s->date }}</a>
                            <a href="#" class="list-group-item list-group-item-action">{{ $vacant_s->status }}</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
