<?php


namespace App\Mpesa;


class validateEndpoints
{
    protected $default_endpoints = [];
    protected $endpoint = null;

    /**
     * @param string $env
     * @throws \ErrorException
     */
    protected function validateEndpoints(string $env) {
        if (!$this->endpoint){
            if (!array_key_exists($env, $this->default_endpoints)) {
                throw new \ErrorException('Endpoint Missing');
            }
            $this->endpoint = $this->default_endpoints[$env];
        }
    }

}