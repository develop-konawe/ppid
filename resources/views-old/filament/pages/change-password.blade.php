<x-filament-panels::page>
    <form wire:submit.prevent="submit" class="space-y-6">
        {{ $this->form }}

        <div class="flex items-center gap-3">
            <x-filament::button
                type="submit"
                wire:target="submit"
                wire:loading.attr="disabled"
            >
                <span wire:loading.remove wire:target="submit">
                    Simpan Password
                </span>

                            <span wire:loading wire:target="submit">
                    Memproses...
                </span>
            </x-filament::button>
        </div>
    </form>
</x-filament-panels::page>
