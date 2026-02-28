@section('title', __('Estudiantes'))

<div class="container-fluid py-3">
    <div class="row justify-content-center">
        <div class="col-12">

            <div class="card border-0 shadow-sm">
                <!-- Header / Toolbar -->
                <div class="card-header bg-white border-0 py-3">
                    <div class="d-flex flex-column flex-lg-row gap-2 gap-lg-3 align-items-lg-center justify-content-between">

                        <div class="d-flex align-items-center gap-2">
                            <div class="rounded-circle d-flex align-items-center justify-content-center"
                                 style="width:40px;height:40px;background:#eef7ff;">
                                <i class="bi bi-mortarboard-fill text-primary"></i>
                            </div>
                            <div>
                                <h5 class="mb-0 fw-bold">Estudiantes</h5>
                                <small class="text-muted">Administración de inscripción, matrícula y pagos</small>
                            </div>
                        </div>

                        <div class="d-flex flex-column flex-sm-row gap-2 align-items-stretch align-items-sm-center">
                            <!-- Search -->
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-search"></i></span>
                                <input wire:model.live="keyWord" type="text" class="form-control"
                                       name="search" id="search" placeholder="Buscar por documento, nombre, curso...">
                            </div>

                            <!-- Create -->
                            @if($this->can('crear'))
                                <button type="button" class="btn btn-primary"
                                        data-bs-toggle="modal" data-bs-target="#DataModal">
                                    <i class="bi bi-plus-lg me-1"></i> Nuevo estudiante
                                </button>
                            @endif
                        </div>
                    </div>

                    <!-- Flash message -->
                    @if (session()->has('message'))
                        <div wire:poll.4s class="alert alert-success d-flex align-items-center mt-3 mb-0" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            <div>{{ session('message') }}</div>
                        </div>
                    @endif
                </div>

                <div class="card-body">
                    @include('livewire.estudiantes.modals')

                    <div class="table-responsive">
                        <table class="table align-middle table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th style="width:70px;">#</th>
                                    <th>Documento</th>
                                    <th>Nombre</th>
                                    <th>Curso</th>
                                    <th class="text-center">Inscripción</th>
                                    <th class="text-center">Matrícula</th>
                                    <th class="text-end">Valor</th>
                                    <th class="text-end">Saldo</th>
                                    <th class="text-center">Clase</th>
                                    <th class="text-center">Firma</th>
                                    <th class="text-center">Pago</th>
                                    <th class="text-end" style="width:120px;">Acciones</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($estudiantes as $row)
                                    <tr>
                                        <td class="text-muted">#{{ $row->id }}</td>

                                        <td>
                                            <div class="fw-semibold">{{ $row->numero_documento }}</div>
                                            <small class="text-muted">
                                                {{ $row->sexo }} · {{ $row->edad }} años
                                            </small>
                                        </td>

                                        <td>
                                            <div class="fw-semibold">{{ $row->nombre }} {{ $row->apellido }}</div>
                                        </td>

                                        <td>
                                            <div class="fw-semibold">{{ $row->curso }}</div>
                                        </td>

                                        <td class="text-center">
                                            @php
                                                $ins = $row->estado_inscripcion;
                                                $insClass = match($ins) {
                                                    'Preinscrito' => 'bg-warning-subtle text-warning-emphasis',
                                                    'Inscrito'    => 'bg-success-subtle text-success-emphasis',
                                                    'Cancelado'   => 'bg-danger-subtle text-danger-emphasis',
                                                    default       => 'bg-secondary-subtle text-secondary-emphasis'
                                                };
                                            @endphp
                                            <span class="badge {{ $insClass }}">{{ $ins }}</span>
                                        </td>

                                        <td class="text-center">
                                            @php
                                                $mat = $row->estado_matricula;
                                                $matClass = match($mat) {
                                                    'Pendiente'  => 'bg-warning-subtle text-warning-emphasis',
                                                    'Activa'     => 'bg-success-subtle text-success-emphasis',
                                                    'Finalizada' => 'bg-primary-subtle text-primary-emphasis',
                                                    'Cancelada'  => 'bg-danger-subtle text-danger-emphasis',
                                                    default      => 'bg-secondary-subtle text-secondary-emphasis'
                                                };
                                            @endphp
                                            <span class="badge {{ $matClass }}">{{ $mat }}</span>
                                        </td>

                                        <td class="text-end">
                                            {{ number_format((float)$row->valor_curso, 2, ',', '.') }}
                                        </td>

                                        <td class="text-end">
                                            {{ number_format((float)$row->saldo, 2, ',', '.') }}
                                        </td>

                                        <td class="text-center">
                                            <span class="badge bg-light text-dark">
                                                {{ (int)$row->clase_actual }}
                                            </span>
                                        </td>

                                        <td class="text-center">
                                            <span class="text-muted">
                                                {{ $row->fecha_firma_contrato ? \Carbon\Carbon::parse($row->fecha_firma_contrato)->format('Y-m-d') : '—' }}
                                            </span>
                                        </td>

                                        <td class="text-center">
                                            <span class="badge bg-light text-dark">
                                                {{ $row->metodo_pago ?: '—' }}
                                            </span>
                                        </td>

                                        <td class="text-end">
                                            <div class="btn-group">
                                                @if($this->can('editar'))
                                                    <button type="button"
                                                            class="btn btn-sm btn-outline-primary"
                                                            data-bs-toggle="modal" data-bs-target="#DataModal"
                                                            wire:click="edit({{ $row->id }})">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </button>
                                                @endif

                                                <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle dropdown-toggle-split"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                    <span class="visually-hidden">Toggle Dropdown</span>
                                                </button>

                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    @if($this->can('editar'))
                                                        <li>
                                                            <a class="dropdown-item"
                                                               data-bs-toggle="modal" data-bs-target="#DataModal"
                                                               wire:click="edit({{ $row->id }})">
                                                                <i class="bi bi-pencil-square me-2"></i> Editar
                                                            </a>
                                                        </li>
                                                    @endif

                                                    @if($this->can('borrar'))
                                                        <li><hr class="dropdown-divider"></li>
                                                        <li>
                                                            <a class="dropdown-item text-danger"
                                                               onclick="confirm('¿Eliminar estudiante #{{ $row->id }}?\nEsta acción no se puede deshacer.') || event.stopImmediatePropagation()"
                                                               wire:click="destroy({{ $row->id }})">
                                                                <i class="bi bi-trash3-fill me-2"></i> Eliminar
                                                            </a>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="12" class="text-center py-5">
                                            <div class="text-muted">
                                                <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                                No hay estudiantes para mostrar.
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-end">
                            {{ $estudiantes->links() }}
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>