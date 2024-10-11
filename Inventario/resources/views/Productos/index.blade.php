@extends('backend.layouts.master')

@section('title')
    Productos - Panel de Administración
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
                <h4 class="page-title pull-left">Productos</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><span>Todos los Productos</span></li>
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
                    <h4 class="header-title float-left">Lista de Productos</h4>
                    <p class="float-right mb-3">
                        <a class="btn btn-primary text-white" href="{{ route('admin.productos.create') }}">Crear Nuevo Producto</a>
                    </p>
                    <div class="clearfix"></div>
                    <div class="data-tables">
                        @include('backend.layouts.partials.messages') <!-- Include flash messages -->
                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th width="5%">ID</th>
                                    <th width="15%">Código de Serie</th>
                                    <th width="15%">Descripción</th>
                                    <th width="15%">Cantidad</th>
                                    <th width="10%">Precio</th>
                                    <th width="15%">Categoría</th>
                                    <th width="15%">Imagen</th>
                                    <th width="20%">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productos as $producto)
                                <tr>
                                    <td>{{ $producto->id }}</td>
                                    <td>{{ $producto->Codigo_serie }}</td>
                                    <td>{{ $producto->Descripcion }}</td>
                                    <td>{{ $producto->cantidad }}</td>
                                    <td>{{ $producto->precio }}</td>
                                    <td>{{ $producto->categoria ? $producto->categoria->nombre : 'Sin Categoría' }}</td>
                                    <td>
                                        @if ($producto->imagen)
                                            <img src="{{ asset($producto->imagen) }}" alt="{{ $producto->Descripcion }}" style="width: 50px; height: auto;" />
                                        @else
                                            <span>Sin Imagen</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-success text-white" href="{{ route('admin.productos.edit', $producto->id) }}">Editar</a>
                                        
                                        <form action="{{ route('admin.productos.destroy', $producto->id) }}" method="POST" style="display:inline;">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger text-white" onclick="return confirm('¿Estás seguro de eliminar el producto?')">Eliminar</button>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                responsive: true
            });
        });
    </script>
@endsection
