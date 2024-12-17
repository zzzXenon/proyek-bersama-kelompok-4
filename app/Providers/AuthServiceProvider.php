<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User;
use App\Policies\RolePolicy;

class AuthServiceProvider extends ServiceProvider
{
  /**
   * The policy mappings for the application.
   *
   * @var array
   */
  protected $policies = [
    User::class => RolePolicy::class,
  ];

  /**
   * Register any application services.
   *
   * @return void
   */
  public function boot()
  {
    $this->registerPolicies();
  }
}
