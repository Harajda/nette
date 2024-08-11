<?php

declare(strict_types=1);

namespace App\UI\Survey;

use Nette;
use Nette\Application\UI\Presenter;
use Nette\Application\UI\Form;
use App\Model\SurveyRepository;


class SurveyPresenter extends Presenter
{
    private $surveyRepository;

    public function __construct(SurveyRepository $surveyRepository)
    {
        $this->surveyRepository = $surveyRepository;
    }

    //index
    public function renderDefault(): void
    {
        $this->template->title = 'Survey Form';
    }

    protected function createComponentSurveyForm(): Form
    {
        $form = new Form;

        $form->addText('name', 'Name:')
            ->setRequired('Please enter your name.')
            ->addRule(Form::MAX_LENGTH, 'Name cannot be longer than 255 characters.', 255);

        $form->addTextArea('comments', 'Comments:')
            ->addRule(Form::MAX_LENGTH, 'Comments cannot be longer than 1000 characters.', 1000);

        $form->addCheckbox('terms_accepted', 'I accept the terms and conditions.')
            ->setRequired('You must accept the terms.');

        $form->addMultiSelect('interests', 'Interests:', [
            'Reading' => 'Reading',
            'Traveling' => 'Traveling',
            'Sports' => 'Sports',
            'Music' => 'Music',
        ])->setRequired('Please select at least one interest.');

        $form->addSubmit('submit', 'Submit');

        $form->onSuccess[] = [$this, 'processSurveyForm'];

        return $form;
    }

    public function processSurveyForm(Form $form, \stdClass $values): void
    {
        $this->surveyRepository->addSurveyResponse($values);
        $this->flashMessage('Thank you for your comment.');
        $this->redirect('this');
    }
}
