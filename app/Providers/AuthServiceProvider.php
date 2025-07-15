<?php

namespace App\Providers;

use App\Models\Domain;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Pdf;
use App\Models\Profile;
use App\Models\Tenant;
use App\Models\Txt;
use App\Models\User;
use App\Models\Permission;
use App\Policies\DomainPolicy;
use App\Policies\OrderItemPolicy;
use App\Policies\OrderPolicy;
use App\Policies\PdfPolicy;
use App\Policies\ProfilePolicy;
use App\Policies\TenantPolicy;
use App\Policies\TxtPolicy;
use App\Policies\UserPolicy;
use App\Policies\PermissionPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Profile::class => ProfilePolicy::class,
        Permission::class => PermissionPolicy::class,
        Tenant::class => TenantPolicy::class,
        Domain::class => DomainPolicy::class,
        Pdf::class => PdfPolicy::class,
        Txt::class => TxtPolicy::class,
        Order::class => OrderPolicy::class,
        OrderItem::class => OrderItemPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}