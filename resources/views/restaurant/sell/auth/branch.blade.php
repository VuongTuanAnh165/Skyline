@extends('restaurant.sell.auth.master')
@section('title', 'Chọn chi nhánh')
@section('addcss')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <style>
        .select2-container .select2-selection--single {
            height: 31px;
        }
        .select2-container {
            width: auto !important;
        }
        .restaurant {
            width: 100%;
            display: flex;
            align-items: center;
        }
        .restaurant img {
            width: 5rem;
        }
    </style>
@stop
@section('content')
<div class="col-md-6 d-flex justify-content-center flex-column px-0">
    <div class="col-lg-6 mx-auto box-shadow">
        <h3 class="mb-2">Phần mềm bán hàng Sky Line</h3>
        <div class="restaurant mb-2">
            <img src="{{ asset('storage/'.$restaurant->logo) }}">
            <h3>{{ $restaurant->name }}</h3>
        </div>
        <p class="mb-4">Chọn chi nhánh để tiếp tục</p>
        <div>
            {{ csrf_field() }}
            <div class="d-flex align-items-center select-branch">
                <div class="mr-3 bg-light rounded p-2 osahan-icon"><i class="mdi mdi-source-branch"></i></div>
                <div class="w-100">
                    <p class="mb-0 small font-weight-bold text-dark">Chi nhánh</p>
                    <select name="branch_id" class="branch_id form-control">
                        <option></option>
                        @foreach($branches as $branch)
                        <option value="{{$branch->id}}">Chi nhánh số: {{ $branch->name }} (Địa chỉ: {{ $branch->address }})</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-3 mt-4">
                <button id="btn-choose-branch" class="btn btn-primary btn-block mb-3">Trang chủ</button>
                <a href="" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();" 
                    class="btn btn-light btn-block mb-2">
                    Trở về
                </a>
                <form id="logout-form" action="{{ route('sell.post.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
@stop
@section('addjs')
    @if (session('success') || session('error'))
        @include('restaurant.sell.partials.script.toastr')
    @endif
    @include('restaurant.sell.auth.script')
@stop