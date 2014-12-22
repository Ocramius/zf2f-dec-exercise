<?php

namespace Market\Entity;

class User
{
    /**
     * @var string
     */
    private $username = '';

    /**
     * @var string
     */
    private $website = '';

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = (string) $username;
    }

    /**
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * @param string $website
     */
    public function setWebsite($website)
    {
        $this->website = (string) $website;
    }
}
