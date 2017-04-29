@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">CONTRIBUTORS</div>

                <div class="panel-body">
                <div>{{$note->note_title}} </div>
                    <table class='table table-hover'>
                        <thead>
                            <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>email</th>
                            <th>+</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contributors as $contributor)

                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$contributor->name}}</td>
                                    <td>{{$contributor->email}}</td>
                                    <td><a href='{{URL::to("addc/".$contributor->id."/".$note->id)}}'><i class="fa fa-btn fa-plus-circle"></i></a></td>
                                </tr>
                            @endforeach()
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
