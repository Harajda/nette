<?php

declare(strict_types=1);

namespace App\UI\Result;

use Nette;
use Nette\Database\Explorer;
use Nette\Application\UI\Presenter;
use App\Model\SurveyRepository;

class ResultPresenter extends Presenter
{
    private $surveyRepository;
    private $session;

    private const ITEMS_PER_PAGE = 5;

    public function __construct(SurveyRepository $surveyRepository, Explorer $database, Nette\Http\Session $session)
    {
        parent::__construct();
        $this->surveyRepository = $surveyRepository;
        $this->session = $session->getSection('results'); // Získanie sekcie session pre výsledky
    }

    public function renderDefault(int $page = 1): void
    {
        // Načítanie parametrov zo session, ak nie sú nastavené
        $filter = $this->session->filter ?? '';
        $sort = $this->session->sort ?? 'name';
        $currentPage = $this->session->page ?? 1;

        // Aktualizácia session s novými parametrami
        $this->session->filter = $this->getHttpRequest()->getQuery('name') ?? $filter;
        $this->session->sort = $this->getHttpRequest()->getQuery('sort') ?? $sort;
        $this->session->page = $page;

        $data = $this->surveyRepository->getAllResponses($this->session->filter, $this->session->sort, $page, self::ITEMS_PER_PAGE);

        $totalCount = $this->surveyRepository->getTotalCount($this->session->filter);
        $totalPages = ceil($totalCount / self::ITEMS_PER_PAGE);

        $this->template->data = $data;
        $this->template->filter = $this->session->filter;
        $this->template->sort = $this->session->sort;
        $this->template->page = $page;
        $this->template->totalPages = $totalPages;

        $this->template->prevPage = $page > 1 ? $page - 1 : null;
        $this->template->nextPage = $page < $totalPages ? $page + 1 : null;
    }

    public function actionFilter(string $name = ''): void
    {
        $this->session->filter = $name;
        $this->redirect('default');
    }

    public function actionSort(string $sort = 'name'): void
    {
        $this->session->sort = $sort;
        $this->redirect('default');
    }
}