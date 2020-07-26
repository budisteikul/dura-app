@extends('layouts.app')

@section('content')
<style>
    #dataTableBuilder thead {
    display: none;
}
</style>
<script type="text/javascript">
function TOGGLE()
    {
        var table = $('#dataTableBuilder').DataTable();
        $.ajax({
        data: {
            "_token": $("meta[name=csrf-token]").attr("content"),
        },
        type: 'POST',
        url: "/home"
        }).done(function( data ) {
            if(data.id=="1")
            {
                table.ajax.reload( null, false );
            }
        });
    }
</script>
<div class="container">
    <div class="row justify-content-center">
        



        <div class="col-md-8 mb-2">
            <div class="card">
                <div class="card-header"><i class="fas fa-video"></i> CAMERA</div>
                <div class="card-body">
                    <div class="embed-responsive embed-responsive-4by3">
                        <iframe class="embed-responsive-item" src=""></iframe>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-4 mb-2">
            <div class="card">
                <div class="card-header"><i class="fas fa-lightbulb"></i> LAMPU</div>
                <div class="card-body">
                    
                        
                        {!! $dataTable->table(['class'=>'table table-responsive w-100 d-block d-md-table']) !!}

                </div>
            </div>
        </div>


    </div>
</div>

{!! $dataTable->scripts() !!}
@endsection
