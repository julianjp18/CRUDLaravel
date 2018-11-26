@extends('layouts.app')

@section('title','Ver auto')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <h1 class="text-center">Ver auto <b>{{$brand}} - {{$plate}}</b></h1>
            <br>
            <button type="button" class="btn btn-lg btn-warning" data-toggle="modal" data-target="#editProcess">
                Editar información auto
            </button>
            <br>
            <br>
            <!-- modal edit-->
            <div class="modal fade" id="editProcess" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar auto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="container" action="/conseinmov/public/cars/{{$id}}" method="POST" enctype="multipart/form-data">
                                @method('PATCH')
                                @csrf
                                <div class="form-group row">
                                    <label class="col-md-4" for="">Imagén</label>
                                    <input class="form-control col-md-8" type="file" name="photo" id="photo" autofocus>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4" for="">Marca</label>
                                <input class="form-control col-md-8" type="text" name="txt_marca" id="txt_marca" min="8" max="8" value="{{$brand}}" required autofocus>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4" for="">Modelo</label>
                                    <input class="form-control col-md-8" type="text" name="txt_modelo" id="txt_modelo" min="8" max="8" value="{{$model}}" required autofocus>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4" for="">Ciudad</label>
                                    <select class="form-control col-md-8" name="ciudad" id="ciudad" required autofocus>
                                    <option value="{{$country}}">{{$country}}</option>
                                        @if ($country == 'Colombia')
                                            <option value="México">México</option>
                                            <option value="Perú">Perú</option>
                                        @endif
                                        @if ($country == 'México')
                                            <option value="Colombia">Colombia</option>
                                            <option value="Perú">Perú</option>
                                        @endif
                                        @if ($country == 'Perú')
                                            <option value="Colombia">Colombia</option>
                                            <option value="México">México</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4" for="">Placa</label>
                                    <input class="form-control col-md-8" type="text" name="txt_text_placa" id="txt_text_placa" value="{{$plate}}" size="6" max="6" required autofocus>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4" for="">Año</label>    
                                    <input class="form-control col-md-8" type="number" name="txt_num_ano" id="txt_num_ano"  value="{{$year}}" min="1950" max="2019" size="4" required autofocus>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-warning" type="submit">Actualizar</button>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <img style="width:10%;" src="../{{$url_photo}}" class="img-responsive rounded" alt="...">
            </div>
            <br>
            <div class="table-responsive-sm">
                <table class="table">
                    <thead>
                        <th>Placa</th>
                        <th>Modelo</th>
                        <th>Marca</th>
                        <th>Año</th>
                        <th>Ciudad</th>
                        <th>Fecha agregado</th>
                    </thead>
                    <tbody>
                        @if (!empty($id))
                           
                            <tr>
                                <td>{{$plate}}</td>
                                <td>{{$model}}</td>
                                <td>{{$brand}}</td>
                                <td>{{$year}}</td>
                                <td>{{$country}}</td>
                                <td><?= date('Y-m-d', strtotime($created_at))?></td>
                                <td>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteCar">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="3">No se encontró el auto, por favor inténtelo de nuevo</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <!-- Modal delete -->
            <div class="modal fade" id="deleteCar" tabindex="-1" role="dialog" aria-labelledby="deleteCar" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Eliminar auto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="/conseinmov/public/cars/{{$id}}">
                                @method("DELETE")
                                @csrf
                                
                                <div class="form-group row">
                                    <div class="col-md-12 text-center">
                                    <p>¿Seguro que desea eliminar el auto <b>{{$brand}},{{$plate}}</b>?</p>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-danger">
                                            {{ __('Eliminar auto') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center">
        <a class="btn btn-primary" href="/conseinmov/public/">Volver</a>
    </div>
</div>
@endsection
