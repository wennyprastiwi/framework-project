@extends('layouts.back-end_layout')

@section('title')
    Master Contact
@endsection

@section('content')

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Master Contact</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-plus-square fa-sm text-white-50"></i> Tambah</a>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Contact</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Email</th>
                                            <th>Instagram</th>
                                            <th>Twitter</th>
                                            <th>LinkedIn</th>
                                            <th>Facebook</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>egawahyu20@gmail.com</td>
                                            <td>@egawahyu20</td>
                                            <td>@egawahyu20</td>
                                            <td>Ega Wahyu</td>
                                            <td>Ega Wahyu</td>
                                            <td>
                                                <a class="btn btn-primary">Detail</a>
                                                <a class="btn btn-info">Edit</a>
                                                <a class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

@endsection

@section('pagejs')

    <!-- Page level plugins -->
    <script src="sb-admin/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="sb-admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="sb-admin/js/demo/datatables-demo.js"></script>

@endsection

