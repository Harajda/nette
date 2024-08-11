<?php

declare(strict_types=1);

use Tester\Assert;
use Tester\TestCase;
use Nette\Database\Explorer;
use Nette\Database\Connection;
use App\Model\SurveyRepository;

require __DIR__ . '/../vendor/autoload.php';

class SurveyRepositoryTest extends TestCase
{
    private SurveyRepository $surveyRepository;
    private Explorer $explorer;

    protected function setUp(): void
    {
        // Skúste nastaviť PDO pripojenie a Explorer
        try {
            $pdo = new PDO('mysql:host=db;dbname=nette_db', 'nette_user', 'secret');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->explorer = new Explorer($pdo);
            $this->explorer->query('TRUNCATE TABLE survey_responses');
            $this->surveyRepository = new SurveyRepository($this->explorer);
        } catch (PDOException $e) {
            // Handle PDO errors
            echo 'Connection failed: ' . $e->getMessage();
            exit;
        }
    }

    public function testAddSurveyResponse(): void
    {
        $data = (object)[
            'name' => 'John Doe',
            'comments' => 'This is a test comment.',
            'terms_accepted' => true,
            'interests' => ['music', 'sports']
        ];
    
        $this->surveyRepository->addSurveyResponse($data);
    
        $row = $this->explorer->table('survey_responses')->fetch();
        
        var_dump($row);
        
        Assert::notEqual(false, $row);
        Assert::same('John Doe', $row->name);
        Assert::same('This is a test comment.', $row->comments);
        Assert::same(1, $row->terms_accepted);
        Assert::same('music, sports', $row->interests);
    }
}

// Run the test case
$test = new SurveyRepositoryTest();
$test->run();
