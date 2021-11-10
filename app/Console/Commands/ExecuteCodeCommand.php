<?php

namespace App\Console\Commands;

use App\Enums\UnitEnum;
use Illuminate\Console\Command;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Configuration;

class ExecuteCodeCommand extends Command
{
    protected $name = 'code:execute';

    public function handle()
    {
        dd(UnitEnum::allConstantValues());

        dd(UnitEnum::isCelsius('celsius'));

        dd(is_numeric('1.3'));

        /** @var Builder $builder */
        $builder = app(Builder::class);
        /** @var Configuration $config */
        $config  = app(Configuration::class);

        $key = $builder->withClaim('uid', 12)->getToken($config->signer(), $config->signingKey());
        dd($key->toString());
    }
}
