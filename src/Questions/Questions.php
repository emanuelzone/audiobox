<?php
namespace Anax\Questions;
 
/**
 * Model for Questions.
 *
 */
class Questions extends \Anax\MVC\CDatabaseModel
{

     /**
     * Setup table for questions.
     */
    public function setup()
    {
        $this->db->dropTableIfExists('questions')->execute();
 
        $this->db->createTable(
            'questions',
            [
                'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
                'userId' => ['integer', 'not null'],
                'subject' => ['char(255)'],
                'text' => ['text'],
				'iframe' => ['text'],
                'created' => ['datetime'],
                'updated' => ['datetime'],
                'deleted' => ['datetime'],
            ]
        )->execute();

     
        $now = gmdate('Y-m-d H:i:s');
     
        $this->create([
            'userId' => '1',
            'subject' => 'Sunset on Stereo - Best of Melodic Progressive House & Trance 2015',
            'text' => 'Emanuelzone presents the best of Melodic Progressive House & Trance 2015. This is a tribute compilation to all the artists who create this amazing music. I guarantee a emontioinell journey in the world of amazing music with the hottest artists out there.',
			'iframe' => '<iframe width="100%" height="315" src="https://www.youtube.com/embed/IVCet9SQmrY" frameborder="0" allowfullscreen></iframe>',
            'created' => $now
        ]);
     
        $this->create([
            'userId' => '2',
            'subject' => 'Gouryella will be back on stage',
            'text' => 'Ferry Corsten: "I’m excited to finally be revealing to you all the news that Gouryella will be making its stage debut in 2016! Having spent a long time over the past 5 to 6 years thinking about Gouryella and working on ideas but not quite finding the right production that I felt was suitable for the project. It was a really pleasing moment when I unveiled ‘Anahera’ as the first Gouryella single after such a long time."',
            'created' => $now
        ]);
		
		        $this->create([
            'userId' => '3',
            'subject' => 'In Depth With... Solarstone & Gai Barone On Pure Trance V4!',
            'text' => 'Pure Trance’ turned 4 this autumn. All in all it’s a pretty extraordinary paradox of a sub-genre, one that uniquely manages to look both forward and back at the same time. On the occasion of its release we swung by the Solar studios, to have a tête-à-tête with its inceptor-in-chief and his latest co-mixer, Gai Barone."',
            'created' => $now
        ]);
		
				        $this->create([
            'userId' => '4',
            'subject' => 'Willem de Roo interview',
            'text' => 'Hailing from Groningen, The Netherlands, young hot-shot producer/dj Willem de Roo has over the past few years firmly stated his name more and more in the global electronic scene, with a string of high quality productions and remixes, seeing him rise steadly as one of the names to look out for, and making a big impact with his sound! "',
            'created' => $now
        ]);
		
						        $this->create([
            'userId' => '5',
            'subject' => 'Lorem ipsum dolor sit amet',
            'text' => 'Donec euismod molestie erat iaculis rhoncus. Nulla et lacinia enim. Duis orci enim, imperdiet non sem vitae, eleifend pharetra mi. Aliquam euismod dictum finibus. Vestibulum sed neque libero. Mauris enim erat, porta at volutpat egestas, rutrum nec sem. Etiam felis erat, tempus nec scelerisque sed, commodo ut metus. Pellentesque imperdiet ornare tempus. Duis finibus lobortis orci ac lacinia.',
            'created' => $now
        ]);
		$this->create([
		    'userId' => '1',
            'subject' => 'Lorem ipsum dolor sit amet',
            'text' => 'Donec euismod molestie erat iaculis rhoncus. Nulla et lacinia enim. Duis orci enim, imperdiet non sem vitae, eleifend pharetra mi. Aliquam euismod dictum finibus. Vestibulum sed neque libero. Mauris enim erat, porta at volutpat egestas, rutrum nec sem. Etiam felis erat, tempus nec scelerisque sed, commodo ut metus. Pellentesque imperdiet ornare tempus. Duis finibus lobortis orci ac lacinia.',
            'created' => $now
        ]);
		$this->create([
		    'userId' => '2',
            'subject' => 'Lorem ipsum dolor sit amet',
            'text' => 'Donec euismod molestie erat iaculis rhoncus. Nulla et lacinia enim. Duis orci enim, imperdiet non sem vitae, eleifend pharetra mi. Aliquam euismod dictum finibus. Vestibulum sed neque libero. Mauris enim erat, porta at volutpat egestas, rutrum nec sem. Etiam felis erat, tempus nec scelerisque sed, commodo ut metus. Pellentesque imperdiet ornare tempus. Duis finibus lobortis orci ac lacinia.',
            'created' => $now
        ]);
		$this->create([
		    'userId' => '3',
            'subject' => 'Lorem ipsum dolor sit amet',
            'text' => 'Donec euismod molestie erat iaculis rhoncus. Nulla et lacinia enim. Duis orci enim, imperdiet non sem vitae, eleifend pharetra mi. Aliquam euismod dictum finibus. Vestibulum sed neque libero. Mauris enim erat, porta at volutpat egestas, rutrum nec sem. Etiam felis erat, tempus nec scelerisque sed, commodo ut metus. Pellentesque imperdiet ornare tempus. Duis finibus lobortis orci ac lacinia.',
            'created' => $now
        ]);
		$this->create([
		    'userId' => '4',
            'subject' => 'Lorem ipsum dolor sit amet',
            'text' => 'Donec euismod molestie erat iaculis rhoncus. Nulla et lacinia enim. Duis orci enim, imperdiet non sem vitae, eleifend pharetra mi. Aliquam euismod dictum finibus. Vestibulum sed neque libero. Mauris enim erat, porta at volutpat egestas, rutrum nec sem. Etiam felis erat, tempus nec scelerisque sed, commodo ut metus. Pellentesque imperdiet ornare tempus. Duis finibus lobortis orci ac lacinia.',
            'created' => $now
        ]);
		$this->create([
		    'userId' => '5',
            'subject' => 'Lorem ipsum dolor sit amet',
            'text' => 'Donec euismod molestie erat iaculis rhoncus. Nulla et lacinia enim. Duis orci enim, imperdiet non sem vitae, eleifend pharetra mi. Aliquam euismod dictum finibus. Vestibulum sed neque libero. Mauris enim erat, porta at volutpat egestas, rutrum nec sem. Etiam felis erat, tempus nec scelerisque sed, commodo ut metus. Pellentesque imperdiet ornare tempus. Duis finibus lobortis orci ac lacinia.',
            'created' => $now
        ]);
		$this->create([
		    'userId' => '1',
            'subject' => 'Lorem ipsum dolor sit amet',
            'text' => 'Donec euismod molestie erat iaculis rhoncus. Nulla et lacinia enim. Duis orci enim, imperdiet non sem vitae, eleifend pharetra mi. Aliquam euismod dictum finibus. Vestibulum sed neque libero. Mauris enim erat, porta at volutpat egestas, rutrum nec sem. Etiam felis erat, tempus nec scelerisque sed, commodo ut metus. Pellentesque imperdiet ornare tempus. Duis finibus lobortis orci ac lacinia.',
            'created' => $now
        ]);
		$this->create([
		    'userId' => '2',
            'subject' => 'Lorem ipsum dolor sit amet',
            'text' => 'Donec euismod molestie erat iaculis rhoncus. Nulla et lacinia enim. Duis orci enim, imperdiet non sem vitae, eleifend pharetra mi. Aliquam euismod dictum finibus. Vestibulum sed neque libero. Mauris enim erat, porta at volutpat egestas, rutrum nec sem. Etiam felis erat, tempus nec scelerisque sed, commodo ut metus. Pellentesque imperdiet ornare tempus. Duis finibus lobortis orci ac lacinia.',
            'created' => $now
        ]);
		



    }


    public function getQuestionsForUser($id) {
        $this->db->select()
        ->from($this->getSource())
        ->where("userId = ?");
        $this->db->execute([$id]);
        $this->db->setFetchModeClass(__CLASS__);
        return $this->db->fetchAll();
    }

    public function getLatestQuestions($limit) {
        $this->db->select()
        ->from($this->getSource())
        ->orderby('created DESC')
        ->limit($limit);
        $this->db->execute();
        $this->db->setFetchModeClass(__CLASS__);
        return $this->db->fetchAll();
    }
}