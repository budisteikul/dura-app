@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        



        <div class="col-md-8 mb-2">
            <div class="card">
                <div class="card-header"><i class="fas fa-video"></i> CAMERA</div>
                <div class="card-body">
                    <div class="embed-responsive embed-responsive-4by3">
                        <iframe class="embed-responsive-item" src="http://192.168.0.2:8765/picture/1/frame/"></iframe>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-4 mb-2">
            <div class="card">
                <div class="card-header"><i class="fas fa-lightbulb"></i> LAMPU</div>
                <div class="card-body">
                    
                        <button class="btn btn-success btn-block">ON</button>
                    
                </div>
            </div>
        </div>


    </div>
</div>
@endsection
