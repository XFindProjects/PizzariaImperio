<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados, copia é crime!
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 14/11/2017
 * Hora: 2:50:41
 */

namespace Tests;

use Pizzaria\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * @var
     */
    protected $token;

    /**
     * @param User|null $user
     * @param array $overrides
     * @return $this
     */
    public function signIn(User $user = null, $overrides = [])
    {
        $user = $user ?: create('Pizzaria\User', $overrides);

        $this->actingAs($user);

        return $this;
    }

    /**
     * @param User|null $user
     * @param array $overrides
     * @return $this
     */
    public function signInAndSetToken(User $user = null, $overrides = [])
    {
        $this->signIn($user, $overrides);

        $this->token = $this->getTokenEndpoint()['token'];

        return $this;
    }

    /**
     * @return array
     */
    private function getTokenEndpoint()
    {
        //  Json request to get the auth token
        return $this->getJson(route('Acl::get-user.token'))->json();
    }

    /**
     * Send Authorization headers so the api knows who is making this request
     * @param array $headers
     * @return array
     */
    public function generateAuthHeaders($headers = [])
    {
        if ($this->token) {
            $headers['Authorization'] = "Bearer " . $this->token;
        }
        $headers['X-Requested-With'] = 'XMLHttpRequest';
        return $headers;
    }

    protected function generatePaginationJsonStructure()
    {
        return [
            'current_page',
            'data' => [],
            'first_page_url',
            'from',
            'last_page',
            'last_page_url',
            'next_page_url',
            'path',
            'per_page',
            'prev_page_url',
            'to',
            'total'
        ];
    }
}
