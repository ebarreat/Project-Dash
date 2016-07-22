<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Role\Role;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User implements UserInterface {

  /**
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   * @ORM\Column(type="integer")
   */
  private $id;

  /**
   * @ORM\Column(type="string", unique=true)
   */
  private $username;

  public function getUsername() {
    return $this->username;
  }

  public function getRoles() {
    return ['ROLE_USER'];
  }

  public function getPassword() {
    // TODO: Implement getPassword() method.
  }

  public function getSalt() {
    // TODO: Implement getSalt() method.
  }


  public function eraseCredentials() {
    // TODO: Implement eraseCredentials() method.
  }

  public function setUserName($username){
    $this->username = $username;
  }
}