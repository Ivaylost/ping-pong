@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <form method="POST" action="{{route('update_table', [$table->id, $selected_date])}}">
                    @csrf
                    <div class="panel">
                        <div class="panel-title">
                            <h4>Table: {{$table->name}}</h4>
                            <h4>Selected date: {{$selected_date}}</h4>
                        </div>
                        <div class="panel-body">
                            <table class="table table-hover bravo-form-item">
                                <thead>
                                <tr>
                                    <th width="60px"><input type="checkbox" class="check-all"></th>
                                    <th>{{__("Time span:")}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($dates) > 0)
                                    @foreach($dates as $key => $date)
                                        <tr>
                                            <td><input type="checkbox" class="check-item" name="ids[]"
                                                       @if($date) checked @endif  value="{{$key}}">
                                            </td>
                                            <td class="title">
                                                <p> {{ $key }}</p>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="3">{{__("No data")}}</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="">
                        <button class="btn btn-primary" type="submit">{{__("Save")}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection


