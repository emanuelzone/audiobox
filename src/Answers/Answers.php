<?php
namespace Anax\Answers;
 
/**
 * Model for Answers.
 *
 */
class Answers extends \Anax\MVC\CDatabaseModel
{

     /**
     * Setup table for answers in audiobox.
     */
    public function setup()
    {
        $this->db->dropTableIfExists('answers')->execute();
 
        $this->db->createTable(
            'answers',
            [
                'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
                'userId' => ['integer', 'not null'],
                'questionId' => ['integer', 'not null'],
                'text' => ['text'],
                'created' => ['datetime'],
                'updated' => ['datetime'],
                'deleted' => ['datetime'],
            ]
        )->execute();

     
        $now = gmdate('Y-m-d H:i:s');
     
        $this->create([
            'userId' => '2',
            'questionId' => '1',
            'text' => 'Jag har väntat länge på den här mixen. Tack för det!',
            'created' => $now
        ]);

        $this->create([
            'userId' => '3',
            'questionId' => '1',
            'text' => 'Fantastisk musik. All credd till producenterna och emanuelzone för en fantstisk compilation!',
            'created' => $now
        ]);
     
        $this->create([
            'userId' => '1',
            'questionId' => '2',
            'text' => 'Thank god for Gouryella. Best producer there is!',
            'created' => $now
        ]);

    }

    public function getAnswersforQuestion($id) {
           $this->db->select()
             ->from($this->getSource())
             ->where("questionId = ?");
            $this->db->execute([$id]);
            $this->db->setFetchModeClass(__CLASS__);
            return $this->db->fetchAll();
    }


    public function getAnswersForUser($id) {
        $this->db->select()
        ->from($this->getSource())
        ->where("userId = ?");
        $this->db->execute([$id]);
        $this->db->setFetchModeClass(__CLASS__);
        return $this->db->fetchAll();
    }
}