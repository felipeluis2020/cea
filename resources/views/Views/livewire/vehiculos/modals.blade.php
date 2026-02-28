<!-- Modal -->
<div wire:ignore.self class="modal fade" id="DataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="DataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content shadow-lg rounded-4 border-0">
            <div class="modal-header bg-light rounded-top-4 border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold text-primary" id="DataModalLabel">
                    <i class="bi-car-front-fill me-2"></i> {{ $selected_id ? 'Update Vehiculo' : 'Create Vehiculo' }}
                </h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form>
                    @if ($selected_id)
                        <input type="hidden" wire:model="selected_id">
                    @endif
                    
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input wire:model.live="placa_vehiculo" type="text" class="form-control @error('placa_vehiculo') is-invalid @enderror" id="placa_vehiculo" placeholder="Placa Vehiculo">
                                <label for="placa_vehiculo">Placa</label>
                                @error('placa_vehiculo') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input wire:model.live="marca_vehiculo" type="text" class="form-control @error('marca_vehiculo') is-invalid @enderror" id="marca_vehiculo" placeholder="Marca Vehiculo">
                                <label for="marca_vehiculo">Marca</label>
                                @error('marca_vehiculo') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input wire:model.live="cantidad_horas" type="text" class="form-control @error('cantidad_horas') is-invalid @enderror" id="cantidad_horas" placeholder="Cantidad Horas">
                                <label for="cantidad_horas">Horas</label>
                                @error('cantidad_horas') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-floating">
                                <input wire:model.live="fecha_vencimiento_soat" type="datetime-local" class="form-control @error('fecha_vencimiento_soat') is-invalid @enderror" id="fecha_vencimiento_soat" placeholder="Venc. SOAT">
                                <label for="fecha_vencimiento_soat">Venc. SOAT</label>
                                @error('fecha_vencimiento_soat') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input wire:model.live="fecha_vencimiento_tecnomecanica" type="datetime-local" class="form-control @error('fecha_vencimiento_tecnomecanica') is-invalid @enderror" id="fecha_vencimiento_tecnomecanica" placeholder="Venc. Tecnomecanica">
                                <label for="fecha_vencimiento_tecnomecanica">Venc. Tecno</label>
                                @error('fecha_vencimiento_tecnomecanica') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input wire:model.live="fecha_vencimiento_tarjeta_operacion" type="datetime-local" class="form-control @error('fecha_vencimiento_tarjeta_operacion') is-invalid @enderror" id="fecha_vencimiento_tarjeta_operacion" placeholder="Venc. Tarjeta">
                                <label for="fecha_vencimiento_tarjeta_operacion">Venc. Tarjeta</label>
                                @error('fecha_vencimiento_tarjeta_operacion') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <select wire:model.live="estadovehiculo_id" class="form-select @error('estadovehiculo_id') is-invalid @enderror" id="estadovehiculo_id" aria-label="Estado Vehiculo">
                                    <option value="">Select Estado</option>
                                    @foreach($estadovehiculos as $estado)
                                        <option value="{{ $estado->id }}">{{ $estado->nombre_estado_vehiculo }}</option>
                                    @endforeach
                                </select>
                                <label for="estadovehiculo_id">Estado Vehiculo</label>
                                @error('estadovehiculo_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select wire:model.live="estadomantenimiento_id" class="form-select @error('estadomantenimiento_id') is-invalid @enderror" id="estadomantenimiento_id" aria-label="Mantenimiento">
                                    <option value="">Select Mantenimiento</option>
                                    @foreach($estadomantenimientos as $estado)
                                        <option value="{{ $estado->id }}">{{ $estado->nombre_estado_mantenimiento }}</option>
                                    @endforeach
                                </select>
                                <label for="estadomantenimiento_id">Mantenimiento</label>
                                @error('estadomantenimiento_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
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