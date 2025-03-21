<?php

namespace App\Jobs;

use App\Models\Tenant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class DeleteDirectoryTenant implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(protected Tenant $tenant)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Caminho do diretório do tenant
        $directory = 'tenants/' . $this->tenant->id;

        // Verifica se o diretório existe
        if (Storage::disk('public')->exists($directory)) {
            // Exclui o diretório e todo o seu conteúdo
            Storage::disk('public')->deleteDirectory($directory);
        }
    }
}