@extends('layouts.app')

@section('title','Home')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <h1 class="text-center">Concesionario Inmov</h1>
            <br>
            <button type="button" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#addCar">
                Agregar Auto
            </button>
            <br>
            <br>
            <div class="modal fade" id="addCar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Agregar un nuevo Auto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="container" action="/conseinmov/public/cars" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-md-4" for="">Imagén</label>
                                    <input class="form-control col-md-8" type="file" name="photo" id="photo" required autofocus>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4" for="">Marca</label>
                                    <input class="form-control col-md-8" type="text" name="txt_marca" id="txt_marca" min="8" max="8" required autofocus>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4" for="">Modelo</label>
                                    <input class="form-control col-md-8" type="text" name="txt_modelo" id="txt_modelo" min="8" max="8" required autofocus>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4" for="">Ciudad</label>
                                    <select class="form-control col-md-8" name="ciudad" id="ciudad" required autofocus>
                                        <option value="Colombia">Colombia</option>
                                        <option value="México">México</option>
                                        <option value="Perú">Perú</option>
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4" for="">Placa</label>
                                    <input class="form-control col-md-3" type="text" name="txt_text_placa" id="txt_text_placa" size="3" max="3" required autofocus>
                                    -
                                    <input class="form-control col-md-3" type="number" name="txt_num_placa" id="txt_num_placa" min="000" size="3" required autofocus>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4" for="">Año</label>    
                                    <input class="form-control col-md-8" type="number" name="txt_num_ano" id="txt_num_ano" min="1950" max="2019" size="4" required autofocus>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Guardar</button>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive-sm">
                <table class="table text-center">
                    <thead>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Placa</th>
                        <th>Acción</th>
                    </thead>
                    <tbody>
                        @if (!empty($cars))
                            @foreach ($cars as $car)
                                <tr>
                                    <td>{{$car->brand}}</td>
                                    <td>{{$car->model}}</td>
                                    <td>{{$car->plate}}</td>
                                    <td>
                                        <a class="btn btn-primary" href="/conseinmov/public/cars/{{ $car->id}}">Visualizar</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3">No existen autos por el momento</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
