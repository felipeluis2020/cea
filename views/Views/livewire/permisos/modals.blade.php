<!-- Modal -->
<div wire:ignore.self class="modal fade" id="DataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="DataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content shadow-lg rounded-4 border-0">
            <div class="modal-header bg-light rounded-top-4 border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold text-primary" id="DataModalLabel">
                    <i class="bi-shield-lock-fill me-2"></i> {{ $selected_id ? 'Update Permiso' : 'Create Permiso' }}
                </h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form>
                    @if ($selected_id)
                        <input type="hidden" wire:model="selected_id">
                    @endif
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <select wire:model.live="rol_id" class="form-select @error('rol_id') is-invalid @enderror" id="rol_id" aria-label="Rol Id">
                                    <option value="">Select Rol</option>
                                    @foreach($rols as $rol)
                                        <option value="{{ $rol->id }}">{{ $rol->nombre_rol }}</option>
                                    @endforeach
                                </select>
                                <label for="rol_id">Rol</label>
                                @error('rol_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <select wire:model.live="modulo_id" class="form-select @error('modulo_id') is-invalid @enderror" id="modulo_id" aria-label="Modulo Id">
                                    <option value="">Select Modulo</option>
                                    @foreach($modulos as $modulo)
                                        <option value="{{ $modulo->id }}">{{ $modulo->nombre_modulo }}</option>
                                    @endforeach
                                </select>
                                <label for="modulo_id">Modulo</label>
                                @error('modulo_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <h6 class="text-muted text-uppercase small fw-bold mb-3 mt-2">Permissions</h6>

                    <div class="row g-3">
                        <div class="col-6">
                            <div class="form-check form-switch p-2 bg-light rounded border d-flex justify-content-between align-items-center">
                                <label class="form-check-label mb-0 ms-2" for="crear">Crear</label>
                                <input wire:model.live="crear" class="form-check-input me-2" type="checkbox" role="switch" id="crear">
                            </div>
                            @error('crear') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-6">
                            <div class="form-check form-switch p-2 bg-light rounded border d-flex justify-content-between align-items-center">
                                <label class="form-check-label mb-0 ms-2" for="ver">Ver</label>
                                <input wire:model.live="ver" class="form-check-input me-2" type="checkbox" role="switch" id="ver">
                            </div>
                            @error('ver') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-6">
                            <div class="form-check form-switch p-2 bg-light rounded border d-flex justify-content-between align-items-center">
                                <label class="form-check-label mb-0 ms-2" for="editar">Editar</label>
                                <input wire:model.live="editar" class="form-check-input me-2" type="checkbox" role="switch" id="editar">
                            </div>
                            @error('editar') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-6">
                            <div class="form-check form-switch p-2 bg-light rounded border d-flex justify-content-between align-items-center">
                                <label class="form-check-label mb-0 ms-2" for="borrar">Borrar</label>
                                <input wire:model.live="borrar" class="form-check-input me-2" type="checkbox" role="switch" id="borrar">
                            </div>
                            @error('borrar') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-6">
                            <div class="form-check form-switch p-2 bg-light rounded border d-flex justify-content-between align-items-center">
                                <label class="form-check-label mb-0 ms-2" for="importar">Importar</label>
                                <input wire:model.live="importar" class="form-check-input me-2" type="checkbox" role="switch" id="importar">
                            </div>
                            @error('importar') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-6">
                            <div class="form-check form-switch p-2 bg-light rounded border d-flex justify-content-between align-items-center">
                                <label class="form-check-label mb-0 ms-2" for="exportar">Exportar</label>
                                <input wire:model.live="exportar" class="form-check-input me-2" type="checkbox" role="switch" id="exportar">
                            </div>
                            @error('exportar') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer border-top-0 pt-0 pb-4 pe-4">
                <button type="button" class="btn btn-light border" data-bs-dismiss="modal" wire:click.prevent="cancel()">
                    <i class="bi-x-circle me-1"></i> Close
                </button>
                <button type="button" wire:click.prevent="save()" class="btn btn-primary px-4">
                    <i class="bi-save me-1"></i> {{ $selected_id ? 'Update' : 'Create' }}
                </button>
            </div>
        </div>
    </div>
</div>