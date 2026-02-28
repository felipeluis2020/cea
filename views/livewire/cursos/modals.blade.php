<!-- Modal -->
<div wire:ignore.self class="modal fade" id="DataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="DataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content shadow-lg rounded-4 border-0">
            <div class="modal-header bg-light rounded-top-4 border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold text-primary" id="DataModalLabel">
                    <i class="bi-journal-bookmark-fill me-2"></i> {{ $selected_id ? 'Update Curso' : 'Create Curso' }}
                </h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form>
                    @if ($selected_id)
                        <input type="hidden" wire:model="selected_id">
                    @endif
                    
                    <div class="row g-3">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input wire:model.live="nombre_curso" type="text" class="form-control @error('nombre_curso') is-invalid @enderror" id="nombre_curso" placeholder="Nombre Curso">
                                <label for="nombre_curso">Nombre Curso</label>
                                @error('nombre_curso') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <textarea wire:model.live="descripcion_curso" class="form-control @error('descripcion_curso') is-invalid @enderror" id="descripcion_curso" placeholder="Descripcion Curso" style="height: 100px"></textarea>
                                <label for="descripcion_curso">Descripcion Curso</label>
                                @error('descripcion_curso') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input wire:model.live="precio_curso" type="number" step="0.01" class="form-control @error('precio_curso') is-invalid @enderror" id="precio_curso" placeholder="Precio Curso">
                                <label for="precio_curso">Precio Curso</label>
                                @error('precio_curso') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select wire:model.live="tenant_id" class="form-select @error('tenant_id') is-invalid @enderror" id="tenant_id" aria-label="Tenant">
                                    <option value="">Select Tenant</option>
                                    @foreach($tenants as $tenant)
                                        <option value="{{ $tenant->id }}">{{ $tenant->name }}</option>
                                    @endforeach
                                </select>
                                <label for="tenant_id">Tenant</label>
                                @error('tenant_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
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