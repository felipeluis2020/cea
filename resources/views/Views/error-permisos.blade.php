@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center" style="margin-top: 50px;">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body text-center" style="padding: 40px;">

                    <h2 class="text-secondary">Acceso Denegado</h2>

                    <div class="alert alert-info" style="margin-top: 20px; font-size: 16px;">
                        <i class="glyphicon glyphicon-exclamation-sign"></i> 
                        Lo sentimos, no tienes los permisos necesarios para <strong>visualizar o interactuar</strong> con este módulo.
                    </div>

                    <p class="text-muted" style="margin-bottom: 30px;">
                        Si crees que esto es un error, por favor contacta al administrador del sistema para revisar tu perfil de usuario y rol asignado.
                    </p>

                    <hr>

                    <!-- Acciones -->
                    <div class="btn-group">
                        <a href="{{ url('/home') }}" class="btn btn-primary btn-lg">
                            <i class="glyphicon glyphicon-home"></i> Ir al Inicio
                        </a>
                        <button type="button" onclick="window.history.back();" class="btn btn-secondary btn-lg">
                            <i class="glyphicon glyphicon-arrow-left"></i> Volver atrás
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection