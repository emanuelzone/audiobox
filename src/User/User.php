<?php
namespace Anax\User;
 
/**
 * Model for Users.
 *
 */
class User extends \Anax\MVC\CDatabaseModel
{

    public static $loginSession = 'User::Login';
    
     /**
     * Setup table for users in Audiobox.
     *
     * @return boolean true or false if saving went okey.
     */
    public function setup()
    {
        $this->db->dropTableIfExists('user')->execute();
        $this->db->createTable(
            'user',
            [
                'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
                'acronym' => ['varchar(20)', 'unique', 'not null'],
                'email' => ['varchar(80)', 'not null'],
                'password' => ['varchar(255)', 'not null'],
                'text' => ['text'],
				'created' => ['datetime'], // Skapad
				'updated' => ['datetime'] // Uppdaterad
            ]
        )->execute();
		
		$now = gmdate('Y-m-d H:i:s');
     
        $this->create([
            'acronym' => 'Martin',
            'email' => 'martin@emanuelzone.se',
            'password' => password_hash('admin', PASSWORD_DEFAULT),
            'text' => 'Mr Admin.',
			'created' => $now
        ]);
     
        $this->create([
            'acronym' => 'Doe',
            'email' => 'doe@dbwebb.se',
            'password' => password_hash('doe', PASSWORD_DEFAULT),
            'text' => '',
			'created' => $now

        ]);

        $this->create([
            'acronym' => 'Malin',
            'email' => 'malindoe@johndoe.com',
            'password' => password_hash('malin	', PASSWORD_DEFAULT),
            'text' => 'Test User',
			'created' => $now

        ]);
		
		$this->create([
            'acronym' => 'Mathias',
            'email' => 'mathias@johndoe.com',
            'password' => password_hash('mathias	', PASSWORD_DEFAULT),
            'text' => 'Test User',
			'created' => $now
        ]);
		
		$this->create([
            'acronym' => 'Marcus',
            'email' => 'marcus@johndoe.com',
            'password' => password_hash('marcus	', PASSWORD_DEFAULT),
            'text' => 'Test User',
			'created' => $now
        ]);

    }

    /**
     * Find user and try to login
     *
     * @return this
     */
    public function login($acronym, $password)
    {
        $this->db->select()
                 ->from($this->getSource())
                 ->where("acronym = ?");
     
        $this->db->execute([$acronym]);
        $res = $this->db->fetchInto($this);

        if($res) {
            if(password_verify($password, $res->password)) {
                $this->session->set(self::$loginSession, $res->id);
                return true;
            }
            else {

                return false;
            }
        }
        else {
            return false;
        }
    }

    /**
     * Logout user
     *
     * @return this
     */
    public function logout()
    {
        unset($_SESSION[self::$loginSession]);
    }


    /**
     * Get currently logged in user
     *
     * @return obj User
     */
    public function getLoggedInUser()
    {
        if($this->isUserLoggedIn()) {
            $id = $this->session->get(self::$loginSession);
            $user = $this->find($id);
            return $user;
        }
    }


    /**
     * Is user logged in
     *
     * @return boolean
     */
    public function isUserLoggedIn()
    {
        return $this->session->has(self::$loginSession);
    }


}