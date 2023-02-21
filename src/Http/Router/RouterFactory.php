<?php
/**
 * Copyright (c) 2023 Strategio Digital s.r.o.
 * @author Jiří Zapletal (https://strategio.dev, jz@strategio.dev)
 */
declare(strict_types=1);

namespace App\Http\Router;

use App\Http\Controller\AboutController;
use App\Http\Controller\HomeController;
use Symfony\Component\Routing\Matcher\UrlMatcher;

class RouterFactory extends \Saas\Http\Router\RouterFactory
{
    public function create(): UrlMatcher
    {
        // Homepage
        $this->add('GET', '/', [HomeController::class, 'index'], [], 'home');
        $this->add('GET', '/about-me', [AboutController::class, 'index'], [], 'about');
        
        return parent::create();
    }
}
