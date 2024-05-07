<?php

namespace App\Jobs;

// use App\Http\Controllers\ProductServices;
use App\Http\Controllers\Product\ProductServices;
use App\Http\Requests\ProductRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProductJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(ProductServices $services, ProductRequest $request)
    {
        //
        $this->services = $services;
        $this->request = $request;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        $this->services->update($this->request->all());
    }
}
