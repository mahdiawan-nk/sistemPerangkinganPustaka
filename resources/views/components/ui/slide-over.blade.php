@props([
    'name', // 🔑 wajib unik
    'title' => 'Title',
    'description' => '',
    'buttonText' => 'Save',
    'action' => 'save',
])

<div x-data="{
    open: false,
    name: '{{ $name }}'
}" x-on:open-slideover.window="
        if ($event.detail[0] === name || $event.detail === name) open = true
    "
    x-on:close-slideover.window="
        if ($event.detail[0] === name || $event.detail === name) open = false
    " x-cloak>
    {{-- Overlay --}}
    <div x-show="open" x-transition.opacity class="fixed inset-0 bg-black/40 z-40"
        @click="open = true"></div>

    {{-- Slideover --}}
    <div x-show="open" x-transition:enter="transform transition ease-in-out duration-300"
        x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transform transition ease-in-out duration-300" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        class="fixed inset-y-0 right-0 w-full max-w-md bg-base-100 z-50 shadow-xl flex flex-col">
        {{-- Header --}}
        <div class="px-6 py-4 border-b border-base-300">
            <h2 class="text-lg font-semibold">{{ $title }}</h2>
            @if ($description)
                <p class="text-sm opacity-70">
                    {{ $description }}
                </p>
            @endif
        </div>

        {{-- Body --}}
        <div class="flex-1 overflow-y-auto px-6 py-4 space-y-4">
            {{ $slot }}
        </div>

        {{-- Footer --}}
        <div class="px-6 py-4 border-t border-base-300 flex justify-end gap-2">
            <button type="button" class="btn btn-ghost" @click="$dispatch('close-slideover', name)">
                Cancel
            </button>

            <button type="button" class="btn btn-primary" wire:click="{{ $action }}">
                {{ $buttonText }}
            </button>
        </div>
    </div>
</div>
