@extends('backend.layouts.master')

@section('title')
    Editar Producto - Panel de Administración
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />
@endsection

@section('admin-content')
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Editar Producto</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('admin.productos.index') }}">Productos</a></li>
                    <li><span>Editar Producto</span></li>
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
                    <h4 class="header-title">Editar Producto</h4>
                    @include('backend.layouts.partials.messages')

                    <form action="{{ route('admin.productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="Codigo_serie">Código de Serie</label>
                            <input type="text" name="Codigo_serie" class="form-control" id="Codigo_serie" value="{{ old('Codigo_serie', $producto->Codigo_serie) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="Descripcion">Descripción</label>
                            <textarea name="Descripcion" class="form-control" id="Descripcion" rows="3" required>{{ old('Descripcion', $producto->Descripcion) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="cantidad">Cantidad</label>
                            <input type="number" name="cantidad" class="form-control" id="cantidad" value="{{ old('cantidad', $producto->cantidad) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="precio">Precio</label>
                            <input type="number" step="0.01" name="precio" class="form-control" id="precio" value="{{ old('precio', $producto->precio) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="categoria_id">Categoría</label>
                            <select name="categoria_id" class="form-control select2" id="categoria_id" required>
                                <option value="">Seleccione una categoría</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}" {{ $producto->categoria_id == $categoria->id ? 'selected' : '' }}>
                                        {{ $categoria->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="imagen">Imagen</label>
                            <input type="file" name="imagen" class="form-control" id="imagen">
                            @if($producto->imagen)
                                <img src="{{ asset('storage/' . $producto->imagen) }}" alt="Imagen del producto" width="100" class="mt-2">
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">Actualizar Producto</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endsection
