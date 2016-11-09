<?php

namespace CG\UserBundle\DataFixture\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CG\SocialBundle\Entity\Response;

class LoadResponse extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {

        $responses = array(
            array(
                'user' => $this->getReference('user1'),
                'topic' => $this->getReference('t1'),
                'text' => 'response1 from user1 to topic1',
                'deleted' => false,
            ),
            array(
                'user' => $this->getReference('user2'),
                'topic' => $this->getReference('t1'),
                'text' => 'response2 from user2 to topic1',
                'deleted' => false,
            ),
            array(
                'user' => $this->getReference('user1'),
                'topic' => $this->getReference('t1'),
                'text' => 'response3 from user1 to topic1 DELETED',
                'deleted' => true,
            ),
            array(
                'user' => $this->getReference('user1'),
                'topic' => $this->getReference('t1'),
                'text' => 'response4 from user1 to topic1',
                'deleted' => false,
            ),
            array(
                'user' => $this->getReference('user1'),
                'topic' => $this->getReference('t1'),
                'text' => 'response1 from user1 to topic2',
                'deleted' => false,
            ),
            array(
                'user' => $this->getReference('user1'),
                'topic' => $this->getReference('t2'),
                'text' => 'response1 from user1 to topic2',
                'deleted' => false,
            ),
        );

        foreach ($responses as $newResponse) {
            $response = new Response;
            $response->setUser($newResponse['user']);
            $response->setText($newResponse['text']);
            $response->setTopic($newResponse['topic']);
            $response->setDeleted($newResponse['deleted']);
            $manager->persist($response);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }

}
