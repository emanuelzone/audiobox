<?php
namespace Anax\Tags;
 

class Tags extends \Anax\MVC\CDatabaseModel
{

     /**
     * Setup table for tags in Audiobox.
     */
    public function setup()
    {
        $this->db->dropTableIfExists('tags')->execute();
 
        $this->db->createTable(
            'tags',
            [
                'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
                'name' => ['varchar(80)', 'not null'],
            ]
        )->execute();

        $this->create([
            'name' => 'progressive',
        ]);
     
        $this->create([
            'name' => 'trance',
        ]);
		
		$this->create([
            'name' => 'house',
        ]);
		
    }
}