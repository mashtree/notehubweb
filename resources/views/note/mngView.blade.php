@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @if(isset($contributor))
                        CONTRIBUTOR
                    @else
                        NOTES
                    @endif
                </div>

                <div class="panel-body">
                @if(isset($contributor))
                    <div><a href='{{URL::to("/contributor")}}'>< back</a></div>
                    <div>{{$contributor[0]->name}} | {{$contributor[0]->email}}</div>
                @else
                    <div><a href='{{URL::to("/contributor")}}'>< list of contributors</a></div>
                @endif
                    <table class='table table-hover'>
                        <thead>
                            <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($notes as $note)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$note->note_title}}</td>
                                    <td>{{$note->description}}</td>
                                    <td><a href='{{URL::to("/delete/".$note->id)}}' class="confirm">delete</a> | 
                                    <a href='{{URL::to("/update/".$note->id)}}'>update</a> | 
                                    <a href='{{URL::to("/contributor/".$note->id)}}'>contributor</a>
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
</script>
@endsection
