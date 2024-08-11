<?php

declare(strict_types=1);

namespace App\UI\Home;

use Nette;
use Nette\Database\Explorer;
use Nette\Application\UI\Presenter;


final class HomePresenter extends Presenter
{
    private $database;

    public function __construct(Explorer $database) {
        
        $this->database = $database; 

    }
    
}
