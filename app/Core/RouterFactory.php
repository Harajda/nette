<?php

declare(strict_types=1);

namespace App\Core;

use Nette;
use Nette\Application\Routers\RouteList;
use Nette\Application\Routers\Route;

final class RouterFactory
{
    use Nette\StaticClass;

    public static function createRouter(): RouteList
    {
        $router = new RouteList;

        // Defaultní routa
        //$router->addRoute('<presenter>/<action>[/<id>]', 'Home:default');

        $router->addRoute('survey', 'Survey:default'); 
        $router->addRoute('results', 'Result:default');
        $router->addRoute('results/filter', 'Result:filter');
        $router->addRoute('results/sort', 'Result:sort');
        //$router->addRoute('results[/page/<page>]', 'Result:default');

        //$router->addRoute('results[/<page \d+>]', 'Result:default');;

        // Chybové routy
        $router->addRoute('404', 'Error:Error404');

        return $router;
    }
}
