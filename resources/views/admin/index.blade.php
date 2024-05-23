@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        {{-- @forelse($admins as $admin)
            <h3>{{ $admin->email }}</h3>
        @empty
        @endforelse --}}
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="/admin/dashboard">Dashboard</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <!-- Sales Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card portocategory-card">
                            <div class="card-body">
                                <h5 class="card-title">Users</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"
                                        style="color: #4154f1;  background: #f6f6fe;">
                                        <i class="bi bi-menu-button-wide"></i>
                                    </div>
                                    <div class="ps-3">
                                        {{-- <h6>{{ $porto_categories }}</h6> --}}
                                        <span class="text-muted small pt-2 ps-1">List Users</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card porto-card">
                            <div class="card-body">
                                <h5 class="card-title">Mood Configuration</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"
                                        style="color: #2eca6a;  background: #e0f8e9;">
                                        <i class="bi bi-pc-display-horizontal"></i>
                                    </div>
                                    <div class="ps-3">
                                        {{-- <h6>{{ $portos }}</h6> --}}
                                        <span class="text-muted small pt-2 ps-1">Configurations</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Revenue Card -->

                    <!-- Customers Card -->
                    <div class="col-xxl-4 col-xl-6">
                        <div class="card info-card blogcategory-card">
                            <div class="card-body">
                                <h5 class="card-title">Questions</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"
                                        style="color: #ff771d;  background: #ffecdf;">
                                        <i class="bi bi-tags"></i>
                                    </div>
                                    <div class="ps-3">
                                        {{-- <h6>{{ $blog_categories }}</h6> --}}
                                        <span class="text-muted small pt-2 ps-1">List Questions</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Customers Card -->
                    <div class="col-xxl-4 col-xl-6">
                        <div class="card info-card blog-card">
                            <div class="card-body">
                                <h5 class="card-title">Mood</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"
                                        style="color: #9477fc;  background: #e2cffc;">
                                        <i class="bi bi-book"></i>
                                    </div>
                                    <div class="ps-3">
                                        <span class="text-muted small pt-2 ps-1">List Mood</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
