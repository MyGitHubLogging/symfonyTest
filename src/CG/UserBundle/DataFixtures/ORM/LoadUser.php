<?php

namespace CG\UserBundle\DataFixture\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CG\UserBundle\Entity\User;

class LoadUser extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $users = array(
            array(
                'username' => 'user1',
                'email' => 'user1@mail.com',
                'password' => 'user1',
                'enabled' => true,
                'roles' => array('ROLE_USER'),
            ),
            array(
                'username' => 'user2',
                'email' => 'user2@mail.com',
                'password' => 'user2',
                'enabled' => true,
                'roles' => array('ROLE_USER')
            ),
            array(
                'username' => 'userDisabled',
                'email' => 'userDisabled@mail.com',
                'password' => 'userDisabled',
                'enabled' => false,
                'roles' => array('ROLE_USER')
            ),
            array(
                'username' => 'userAdmin',
                'email' => 'admin@mail.com',
                'password' => 'admin',
                'enabled' => true,
                'roles' => array('ROLE_ADMIN')
            ),
        );
        foreach ($users as $newUser) {
            $user = new User;
            $user->setUsername($newUser['username']);
            $user->setPlainPassword($newUser['password']);
            $user->setEmail($newUser['email']);
            $user->setRoles($newUser['roles']);
            $user->setEnabled($newUser['enabled']);
            $manager->persist($user);
            $this->addReference($newUser['username'], $user);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }

}
