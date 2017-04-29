@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">CONTRIBUTORS</div>

                <div class="panel-body">
                <div>{{$note->note_title}} </div>
                <div>
                    <form class="form-inline" role="form" method="POST" action="{{ url('/searchc/') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name='id_note' value='{{$note->id}}'>
                      <div class="form-group">
                        <label for="keyword">Find your friends:</label>
                        <input type="text" class="form-control" id="keyword" name="keyword">
                      </div>
                      <button type="submit" class="btn btn-default"><i class="fa fa-btn fa-search"></i> Search</button>
                    </form>
                </div>
                    <table class='table table-hover'>
                        <thead>
                            <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>email</th>
                            <th>delete?</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contributors as $contributor)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$contributor->name}}</td>
                                    <td>{{$contributor->email}}</td>
                                    <td>
                                    @if($contributor->role!=1)
                                    <a href='{{URL::to("/deletec/".$contributor->id_user_to_note)}}' class="confirm">delete</a>
                                    @else
                                        owner
                                    @endif
                                    </td>
                                </tr>
                            @endforeach()
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">    
$(".confirm").on("click", function (e) {
    // Init
    var self = $(this);
    var link = $(this).attr('href');
    e.preventDefault();

    // Show Message        
    bootbox.confirm("Are you sure?", function (result) {
        if (result) {                
            self.off("click");
            self.click();
            document.location.href = link;
        }
    });
});
@endsection
