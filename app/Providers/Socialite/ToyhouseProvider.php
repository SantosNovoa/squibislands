<?php

namespace App\Providers\Socialite;

use GuzzleHttp\RequestOptions;
use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User;

<<<<<<< HEAD
class ToyhouseProvider extends AbstractProvider implements ProviderInterface {
    protected $scopes = [];

    public function getRedirectUrl() {
        return $this->redirectUrl;
    }

=======
class ToyhouseProvider extends AbstractProvider implements ProviderInterface
{
    protected $scopes = [];

>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * Get the authentication URL for the provider.
     *
     * @param string $state
     *
     * @return string
     */
<<<<<<< HEAD
    protected function getAuthUrl($state) {
=======
    protected function getAuthUrl($state)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return $this->buildAuthUrlFromBase('https://toyhou.se/~oauth/authorize', $state);
    }

    /**
     * Get the token URL for the provider.
     *
     * @return string
     */
<<<<<<< HEAD
    protected function getTokenUrl() {
=======
    protected function getTokenUrl()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return 'https://toyhou.se/~oauth/token';
    }

    /**
     * Get the raw user for the given access token.
     *
     * @param string $token
     *
     * @return array
     */
<<<<<<< HEAD
    protected function getUserByToken($token) {
=======
    protected function getUserByToken($token)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        $response = $this->getHttpClient()->get(
            'https://toyhou.se/~api/v1/me',
            [
                RequestOptions::HEADERS => [
                    'Authorization' => 'Bearer '.$token,
                ],
            ]
        );

        return json_decode($response->getBody(), true);
    }

    /**
     * Map the raw user array to a Socialite User instance.
     *
<<<<<<< HEAD
     * @return User
     */
    protected function mapUserToObject(array $user) {
=======
     * @return \Laravel\Socialite\Two\User
     */
    protected function mapUserToObject(array $user)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return (new User)->setRaw($user)->map([
            'id'   => $user['id'], 'nickname' => $user['username'],
            'name' => null, 'email' => null, 'avatar' => $user['avatar'],
        ]);
    }
}
