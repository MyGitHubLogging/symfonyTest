<?php

namespace CG\SocialBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\MappedSuperclass
 */
class Message {
    
    /**
     * @ORM\ManyToOne(targetEntity="CG\UserBundle\Entity\User")
     */
    protected $user;
    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank() 
     */
    protected $text;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank() 
     */
    protected $datetimeCreate;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank() 
     */
    protected $datetimeEdit;

    /**
     * @ORM\Column(type="boolean")
     * 
     */
    protected $deleted = 0;

    public function __construct() {
        $this->datetimeCreate = new \Datetime();
        $this->datetimeEdit = new \Datetime();  
    }

}
