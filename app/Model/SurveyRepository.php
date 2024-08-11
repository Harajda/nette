<?php

namespace App\Model;

use Nette;
use Nette\Database\Explorer;

class SurveyRepository
{
    private $database;

    public function __construct(Explorer $database) {
        $this->database = $database; 
    }

    public function addSurveyResponse($data): void
    {
        $interests = implode(', ', $data->interests);
        $this->database->table('survey_responses')->insert([
            'name' => $data->name,
            'comments' => $data->comments,
            'terms_accepted' => $data->terms_accepted,
            'interests' => $interests
        ]);
    }

    public function getAllResponses(?string $filter = '', string $sort = 'name', int $page = 1, int $itemsPerPage = 10): array
    {
        $offset = ($page - 1) * $itemsPerPage;

        // Vytvorenie SQL dotazu s LIMIT a OFFSET
        $sql = 'SELECT * FROM survey_responses';

        // Pridanie filtra
        if ($filter !== '') {
            $sql .= ' WHERE name LIKE ?';
            $params[] = "%$filter%";
        }

        // Pridanie radenia
        if (in_array($sort, ['name', 'comments', 'interests'])) {
            $sql .= ' ORDER BY ' . $sort;
        }

        // Pridanie LIMIT a OFFSET
        $sql .= ' LIMIT ? OFFSET ?';
        $params[] = $itemsPerPage;
        $params[] = $offset;

        // Vykonanie dotazu
        $result = $this->database->query($sql, ...$params);

        // Vrátite výsledky ako pole
        return $result->fetchAll();
    }

    public function getTotalCount(?string $filter = ''): int
    {
        $sql = 'SELECT COUNT(*) FROM survey_responses';

        // Pridanie filtra
        if ($filter !== '') {
            $sql .= ' WHERE name LIKE ?';
            $params[] = "%$filter%";
        } else {
            $params = [];
        }

        // Vykonanie dotazu
        return $this->database->fetchField($sql, $params);
    }
}
