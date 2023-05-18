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
                                    @hasanyrole('admin-kandidat-free|admin-kandidat-premium|relawan-free|relawan-premium')
                                    <div class="col-2 text-right">
                                        <a href="{{ route('importRelawan') }}" class="btn btn-sm btn-info">Import Excel
                                        </a>
                                    </div>
                                    <div class="col-2 text-right">
                                        <a href="{{ route('relawans.create') }}" class="btn btn-sm btn-green">Tambah Data
                                        </a>
                                    </div>
                                    @endhasanyrole
                                </div>
                                @if(auth()->user()->hasRole('super-admin'))
                                @include('relawans.table-superadmin')
                                @elseif(auth()->user()->hasRole('admin-kandidat-premium'))
                                @include('relawans.table-adminkandidat')
                                @elseif(auth()->user()->hasRole('admin-kandidat-free'))
                                @include('relawans.table-adminkandidatfree')
                                @else
                                @include('relawans.table-relawan')
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
