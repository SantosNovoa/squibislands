<?php

namespace App\Providers;

<<<<<<< HEAD
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider {
=======
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
<<<<<<< HEAD
        Registered::class                                     => [
            SendEmailVerificationNotification::class,
        ],

        \SocialiteProviders\Manager\SocialiteWasCalled::class => [
            'SocialiteProviders\\Deviantart\\DeviantartExtendSocialite@handle',
=======
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        
        \SocialiteProviders\Manager\SocialiteWasCalled::class => [
            'SocialiteProviders\\Deviantart\\DeviantartExtendSocialite@handle',
            'SocialiteProviders\\Twitter\\TwitterExtendSocialite@handle',
>>>>>>> Cylunny/extension/polls-and-forms
            'SocialiteProviders\\Instagram\\InstagramExtendSocialite@handle',
            'SocialiteProviders\\Tumblr\\TumblrExtendSocialite@handle',
            'SocialiteProviders\\Imgur\\ImgurExtendSocialite@handle',
            'SocialiteProviders\\Twitch\\TwitchExtendSocialite@handle',
<<<<<<< HEAD
            'SocialiteProviders\\Discord\\DiscordExtendSocialite@handle',
        ],
=======
        ]
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**
     * Register any events for your application.
<<<<<<< HEAD
     */
    public function boot() {
=======
     *
     * @return void
     */
    public function boot()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        parent::boot();

        //
    }
}
