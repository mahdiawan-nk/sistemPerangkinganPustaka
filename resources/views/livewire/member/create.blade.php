<div>
    <x-ui.slide-over name="create-member" title="Add Member" description="Create new member" button-text="Save"
        action="saveMember">
        <flux:input type="text" label="ID Anggota" wire:model="form.slims_member_id" description="ID Anggota NIM/NRP/NOKTP"/>
        <flux:input type="text" label="Nama Anggota" wire:model="form.name" />
        <flux:input type="email" label="Email Anggota" wire:model="form.email" />
        <flux:input type="number" label="Phone Anggota" wire:model="form.phone" />
        <flux:textarea label="Alamat Anggota" wire:model="form.address" />
        <flux:select wire:model="form.type" label="Type Anggota">
            <flux:select.option value="">Pilih Type</flux:select.option>
            @foreach ($types as $tp)
                <flux:select.option value="{{ $tp }}">{{ $tp }}</flux:select.option>
            @endforeach
        </flux:select>
    </x-ui.slide-over>
</div>
