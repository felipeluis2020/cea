<!-- Modal -->
<div wire:ignore.self class="modal fade" id="DataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="DataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content shadow-lg rounded-4 border-0">
            <div class="modal-header bg-light rounded-top-4 border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold text-primary" id="DataModalLabel">
                    <i class="bi-building-fill me-2"></i> {{ $selected_id ? 'Update Tenant' : 'Create Tenant' }}
                </h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form>
                    @if ($selected_id)
                        <input type="hidden" wire:model="selected_id">
                    @endif
                    
                    <div class="form-floating mb-3">
                        <input wire:model.live="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Name">
                        <label for="name">Name</label>
                        @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input wire:model.live="nit" type="text" class="form-control @error('nit') is-invalid @enderror" id="nit" placeholder="Nit">
                        <label for="nit">Nit</label>
                        @error('nit') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-check form-switch p-3 bg-light rounded-3 d-flex justify-content-between align-items-center border">
                        <label class="form-check-label fw-medium mb-0" for="is_active">
                            ¿Esta activo?
                        </label>
                        <input wire:model.live="is_active" class="form-check-input ms-2" style="width: 3em; height: 1.5em; cursor: pointer;" type="checkbox" role="switch" id="is_active">
                    </div>
                    @error('is_active') <div class="text-danger small mt-1">{{ $message }}</div> @enderror

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