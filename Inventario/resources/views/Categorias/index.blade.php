@extends('backend.layouts.master')

@section('title')
Categorias - Admin Panel
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
@endsection

@section('admin-content')

<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Categorias</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><span>All Categorias</span></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6 clearfix">
            @include('backend.layouts.partials.logout')
        </div>
    </div>
</div>

<div class="main-content-inner">
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title float-left">Categorias</h4>
                    <p class="float-right mb-2">
                        <a class="btn btn-primary text-white" href="{{ route('admin.categorias.create') }}">Create New Category</a>
                    </p>
                    <div class="clearfix"></div>
                    <div class="data-tables">
                        @include('backend.layouts.partials.messages')
                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th width="5%">Sl</th>
                                    <th width="10%">Nombre</th>
                                    <th width="10%">Marca</th>
                                    <th width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($categorias as $categoria)
                               <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $categoria->nombre }}</td>
                                    <td>{{ $categoria->marca }}</td>
                                    <td>
                                        <a class="btn btn-success text-white" href="{{ route('admin.categorias.edit', $categoria->id) }}">Edit</a>
                                        <a class="btn btn-danger text-white" href="{{ route('admin.categorias.destroy', $categoria->id) }}"
                                        onclick="event.preventDefault(); document.getElementById('delete-form-{{ $categoria->id }}').submit();">
                                            Delete
                                        </a>

                                        <form id="delete-form-{{ $categoria->id }}" action="{{ route('admin.categorias.destroy', $categoria->id) }}" method="POST" style="display: none;">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                               @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
     <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
     <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
     <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
     
     <script>
         if ($('#dataTable').length) {
            $('#dataTable').DataTable({
                responsive: true
            });
         }
     </script>
@endsection
