<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full max-w-7xl mx-auto flex-1 flex-col gap-4 rounded-xl">
        <livewire:dashboard.stats />
        <livewire:dashboard.visitor-ranking />
        <livewire:dashboard.visitor-overview />
    </div>
</x-layouts.app>
