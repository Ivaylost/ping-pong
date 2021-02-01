@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row">
            @if (Auth::user()->role == 0)
                <div class="col-md-4 mb40">
                    <div class="panel">
                        <div class="panel-title">{{__("Add table")}}</div>
                        <div class="panel-body">
                            <form action="{{route('create_table')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <input type="text" value="name" placeholder="{{__("Table name")}}" name="name"
                                           class="form-control">
                                </div>
                                <div class="">
                                    <button class="btn btn-primary" type="submit">{{__("Add new")}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-md-8">
                <div class="panel">
                    <div class="panel-title">{{__("All tables")}}</div>
                    <div class="panel-body">
                        <form method="get" class="bravo-form-item">
                            @csrf
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th width="60px"><input type="checkbox" class="check-all"></th>
                                    <th>{{__("Name")}}</th>
                                    <th class="">{{__("Actions")}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($tables) > 0)
                                    @foreach($tables as $table)
                                        <tr>
                                            <td><input type="checkbox" class="check-item" name="ids[]"
                                                       value="{{$table->id}}">
                                            </td>
                                            <td class="title">
                                                {{$table->name}}
                                            </td>
                                            <td>
                                                <a href="{{route('date',['id'=>$table->id])}}"
                                                   class="btn btn-primary btn-sm"><i
                                                        class="fa fa-edit"></i> {{__('Reservation')}} </a>
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
