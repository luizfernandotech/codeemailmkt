<?php
/**
 * Created by PhpStorm.
 * User: nacocada
 * Date: 20/02/17
 * Time: 08:26
 */

namespace CodeEmailMKT;


class MinhaClasse
{
    private $name;

    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}