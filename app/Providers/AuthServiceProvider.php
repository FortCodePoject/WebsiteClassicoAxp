<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        VerifyEmail::toMailUsing(function($notifiable, $url){
            return (new MailMessage)
            ->subject('WebSite Clássico - AxP')
            ->line('Bem-Vindo ao seu website clássico')
            ->line('Clique no botão abaixo para verificar o seu endereço de e-mail e a sua conta.')
            ->action('Verificar Conta', $url)
            ->line('Se não tiver criado uma conta, não será necessária qualquer ação adicional. Cumprimentos,');
        });
    }
}
