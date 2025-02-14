<?php

namespace App\Providers;
use Illuminate\Http\Response;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

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
    // public function boot(): void
    // {
    //     //
    // }




    //when i am using ngrok for fixing the html template
    public function boot()
    {
        // Fix https when using ngrok
        if (
            isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
            (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')
        ) {
            $this->app['request']->server->set('HTTPS', true);
        }

        //for receptcha
        // Custom validation rule to prevent disposable emails
        Validator::extend('not_disposable_email', function ($attribute, $value, $parameters, $validator) {
            $disposableEmails = ['mailinator.com', '10minutemail.com', 'tempmail.com']; // Add more disposable email providers
            $domain = substr(strrchr($value, "@"), 1); // Extract domain from email
            return !in_array($domain, $disposableEmails);
        });

        // Custom error message for disposable email validation
        Validator::replacer('not_disposable_email', function ($message, $attribute, $rule, $parameters) {
            return 'Disposable email addresses are not allowed. Please use a valid email.';
        });
    
    }
}
