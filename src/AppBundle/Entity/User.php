<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraint as Assert;
use Symfony\Component\Security\Core\Role\Role;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 * @UniqueEntity(fields={'username'}, message="Username already exists")
 */
class User implements UserInterface {

  /**
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   * @ORM\Column(type="integer")
   */
  private $id;

  /**
   * @Assert\NotBlank()
   * @ORM\Column(type="string", unique=true)
   */
  private $username;

  /**
   * non-persisted field that's used to create the encoded password.
   * @Assert\NotBlank()
   * @var string
   */
  private $plainPassword;

  /**
   * @ORM\Column()
   */
  private $password;

  /**
   * @ORM\Column(type="json_array")
   */
  private $roles = [];
  
  public function getUsername() {
    return $this->username;
  }

  public function getRoles() {

    $roles = $this->roles;

    if (!in_array('ROLE_USER', $roles)){
      $roles = 'ROLE_USER';
    }
    return $roles;
  }

  /**
   * @param mixed $roles
   */
  public function setRoles(array $roles) {
    $this->roles = $roles;
  }

  public function getPassword() {
    return $this->password;
  }

  public function setPassword($password) {
    $this->password = $password;
  }

  /**
   * @return string
   */
  public function getPlainPassword() {
    return $this->plainPassword;
  }

  /**
   * @param string $plainPassword
   */
  public function setPlainPassword($plainPassword) {
    $this->plainPassword = $plainPassword;

    $this->plainPassword = NULL;
  }

  public function getSalt() {
    // TODO: Implement getSalt() method.
  }


  public function eraseCredentials() {
    $this->plainPassword = NULL;
  }

  public function setUserName($username){
    $this->username = $username;
  }
}