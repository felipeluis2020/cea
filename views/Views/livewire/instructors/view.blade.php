@section('title', __('Instructors'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card shadow-sm border-0 rounded-3">
				<div class="card-header bg-white py-3 border-bottom-0">
					<div class="d-flex justify-content-between align-items-center">
						<h4 class="mb-0 text-primary fw-bold">
                            <i class="bi-person-badge-fill me-2"></i> Listado de Instructores
                        </h4>
						
                        <div class="d-flex align-items-center gap-3">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi-search text-muted"></i></span>
                                <input wire:model.live='keyWord' type="text" class="form-control bg-light border-start-0" name="search" id="search" placeholder="Search Instructors">
                            </div>
                            @if($this->can('crear'))
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#DataModal">
                                <i class="bi-plus-lg me-1"></i> {{ __('Añadir') }}
                            </button>
                            @endif
                        </div>
					</div>
				</div>
				
				<div class="card-body p-0">
                    @if (session()->has('message'))
                        <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                            <i class="bi-check-circle-fill me-2"></i> {{ session('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

					@include('livewire.instructors.modals')
                    
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr> 
                                    <th class="ps-4">#</th> 
                                    <th>Usuario</th>
                                    <th>Sexo</th>
                                    <th>Telefono</th>
                                    <th>Edad</th>
                                    <th>Horas</th>
                                    <th>Venc. Licencia</th>
                                    <th>Tenant</th>
                                    <th class="text-end pe-4">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($instructors as $row)
                                <tr>
                                    <td class="ps-4 text-muted">{{ $loop->iteration }}</td> 
                                    <td class="fw-medium">{{ $row->user->nombres ?? '' }} {{ $row->user->apellidos ?? '' }}</td>
                                    <td>{{ $row->sexo }}</td>
                                    <td>{{ $row->telefono }}</td>
                                    <td>{{ $row->edad }}</td>
                                    <td>
                                        <span class="badge bg-info text-dark">{{ $row->cantidad_horas }} hrs</span>
                                    </td>
                                    <td>{{ $row->fecha_vencimiento_licencia }}</td>
                                    <td>
                                        <span class="badge bg-light text-dark border">{{ $row->tenant->name ?? 'N/A' }}</span>
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="dropdown">
                                            <button class="btn btn-light btn-sm dropdown-toggle border" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Acciones
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                                                @if($this->can('editar'))
                                                <li><a data-bs-toggle="modal" data-bs-target="#DataModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="bi-pencil-square me-2 text-warning"></i> Editar </a></li>
                                                @endif
                                                <li><hr class="dropdown-divider"></li>
                                                @if($this->can('borrar'))
                                                <li><a class="dropdown-item text-danger" onclick="confirm('Confirm Delete Instructor id {{$row->id}}? \nDeleted Instructors cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="bi-trash3-fill me-2"></i> Eliminar </a></li>  
                                                @endif  
                                            </ul>
                                        </div>								
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center py-5 text-muted" colspan="100%">
                                        <i class="bi-inbox fs-1 d-block mb-3"></i>
                                        No se encontraron instructores
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>						
                        <div class="px-4 py-3 border-top">
                            {{ $instructors->links() }}
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>