@extends('layouts.app')
@section('content')
    <div class="content-body">
        <div class="row">
            <div class="col-12">
                @include('flash::message')
                <div class="clearfix"></div>
                <div class="card">
                    <div class="border-left-light-blue border-left-6 box-shadow-1 rounded">
                        <div class="card-content ">
                            <div class="card-body card-dashboard">
                                <div class="row">
                                    <div class="col-10 media-body mb-2">
                                        <div class="content-header-left breadcrumb-new">
                                            <span class="content-header-title mb-0 d-inline-block font-medium-4"><b>Relawan</b></span>
                                            <div class="breadcrumbs-top d-inline-block">
                                                <div class="breadcrumb-wrapper">
                                                    @include('layouts.breadcrumb')
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="card mb-1">
                                        <div class="card-header">
                                            <h4 class="card-title">Import Data</h4>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">
                                                <ul class="list-unstyled">
                        
                                                    <li><i class="icon-disk mr-1"></i>Hanya unggah file dengan ekstensi(<strong>CSV, XLS, XLSX</strong>).</li>
                        
                                                    <li><i class="icon-disk mr-1"></i>Anda bisa mendownload <a href="{{route('downloadFormat')}}"><u>disini</u></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{ route('relawans.import') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-md-6 ml-2">
                                        <input type="file" name="file" class="form-control">
                                    </div>
                                    <div class="form-actions center">
                                        <button class="btn btn-info"><i class="icon-cloud-upload"></i> Import Data</button>
                                    </div>  
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

