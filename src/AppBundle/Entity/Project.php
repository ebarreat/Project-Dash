<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Project
 *
 * @ORM\Table(name="project")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectRepository")
 */
class Project
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
     * @var string
     *
     * @ORM\Column(name="projectName", type="string", length=255, nullable=true)
     */
    private $projectName;

    /**
     * @var string
     *
     * @ORM\Column(name="projectDesc", type="text")
     */
    private $projectDesc;

    /**
     * @var int
     *
     * @ORM\Column(name="assignedTo", type="integer", nullable=true)
     */
    private $assignedTo;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="endDate", type="datetime", nullable=true)
     */
    private $endDate;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ProjectNote", mappedBy="project")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     * @ORM\OrderBy({"createdAt" = "DESC" })
     */
    private $notes;

    /**
     * Project constructor.
     */
    public function __construct() {

        $this->notes = new ArrayCollection();
    }

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
     * @return ArrayCollection|ProjectNote[]
     */
    public function getNotes() {
      return $this->notes;
    }
  
    /**
     * Set projectName
     *
     * @param string $projectName
     *
     * @return Project
     */
    public function setProjectName($projectName)
    {
        $this->projectName = $projectName;

        return $this;
    }

    /**
     * Get projectName
     *
     * @return string
     */
    public function getProjectName()
    {
        return $this->projectName;
    }

    /**
     * Set projectDesc
     *
     * @param string $projectDesc
     *
     * @return Project
     */
    public function setProjectDesc($projectDesc)
    {
        $this->projectDesc = $projectDesc;

        return $this;
    }

    /**
     * Get projectDesc
     *
     * @return string
     */
    public function getProjectDesc()
    {
        return $this->projectDesc;
    }

    /**
     * Set assignedTo
     *
     * @param integer $assignedTo
     *
     * @return Project
     */
    public function setAssignedTo($assignedTo)
    {
        $this->assignedTo = $assignedTo;

        return $this;
    }

    /**
     * Get assignedTo
     *
     * @return int
     */
    public function getAssignedTo()
    {
        return $this->assignedTo;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     *
     * @return Project
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     *
     * @return Project
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }
}

