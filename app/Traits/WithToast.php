<?php

namespace App\Traits;

trait WithToast
{
    public function toast(
        string $message,
        string $type = 'success',
        int $duration = 4000
    ): void {
        $this->dispatch(
            'toast',
            compact('message', 'type', 'duration')
        );
    }
}
