<!-- Modal -->
<div wire:ignore.self class="modal fade" id="DataModal" data-bs-backdrop="static" tabindex="-1"
     role="dialog" aria-labelledby="DataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg rounded-4">

            <!-- Header -->
            <div class="modal-header bg-light border-0 rounded-top-4">
                <div>
                    <h5 class="modal-title fw-bold text-primary" id="DataModalLabel">
                        <i class="bi bi-person-badge-fill me-2"></i>
                        {{ $selected_id ? 'Actualizar estudiante' : 'Crear estudiante' }}
                    </h5>
                    <small class="text-muted">Gestiona inscripción, matrícula y pagos</small>
                </div>
                <button wire:click.prevent="cancel()" type="button"
                        class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Body -->
            <div class="modal-body px-4 py-3">

                <form>
                    @if ($selected_id)
                        <input type="hidden" wire:model="selected_id">
                    @endif

                    <!-- ========================= DATOS PERSONALES ========================= -->
                    <div class="mb-3">
                        <h6 class="fw-semibold text-primary border-bottom pb-2">
                            <i class="bi bi-person-fill me-1"></i> Datos personales
                        </h6>
                    </div>

                    <div class="row g-3 mb-4">

                        <div class="col-md-4">
                            <label class="form-label">Documento</label>
                            <input type="text" class="form-control"
                                   wire:model.defer="numero_documento"
                                   placeholder="109999999">
                            @error('numero_documento') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Nombre</label>
                            <input type="text" class="form-control"
                                   wire:model.defer="nombre"
                                   placeholder="Juan">
                            @error('nombre') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Apellido</label>
                            <input type="text" class="form-control"
                                   wire:model.defer="apellido"
                                   placeholder="Pérez">
                            @error('apellido') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Sexo</label>
                            <select class="form-select"
                                    wire:model.defer="sexo">
                                <option value="">Seleccione</option>
                                <option value="M">M</option>
                                <option value="F">F</option>
                                <option value="Otro">Otro</option>
                            </select>
                            @error('sexo') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Edad</label>
                            <input type="number" min="0" class="form-control"
                                   wire:model.defer="edad">
                            @error('edad') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Fecha firma contrato</label>
                            <input type="date" class="form-control"
                                   wire:model.defer="fecha_firma_contrato">
                            @error('fecha_firma_contrato') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                    </div>

                    <!-- ========================= INSCRIPCIÓN ========================= -->
                    <div class="mb-3">
                        <h6 class="fw-semibold text-primary border-bottom pb-2">
                            <i class="bi bi-journal-check me-1"></i> Inscripción y matrícula
                        </h6>
                    </div>

                    <div class="row g-3 mb-4">

                        <div class="col-md-3">
                            <label class="form-label">Estado inscripción</label>
                            <select class="form-select"
                                    wire:model.defer="estado_inscripcion">
                                <option value="">Seleccione</option>
                                <option value="Preinscrito">Preinscrito</option>
                                <option value="Inscrito">Inscrito</option>
                                <option value="Cancelado">Cancelado</option>
                            </select>
                            @error('estado_inscripcion') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Estado matrícula</label>
                            <select class="form-select"
                                    wire:model.defer="estado_matricula">
                                <option value="">Seleccione</option>
                                <option value="Pendiente">Pendiente</option>
                                <option value="Activa">Activa</option>
                                <option value="Finalizada">Finalizada</option>
                                <option value="Cancelada">Cancelada</option>
                            </select>
                            @error('estado_matricula') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <!-- CURSOS RELACIONADOS -->
                        <div class="col-md-4">
                            <label class="form-label">Curso</label>
                            <select class="form-select"
                                    wire:model="curso_id">
                                <option value="">Seleccione un curso</option>
                                @foreach($cursos as $c)
                                    <option value="{{ $c->id }}">
                                        {{ $c->nombre_curso }}
                                        ({{ number_format($c->precio_curso, 0, ',', '.') }})
                                    </option>
                                @endforeach
                            </select>
                            @error('curso_id') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-2">
                            <label class="form-label">Clase actual</label>
                            <input type="number" min="0"
                                   class="form-control"
                                   wire:model.defer="clase_actual">
                            @error('clase_actual') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                    </div>

                    <!-- ========================= PAGOS ========================= -->
                    <div class="mb-3">
                        <h6 class="fw-semibold text-primary border-bottom pb-2">
                            <i class="bi bi-cash-stack me-1"></i> Pagos
                        </h6>
                    </div>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label class="form-label">Valor del curso</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="text"
                                    class="form-control bg-light"
                                    wire:model="valor_curso"
                                    readonly>
                            </div>
                            @error('valor_curso') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Saldo</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" step="0.01"
                                       class="form-control"
                                       wire:model.defer="saldo">
                            </div>
                            @error('saldo') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Método de pago</label>
                            <select class="form-select"
                                    wire:model.defer="metodo_pago">
                                <option value="">Seleccione</option>
                                <option value="Efectivo">Efectivo</option>
                                <option value="Transferencia">Transferencia</option>
                                <option value="Tarjeta">Tarjeta</option>
                                <option value="Mixto">Mixto</option>
                            </select>
                            @error('metodo_pago') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                    </div>

                </form>

            </div>

            <!-- Footer -->
            <div class="modal-footer bg-light border-0 rounded-bottom-4">
                <button type="button"
                        class="btn btn-outline-secondary"
                        wire:click.prevent="cancel()"
                        data-bs-dismiss="modal">
                    Cancelar
                </button>

                <button type="button"
                        wire:click.prevent="save()"
                        class="btn btn-primary px-4">
                    <i class="bi bi-save me-1"></i>
                    {{ $selected_id ? 'Guardar cambios' : 'Crear estudiante' }}
                </button>
            </div>

        </div>
    </div>
</div>