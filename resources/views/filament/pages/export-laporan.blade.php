<x-filament-panels::page>
    <x-filament-panels::form wire:submit="exportExcel">
        {{ $this->form }}

        <div class="flex gap-3 mt-2">
            <button type="submit"
                class="fi-btn fi-btn-size-md fi-color-success fi-btn-color-success px-4 py-2 rounded-lg text-sm font-semibold bg-green-600 text-white hover:bg-green-700 flex items-center gap-2">
                <x-heroicon-o-table-cells class="w-4 h-4"/>
                Download Excel
            </button>

            <button type="button" wire:click="exportPdf"
                class="fi-btn fi-btn-size-md fi-color-danger fi-btn-color-danger px-4 py-2 rounded-lg text-sm font-semibold bg-red-600 text-white hover:bg-red-700 flex items-center gap-2">
                <x-heroicon-o-document-text class="w-4 h-4"/>
                Download PDF
            </button>
        </div>
    </x-filament-panels::form>
</x-filament-panels::page>