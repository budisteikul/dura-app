@extends('layouts.app')

@section('content')

<script type="text/javascript">
$(function() {
     $('#button').html('{!! $button !!}');
  });

function TOGGLE()
    {

        //var table = $('#dataTableBuilder').DataTable();
        $.ajax({
        data: {
            "_token": $("meta[name=csrf-token]").attr("content"),
        },
        type: 'POST',
        url: "/toggle"
        }).done(function( data ) {

            if(data.id=="1")
            {
                $('#button').html(data.message);
                //table.ajax.reload( null, false );
            }
        });
    }
</script>
<div class="container">
    <div class="row justify-content-center">
        



        <div class="col-md-8 mb-2">
            <div class="card bg-dark text-white">
                <div class="card-header"><i class="fas fa-video"></i> CAMERA</div>
                <div class="card-body">
                    <div class="embed-responsive embed-responsive-4by3">
                        <iframe class="embed-responsive-item" src="{!! $ipcamera !!}
"></iframe>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-4 mb-2">
            <div class="card bg-dark text-white">
                <div class="card-header"><i class="fas fa-lightbulb"></i> LAMPU</div>
                <div class="card-body">
                        <div id="button"></div>
                </div>
            </div>
        </div>


    </div>
</div>

@endsection
