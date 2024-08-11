Vytvoril som si cez PHPMYADMIN tabuľku SQL príkazom:
CREATE TABLE survey_responses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    comments TEXT,
    terms_accepted BOOLEAN NOT NULL,
    interests TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

Tabuľku som napĺňal manuálne.

Dostupné routy sú:
/survey
/results +stránkovanie
![image](https://github.com/user-attachments/assets/77fc1378-c8a3-4755-b9f5-b135bc2da5bc)
![image](https://github.com/user-attachments/assets/7b639242-3a4e-4cdd-923f-91c78cfb276d)
![image](https://github.com/user-attachments/assets/6b410b70-d2b2-4287-bd61-0c500923f95b)


v "common.neon" a vo file "SurveyRepositoryTest.phpt" som nastavil hodnoty pre spojenie s Databázou

v "Bootstrap.php" $configurator->setDebugMode(true);  - na prode samozrejme vypnúť

Test som spustil cez príkaz:vendor/bin/tester tests/SurveyRepositoryTest.phpt
![image](https://github.com/user-attachments/assets/26a19ca6-06d1-4524-8742-8ca1ee3dfb47)
