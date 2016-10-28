<?php

namespace CG\SocialBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use CG\SocialBundle\Entity\Message;

/**
 * @ORM\Entity(repositoryClass="CG\SocialBundle\Repository\Repository\ResponseRepository")
 * @ORM\Table(name="cg_response") 
 */
class Response extends Message {

    /**
     * @ORM\Id 
     * @ORM\Column(type="integer") 
     * @ORM\GeneratedValue(strategy="AUTO") 
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="CG\SocialBundle\Entity\Topic", inversedBy="responses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $topic;

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Response
     */
    public function setId($id) {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set text
     *
     * @param string $text
     *
     * @return Response
     */
    public function setText($text) {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText() {
        return $this->text;
    }

    /**
     * Set datetimeCreate
     *
     * @param \DateTime $datetimeCreate
     *
     * @return Response
     */
    public function setDatetimeCreate($datetimeCreate) {
        $this->datetimeCreate = $datetimeCreate;

        return $this;
    }

    /**
     * Get datetimeCreate
     *
     * @return \DateTime
     */
    public function getDatetimeCreate() {
        return $this->datetimeCreate;
    }

    /**
     * Set datetimeEdit
     *
     * @param \DateTime $datetimeEdit
     *
     * @return Response
     */
    public function setDatetimeEdit($datetimeEdit) {
        $this->datetimeEdit = $datetimeEdit;

        return $this;
    }

    /**
     * Get datetimeEdit
     *
     * @return \DateTime
     */
    public function getDatetimeEdit() {
        return $this->datetimeEdit;
    }

    /**
     * Set deleted
     *
     * @param boolean $deleted
     *
     * @return Response
     */
    public function setDeleted($deleted) {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * Get deleted
     *
     * @return boolean
     */
    public function getDeleted() {
        return $this->deleted;
    }

    /**
     * Set user
     *
     * @param \CG\UserBundle\Entity\User $user
     *
     * @return Response
     */
    public function setUser(\CG\UserBundle\Entity\User $user = null) {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \CG\UserBundle\Entity\User
     */
    public function getUser() {
        return $this->user;
    }


    /**
     * Set topic
     *
     * @param \CG\SocialBundle\Entity\Topic $topic
     *
     * @return Response
     */
    public function setTopic(\CG\SocialBundle\Entity\Topic $topic)
    {
        $this->topic = $topic;

        return $this;
    }

    /**
     * Get topic
     *
     * @return \CG\SocialBundle\Entity\Topic
     */
    public function getTopic()
    {
        return $this->topic;
    }
}
