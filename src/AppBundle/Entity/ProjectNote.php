<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectNoteRepository")
 * @ORM\Table(name="project_note")
 */
class ProjectNote{

  /**
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   * @ORM\Column(type="integer")
   */
  private $id;

  /**
   * @ORM\Column(type="string")
   */
  private $username;

  /**
   * @ORM\Column(type="string")
   */
  private $userAvatarFileName;

  /**
   * @ORM\Column(type="text")
   */
  private $note;

  /**
   * @ORM\Column(type="datetime")
   */
  private $createdAt;

  /**
   * @ORM\ManyToOne(targetEntity="Project", inversedBy="notes")
   * @ORM\JoinColumn(nullable=false)
   */
  private $project;

  public function getId() {
    return $this->id;
  }


  public function getProject() {
    return $this->project;
  }


  public function setProject(Project $project) {
    $this->project = $project;
  }


  public function getUsername() {
    return $this->username;
  }


  public function setUsername($username) {
    $this->username = $username;
  }


  public function getUserAvatarFileName() {
    return $this->userAvatarFileName;
  }


  public function setUserAvatarFileName($userAvatarFileName) {
    $this->userAvatarFileName = $userAvatarFileName;
  }


  public function getNote() {
    return $this->note;
  }


  public function setNote($note) {
    $this->note = $note;
  }


  public function getCreatedAt() {
    return $this->createdAt;
  }


  public function setCreatedAt($createdAt) {
    $this->createdAt = $createdAt;
  }

}