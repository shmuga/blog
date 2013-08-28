<?php

Abstract Class Controller
{
        protected $registry;

        function __construct($registry) 
        {
                $this->registry = $registry;
        }

        abstract function index();
}

?>