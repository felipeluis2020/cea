<!-- Modal -->
<div wire:ignore.self class="modal fade" id="DataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="DataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content shadow-lg rounded-4 border-0">
            <div class="modal-header bg-light rounded-top-4 border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold text-primary" id="DataModalLabel">
                    <i class="bi-person-badge-fill me-2"></i> {{ $selected_id ? 'Update Instructor' : 'Create Instructor' }}
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
                                <select wire:model.live="user_id" class="form-select @error('user_id') is-invalid @enderror" id="user_id" aria-label="Usuario">
                                    <option value="">Select Usuario</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->nombres }} {{ $user->apellidos }}</option>
                                    @endforeach
                                </select>
                                <label for="user_id">Usuario</label>
                                @error('user_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
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

                        <div class="col-md-4">
                            <div class="form-floating">
                                <input wire:model.live="telefono" type="text" class="form-control @error('telefono') is-invalid @enderror" id="telefono" placeholder="Telefono">
                                <label for="telefono">Telefono</label>
                                @error('telefono') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-floating">
                                <select wire:model.live="sexo" class="form-select @error('sexo') is-invalid @enderror" id="sexo" aria-label="Sexo">
                                    <option value="">Select Sexo</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                </select>
                                <label for="sexo">Sexo</label>
                                @error('sexo') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-floating">
                                <input wire:model.live="edad" type="number" class="form-control @error('edad') is-invalid @enderror" id="edad" placeholder="Edad">
                                <label for="edad">Edad</label>
                                @error('edad') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input wire:model.live="cantidad_horas" type="number" class="form-control @error('cantidad_horas') is-invalid @enderror" id="cantidad_horas" placeholder="Cantidad Horas">
                                <label for="cantidad_horas">Horas</label>
                                @error('cantidad_horas') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input wire:model.live="fecha_vencimiento_licencia" type="date" class="form-control @error('fecha_vencimiento_licencia') is-invalid @enderror" id="fecha_vencimiento_licencia" placeholder="Venc. Licencia">
                                <label for="fecha_vencimiento_licencia">Venc. Licencia</label>
                                @error('fecha_vencimiento_licencia') <span class="invalid-feedback">{{ $message }}</span> @enderror
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