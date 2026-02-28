@section('title', __('Rols'))
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 text-primary fw-bold">
                            <i class="bi-house-check-fill me-2"></i> {{ __('Listado de Roles') }}
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
                                <input wire:model.live='keyWord' type="text" class="form-control border-start-0 ps-0" name="search" id="search" placeholder="Search Rols...">
                            </div>

                            @if($this->can('crear'))
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#DataModal">
                                <i class="bi-plus-lg me-1"></i> {{ __('Agregar Roles') }}
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    @include('livewire.rols.modals')
                    
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr> 
                                    <th scope="col" class="text-center" width="50">#</th> 
                                    <th scope="col">{{ __('Nombre Rol') }}</th>
                                    <th scope="col" class="text-end">{{ __('Acciones') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($rols as $row)
                                <tr>
                                    <td class="text-center fw-bold text-muted">{{ $loop->iteration }}</td> 
                                    <td class="fw-medium">{{ $row->nombre_rol }}</td>
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
                                                    <a class="dropdown-item text-danger" href="#" onclick="confirm('Confirm Delete Rol id {{$row->id}}? \nDeleted Rols cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})">
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
                                    <td class="text-center py-4 text-muted" colspan="3">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="bi-inbox-fill fs-1 mb-2 opacity-25"></i>
                                            <span>No se encontraron roles</span>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>                        
                        <div class="d-flex justify-content-end mt-3">
                            {{ $rols->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>