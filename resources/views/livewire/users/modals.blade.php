<!-- Modal -->
<div wire:ignore.self class="modal fade" id="DataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="DataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content shadow-lg rounded-4 border-0">
            <div class="modal-header bg-light rounded-top-4 border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold text-primary" id="DataModalLabel">
                    <i class="bi-people-fill me-2"></i> {{ $selected_id ? 'Update User' : 'Create User' }}
                </h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form>
                    @if ($selected_id)
                        <input type="hidden" wire:model="selected_id">
                    @endif
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select wire:model.live="document_type_id" class="form-select @error('document_type_id') is-invalid @enderror" id="document_type_id" aria-label="Document Type">
                                    <option value="">Select Document Type</option>
                                    @foreach($document_types as $dt)
                                        <option value="{{ $dt->id }}">{{ $dt->name }}</option>
                                    @endforeach
                                </select>
                                <label for="document_type_id">Document Type</label>
                                @error('document_type_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input wire:model.live="document_number" type="text" class="form-control @error('document_number') is-invalid @enderror" id="document_number" placeholder="Document Number">
                                <label for="document_number">Document Number</label>
                                @error('document_number') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input wire:model.live="nombres" type="text" class="form-control @error('nombres') is-invalid @enderror" id="nombres" placeholder="Nombres">
                                <label for="nombres">Nombres</label>
                                @error('nombres') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input wire:model.live="apellidos" type="text" class="form-control @error('apellidos') is-invalid @enderror" id="apellidos" placeholder="Apellidos">
                                <label for="apellidos">Apellidos</label>
                                @error('apellidos') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-floating">
                                <input wire:model.live="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email">
                                <label for="email">Email</label>
                                @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
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

                        <div class="col-md-6">
                            <div class="form-floating">
                                <select wire:model.live="rol_id" class="form-select @error('rol_id') is-invalid @enderror" id="rol_id" aria-label="Rol">
                                    <option value="">Select Rol</option>
                                    @foreach($rols as $rol)
                                        <option value="{{ $rol->id }}">{{ $rol->nombre_rol }}</option>
                                    @endforeach
                                </select>
                                <label for="rol_id">Rol</label>
                                @error('rol_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
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