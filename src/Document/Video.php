<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Security\Core\User\UserInterface;
/**
 * @MongoDB\Document
 */
class Video implements UserInterface
{
    /**
     * @MongoDB\Id
     */
    protected  $id;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $titre;

    /**
     * @MongoDB\Field(type="string")
     */
    public $chemin;
    /**
     * @MongoDB\Field(type="string")
     */
    protected $playlistid;

    public function getId()
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }
    public function getChemin(): ?string
    {
        return $this->chemin;
    }
    public function setTitre($titre)
    {
        $this->titre=$titre;
    }

    public function setPlayListid($idUser)
    {
        $this->playlistid=$idUser;
    }

    /**
     * Returns the roles granted to the user.
     *
     *     public function getRoles()
     *     {
     *         return ['ROLE_USER'];
     *     }
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
    /**
     * @return mixed
     */
    public function getUsername()
    {

    }

    /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * @return string The password
     */
    public function getPassword()
    {
        // TODO: Implement getPassword() method.
    }
}
