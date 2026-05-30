<?php

namespace App\Providers;

<<<<<<< HEAD
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\ServiceProvider;
=======
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
>>>>>>> 4a09523850cfeebdfa692b54279caaa0c7c1689b

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
<<<<<<< HEAD
        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url')."/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });
    }
}
=======
        Schema::defaultStringLength(191);
    }
}
>>>>>>> 4a09523850cfeebdfa692b54279caaa0c7c1689b
