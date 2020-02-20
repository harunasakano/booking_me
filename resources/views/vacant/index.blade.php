@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="calendar">
            <table class="table">
                <thead>
                <tr>
                    <th>月</th>
                    <th>火</th>
                    <th>水</th>
                    <th>木</th>
                    <th>金</th>
                    <th>土</th>
                    <th>日</th>
                </tr>
                </thead>
                <tbody>

                {{--1行目--}}
                <tr>
                    <td>1</td>
                    <td>2</td>
                    <td>3</td>
                    <td>4</td>
                    <td>5</td>
                    <td>6</td>
                    <td>7</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
