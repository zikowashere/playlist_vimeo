<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity
 * @UniqueEntity(
 *     fields={"email"},
 *     message="cet email est deja utilisé"
 * )
 */
/**
 *
 *
 * @MongoDB\Document
 */



class User implements UserInterface
{
    /**
     * @MongoDB\Id
     */
    protected  $id;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $firstname;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $lastname;



    /**
     * @MongoDB\Field(type="string")
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     */
    protected $email;

    /**
     * @MongoDB\Field(type="string")
     * @Assert\Length(
     *      min = 5,
     *      max = 50,
     *      minMessage = "Your first name must be at least 5 characters long",
     *      maxMessage = "Your first name cannot be longer than 50 characters")
     */

    protected $password;






    public function getId()
        {
            return $this->id;
        }

        public function getFirstname(): ?string
        {
            return $this->firstname;
        }

        public function setFirstname(string $nom): self
        {
            $this->nom = $nom;

            return $this;
        }

        public function getLastname(): ?string
        {
            return $this->lastname;
        }

        public function setLastname(string $prenom): self
        {
            $this->prenom = $prenom;

            return $this;
        }

        public function getEmail(): ?string
        {
            return $this->email;
        }

        public function setEmail(string $email): self
        {
            $this->email = $email;

            return $this;
        }

        public function getPassword(): ?string
        {
            return $this->password;
        }

        public function setPassword(string $password): self
        {
            $this->password = $password;

            return $this;
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

}
