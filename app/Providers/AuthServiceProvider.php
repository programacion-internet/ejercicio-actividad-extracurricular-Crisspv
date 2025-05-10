<?php

use App\Models\ArchivoEvento;
use App\Policies\ArchivoEventoPolicy;
use Illuminate\Support\Facades\Gate;


protected $policies = [
    ArchivoEvento::class => ArchivoEventoPolicy::class,
];

use Illuminate\Support\Facades\Gate;

public function boot(): void
{
    $this->registerPolicies();
}
