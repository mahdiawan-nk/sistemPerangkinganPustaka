<div>
    <x-ui.slide-over name="update-users" title="Update Users" description="Update existing User" button-text="Save"
        action="saveUser">
        <flux:input type="text" label="Nama Pengguna" wire:model="form.name" />
        <flux:input type="email" label="Email Pengguna" wire:model="form.email" />
        <flux:fieldset>
            <flux:legend>Is Admin</flux:legend>
            <div class="space-y-3">
                <flux:switch label="Yes" wire:model="form.is_admin" align="left" />
            </div>
        </flux:fieldset>
        <flux:switch label="Update Password" wire:model.change="updatePassword" align="left" />
        @if ($updatePassword)
            <flux:input type="password" label="Password" wire:model="form.password" />
            <flux:input type="password" label="Confirm Password" wire:model="form.password_confirmation" />
        @endif
    </x-ui.slide-over>
</div>
