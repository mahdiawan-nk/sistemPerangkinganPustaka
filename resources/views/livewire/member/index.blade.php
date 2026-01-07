<div class="py-6 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">

        {{-- Header --}}
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h1 class="text-2xl font-semibold text-base-content">
                Data Members
            </h1>
            <div class="flex gap-2">
                <button x-on:click="$dispatch('open-slideover', 'create-member')" class="btn btn-sm btn-primary">
                    Add Member
                </button>
            </div>
        </div>

        {{-- Card --}}
        <div class="mt-6 card bg-base-100 shadow border border-base-300">

            {{-- Filter --}}
            <div class="p-4 flex flex-col sm:flex-row gap-3 justify-between">
                <select wire:model.live="perPage" class="select select-sm select-bordered w-28">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                <select wire:model.live="filterType" class="select select-sm select-bordered w-28">
                    <option value="">Semua</option>
                    @foreach ($types as $tp)
                        <option value="{{ $tp }}">{{ $tp }}</option>
                    @endforeach

                </select>
                <input type="search" wire:model.live.debounce.400ms="search" placeholder="Search name or email..."
                    class="input input-sm input-bordered w-full sm:w-90" />
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <thead class="bg-base-200">
                        <tr>
                            <th>#</th>
                            <th>Member ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Type</th>
                            <th>Register</th>
                            <th>Expire</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($members as $member)
                            <tr wire:key="member-{{ $member->id }}">
                                <td>{{ $loop->iteration + $members->firstItem() - 1 }}</td>
                                <td class="font-medium">{{ $member->slims_member_id }}</td>
                                <td class="font-medium">{{ $member->name }}</td>
                                <td>{{ $member->email ?? '-' }}</td>
                                <td>{{ $member->phone ?? '-' }}</td>
                                <td>
                                    <span class="badge badge-outline">
                                        {{ $member->type }}
                                    </span>
                                </td>
                                <td>{{ $member->register_date }}</td>
                                <td>{{ $member->expire_date }}</td>
                                <td class="text-center space-x-1">
                                    <button wire:click="edit({{ $member->id }})" class="btn btn-xs btn-warning">
                                        Edit
                                        </b>

                                        <button wire:click="openDelete({{ $member->id }})"
                                            class="btn btn-xs btn-error">
                                            Delete
                                        </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-10 opacity-60">
                                    No data found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Footer --}}
            <div class="p-4 flex flex-col sm:flex-row gap-2 items-center justify-between text-sm">
                <div>
                    Showing
                    <strong>{{ $members->firstItem() }}</strong>
                    to
                    <strong>{{ $members->lastItem() }}</strong>
                    of
                    <strong>{{ $members->total() }}</strong>
                </div>

                {{-- {{ $members->links() }} --}}
                @if ($members instanceof \Illuminate\Pagination\LengthAwarePaginator && $members->hasPages())
                    <div class="join grid grid-cols-2">
                        @if ($members && $members->onFirstPage())
                            <button class="join-item btn btn-outline" disabled>Previous page</button>
                        @else
                            <button class="join-item btn btn-outline" wire:click="previousPage">Previous page</button>
                        @endif
                        @if ($members && $members->hasMorePages())
                            <button class="join-item btn btn-outline" wire:click="nextPage">Next</button>
                        @else
                            <button class="join-item btn btn-outline" disabled>Next</button>
                        @endif
                    </div>
                @endif
            </div>

        </div>

    </div>
    <livewire:member.create wire:key="create-member" />
    <livewire:member.update :member="$selectedId" wire:key="update-member-{{ $selectedId }}" />
    <flux:modal name="confirm" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Delete Member?</flux:heading>
                <flux:text class="mt-2">
                    You're about to delete this member.<br>
                    This action cannot be reversed.
                </flux:text>
            </div>
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="danger" wire:click="delete({{ $selectedId }})">Delete member
                </flux:button>
            </div>
        </div>
    </flux:modal>
</div>
