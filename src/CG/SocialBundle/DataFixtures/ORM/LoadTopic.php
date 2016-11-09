<?php

namespace CG\UserBundle\DataFixture\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CG\SocialBundle\Entity\Topic;

class LoadTopic extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $topics = array(
            array('user' => $this->getReference('user1'),
                'text' => 'topic1 from user1',
                'deleted' => false,
                'reference' => 't1'),
            array('user' => $this->getReference('user1'),
                'text' => 'topic2 from user1',
                'deleted' => false,
                'reference' => 't2'),
            array('user' => $this->getReference('user2'),
                'text' => 'topic3 from user2',
                'deleted' => false,
                'reference' => 't3'),
            array('user' => $this->getReference('user2'),
                'text' => 'topic4 from user2',
                'deleted' => false,
                'reference' => 't4'),
            array('user' => $this->getReference('user1'),
                'text' => 'topic5 from user1 DELETED',
                'deleted' => true,
                'reference' => 't5'),
            array('user' => $this->getReference('user1'),
                'text' => 'topic6 from user1',
                'deleted' => false,
                'reference' => 't6'),
        );
        foreach ($topics as $newTopic) {
            $topic = new Topic;
            $topic->setUser($newTopic['user']);
            $topic->setText($newTopic['text']);
            $topic->setDeleted($newTopic['deleted']);
            $manager->persist($topic);
            $this->addReference($newTopic['reference'], $topic);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }

}
