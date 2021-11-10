<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;

class JWTProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerConfiguration();
        $this->registerBuilder();
    }

    private function registerConfiguration()
    {
        $this->app->bind(Configuration::class, function () {
            return Configuration::forSymmetricSigner(
                new Sha256(),
                InMemory::base64Encoded(env('JWT_SIGNING_KEY'))
            );
        });
    }

    private function registerBuilder()
    {
        $this->app->bind(Builder::class, function () {
            /** @var Configuration $config */
            $config = $this->app->make(Configuration::class);

            return $config->builder()
                ->issuedBy(env('APP_URL'))
                ->permittedFor(env('APP_URL'))
                ->issuedAt(($now = Carbon::now())->toDateTimeImmutable())
                ->expiresAt($now->addMinutes(60)->toDateTimeImmutable());
        });
    }
}
