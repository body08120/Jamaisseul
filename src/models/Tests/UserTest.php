<?php
require_once('helpers/autoloader.php');

class UserTest extends PHPUnit\Framework\TestCase
{

    public function testGettersAndSetters()
    {
        $user = new User('', '', '', '', '');

        $user->setUsername('chat');
        $user->setEmail('chat@miaou.com');
        $user->setPassword('passwordHash');
        $user->setPicture('http://siteweb.com/img');
        $user->setDescPicture('descPicture');

        $this->assertEquals('chat', $user->getUsername(), 'erreur sur setUsername');
        $this->assertEquals('chien@example.com', $user->getEmail(), 'erreur sur setEmail');
        $this->assertEquals('passwordHash', $user->getPassword(), 'erreur sur setPassword');
        $this->assertEquals('http://siteweb.com/img', $user->getPicture(), 'erreur sur setPicture');
        $this->assertEquals('descPicture', $user->getDescPicture(), 'erreur sur setDescPicture');
    }
}
?>