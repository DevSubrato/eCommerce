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
                    Add Category
                </div>


                <div class="card-body">
                    <div class="col-lg-6  offset-lg-3 col-md-8 ">
                        <form action="{{route('about.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" name="image" class="form-control"
                                            placeholder="enter team name here">
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" name="name" class="form-control"
                                                    placeholder="enter team name here">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Designation</label>
                                                <input type="text" name="designation" class="form-control"
                                                    placeholder="enter team name here">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Facebook</label>
                                                <input type="facebook" name="facebook" class="form-control"
                                                    placeholder="enter team facebook url">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Twitter</label>
                                                <input type="twitter" name="twitter" class="form-control"
                                                    placeholder="enter team twitter url">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Instagram</label>
                                                <input type="instagram" name="instagram" class="form-control"
                                                    placeholder="enter team instagram url">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Google</label>
                                                <input type="google" name="google" class="form-control"
                                                    placeholder="enter team google url">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary"> Add</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
