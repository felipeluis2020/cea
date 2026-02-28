@section('title', __('Permisos'))
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 text-primary fw-bold">
                            <i class="bi-house-check-fill me-2"></i> {{ __('Listado de Permisos') }}
                        </h4>
                        
                        <div class="d-flex gap-2 align-items-center">
                            @if (session()->has('message'))
                                <div wire:poll.4s class="alert alert-success py-1 px-3 mb-0 fs-6 d-flex align-items-center">
                                    <i class="bi-check-circle-fill me-2"></i> {{ session('message') }}
                                </div>
                            @endif

                            <div class="input-group input-group-sm" style="width: 250px;">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="bi-search text-muted"></i>
                                </span>
                                <input wire:model.live='keyWord' type="text" class="form-control border-start-0 ps-0" name="search" id="search" placeholder="Search Permisos...">
                            </div>

                            @if($this->can('crear'))
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#DataModal">
                                <i class="bi-plus-lg me-1"></i> {{ __('Agregar Permisos') }}
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    @include('livewire.permisos.modals')
                    
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr> 
                                    <th scope="col" class="text-center" width="50">#</th> 
                                    <th scope="col">{{ __('Rol') }}</th>
                                    <th scope="col">{{ __('Modulo') }}</th>
                                    <th scope="col" class="text-center">{{ __('Crear') }}</th>
                                    <th scope="col" class="text-center">{{ __('Ver') }}</th>
                                    <th scope="col" class="text-center">{{ __('Editar') }}</th>
                                    <th scope="col" class="text-center">{{ __('Borrar') }}</th>
                                    <th scope="col" class="text-center">{{ __('Importar') }}</th>
                                    <th scope="col" class="text-center">{{ __('Exportar') }}</th>
                                    <th scope="col" class="text-end">{{ __('Acciones') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($permisos as $row)
                                <tr>
                                    <td class="text-center fw-bold text-muted">{{ $row->id }}</td> 
                                    <td class="fw-medium">{{ $row->rol->nombre_rol ?? 'N/A' }}</td>
                                    <td class="fw-medium">{{ $row->modulo->nombre_modulo ?? 'N/A' }}</td>
                                    <td class="text-center">
                                        @if($row->crear) <i class="bi-check-circle-fill text-success"></i> @else <i class="bi-x-circle text-muted"></i> @endif
                                    </td>
                                    <td class="text-center">
                                        @if($row->ver) <i class="bi-check-circle-fill text-success"></i> @else <i class="bi-x-circle text-muted"></i> @endif
                                    </td>
                                    <td class="text-center">
                                        @if($row->editar) <i class="bi-check-circle-fill text-success"></i> @else <i class="bi-x-circle text-muted"></i> @endif
                                    </td>
                                    <td class="text-center">
                                        @if($row->borrar) <i class="bi-check-circle-fill text-success"></i> @else <i class="bi-x-circle text-muted"></i> @endif
                                    </td>
                                    <td class="text-center">
                                        @if($row->importar) <i class="bi-check-circle-fill text-success"></i> @else <i class="bi-x-circle text-muted"></i> @endif
                                    </td>
                                    <td class="text-center">
                                        @if($row->exportar) <i class="bi-check-circle-fill text-success"></i> @else <i class="bi-x-circle text-muted"></i> @endif
                                    </td>
                                    <td class="text-end">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light border dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                ⋮
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    @if($this->can('editar'))
                                                    <a data-bs-toggle="modal" data-bs-target="#DataModal" class="dropdown-item" href="#" wire:click="edit({{$row->id}})">
                                                        <i class="bi-pencil-square me-2 text-primary"></i> Editar
                                                    </a>
                                                    @endif
                                                </li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li>
                                                    @if($this->can('borrar'))
                                                    <a class="dropdown-item text-danger" href="#" onclick="confirm('Confirm Delete Permiso id {{$row->id}}? \nDeleted Permisos cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})">
                                                        <i class="bi-trash3-fill me-2"></i> Eliminar
                                                    </a>
                                                    @endif
                                                </li>  
                                            </ul>
                                        </div>                                
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center py-4 text-muted" colspan="10">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="bi-inbox-fill fs-1 mb-2 opacity-25"></i>
                                            <span>No se encontraron permisos</span>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>                        
                        <div class="d-flex justify-content-end mt-3">
                            {{ $permisos->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>