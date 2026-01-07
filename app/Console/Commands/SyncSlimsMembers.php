<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Service\SlimsMemberService;

class SyncSlimsMembers extends Command
{
    protected $signature = 'slims:sync-members';
    protected $description = 'Sync members data from SLiMS API';

    public function __construct(private SlimsMemberService $service)
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('Syncing SLiMS members...');

        $total = $this->service->sync();

        $this->info("Done. {$total} members synced.");
    }
}

