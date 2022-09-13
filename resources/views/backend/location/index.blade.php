@extends('layouts.app')

@section('breadcrumb')
<div class="page-title-box">
    <h4 class="page-title">Starter </h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    </ol>
</div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row ">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                        Location
                </div>
                    
                <div class="card-body">
                    <form action="{{route('location.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                          <label>Location Name</label>
                          <select name="countries[]" multiple="multiple" id="country_dropdown" class="form-control">
                            @foreach ($countries as $country)
                            <option {{($country->status == 'active')? 'selected':''}} value="{{$country->id}}">{{$country->name}}</option>
                            @endforeach
                          </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Location</button>
                      </form>
                </div>   
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_script')
    <script>
        $(document).ready(function() {
    $('#country_dropdown').select2();
    });
    </script>
@endsection