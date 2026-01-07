<div x-data="{
    toasts: [],
    soundEnabled: true,
    addToast(toast) {
        this.toasts.push({ ...toast, id: Date.now() })
        if (this.soundEnabled) {
            const audio = new Audio('/sounds/success.mp3')
            audio.play()
        }
        setTimeout(() => {
            this.toasts.shift()
        }, toast.duration ?? 4000)
    }
}" x-on:toast.window="addToast($event.detail[0])" class="toast toast-top toast-end z-50">
    <template x-for="toast in toasts" :key="toast.id">
        <div class="alert"
            :class="{
                'alert-success': toast.type === 'success',
                'alert-info': toast.type === 'info',
                'alert-warning': toast.type === 'warning',
                'alert-error': toast.type === 'error'
            }">
            <span x-text="toast.message"></span>
        </div>
    </template>
</div>
