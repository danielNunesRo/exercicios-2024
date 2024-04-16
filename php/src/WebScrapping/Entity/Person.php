<?php

namespace Chuva\Php\WebScrapping\Entity;

/**
 * Paper Author personal information .
 */
class Person
{

    /**
     * Person name.
     */
    public string $name;

    /**
     * Person institution.
     */
    public string $institution;

    /**
     * Build.
     */
    public function __construct($name, $institution)
    {
        $this->name = $name;
        $this->institution = $institution;
    }
}
