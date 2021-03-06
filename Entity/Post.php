<?php

namespace Simseo\ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Post
 *
 * @ORM\Table(name="simseo_forum_post")
 * @ORM\Entity(repositoryClass="Simseo\ForumBundle\Repository\PostRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Post
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="createdAt", type="datetimetz")
     */
    private $createdAt;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Simseo\ForumBundle\Entity\Topic", inversedBy="posts", cascade={"persist"})
     */
    private $topic;

    /**
     * @Gedmo\Blameable(on="create")
     * @ORM\ManyToOne(targetEntity="Symfony\Component\Security\Core\User\UserInterface")
     */
    private $author;

    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="change", field={"content"})
     * @ORM\Column(name="updatedAt", type="datetimetz", nullable=true)
     */
    private $updatedAt;

    /**
     * @var string
     *
     * @ORM\Column(name="moderateMessage", type="string", length=255, nullable=true)
     */
    private $moderateMessage;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=10000)
     */
    private $content;
    
    /**
     *
     * @var int
     * 
     * @ORM\Column(name="rating", type="integer")
     */
    private $rating = 0;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set topic
     * 
     * @param \Simseo\ForumBundle\Entity\Topic $topic
     * @return Post
     */
    public function setTopic(\Simseo\ForumBundle\Entity\Topic $topic)
    {
        $this->topic = $topic;
        return $this;
    }
    
    /**
     * Get topic
     * 
     * @return \Simseo\ForumBundle\Entity\Topic
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * Get author
     *
     * @return Symfony\Component\Security\Core\User\UserInterface
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set moderateMessage
     *
     * @param string $moderateMessage
     *
     * @return Post
     */
    public function setModerateMessage($moderateMessage)
    {
        $this->moderateMessage = $moderateMessage;

        return $this;
    }

    /**
     * Get moderateMessage
     *
     * @return string
     */
    public function getModerateMessage()
    {
        return $this->moderateMessage;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Post
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
    
    /**
     * Set rating
     * 
     * @param int $rating
     * @return Post
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
        return $this;
    }
    
    /**
     * Get rating
     * 
     * @return string
     */
    public function getRating()
    {
        return $this->rating;
    }
    /**
     * Increase rating
     */
    public function increaseRating()
    {
        $this->rating ++;
    }
    
    /**
     * Decrease rating
     */
    public function decreaseRating()
    {
        $this->rating --;
    }
    
    /**
     * @ORM\PrePersist()
     */
    public function prePersist()
    {
        $this->topic->setLastPost(new \Datetime());
    }
}

