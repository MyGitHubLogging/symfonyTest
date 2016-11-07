<?php

namespace CG\SocialBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use CG\SocialBundle\Entity\Message;

/**
 * @ORM\Entity(repositoryClass="CG\SocialBundle\Repository\TopicRepository")
 * @ORM\Table(name="cg_topic") 
 */
class Topic extends Message
{

    /**
     * @ORM\Id 
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO") 
     */
    private $id;

    /**
     *  @ORM\OneToMany(targetEntity="CG\SocialBundle\Entity\Response", mappedBy="topic")
     */
    private $responses;

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Topic
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set text
     *
     * @param string $text
     *
     * @return Topic
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set datetimeCreate
     *
     * @param \DateTime $datetimeCreate
     *
     * @return Topic
     */
    public function setDatetimeCreate($datetimeCreate)
    {
        $this->datetimeCreate = $datetimeCreate;

        return $this;
    }

    /**
     * Get datetimeCreate
     *
     * @return \DateTime
     */
    public function getDatetimeCreate()
    {
        return $this->datetimeCreate;
    }

    /**
     * Set datetimeEdit
     *
     * @param \DateTime $datetimeEdit
     *
     * @return Topic
     */
    public function setDatetimeEdit($datetimeEdit)
    {
        $this->datetimeEdit = $datetimeEdit;

        return $this;
    }

    /**
     * Get datetimeEdit
     *
     * @return \DateTime
     */
    public function getDatetimeEdit()
    {
        return $this->datetimeEdit;
    }

    /**
     * Set deleted
     *
     * @param boolean $deleted
     *
     * @return Topic
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * Get deleted
     *
     * @return boolean
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * Set user
     *
     * @param \CG\UserBundle\Entity\User $user
     *
     * @return Topic
     */
    public function setUser(\CG\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \CG\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add response
     *
     * @param \CG\SocialBundle\Entity\Response $response
     *
     * @return Topic
     */
    public function addResponse(\CG\SocialBundle\Entity\Response $response)
    {
        $this->responses[] = $response;

        return $this;
    }

    /**
     * Remove response
     *
     * @param \CG\SocialBundle\Entity\Response $response
     */
    public function removeResponse(\CG\SocialBundle\Entity\Response $response)
    {
        $this->responses->removeElement($response);
    }

    /**
     * Get responses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getResponses()
    {
        return $this->responses;
    }

}
