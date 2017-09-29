<?php

namespace Symfony\Component\DependencyInjection\Annotation;

use ReflectionClass;

/**
 * @Annotation
 * @Target({"CLASS"})
 */
class Service
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var array
     */
    public $inject = [];

    /**
     * @var array
     */
    public $methodCalls = [];

    /**
     * @var bool
     */
    public $public;

    /**
     * @var bool
     */
    public $shared = true;

    /**
     * @var bool
     */
    public $lazy;

    /**
     * @var array
     */
    public $tags = [];

    /**
     * @var string
     */
    public $factoryClass;

    /**
     * @var string
     */
    public $factoryMethod;

    /**
     * @var array
     */
    public $factoryArguments;

    /**
     * @var ReflectionClass
     */
    private $class;

    /**
     * @var array
     */
    private $methodAnnotations = [];

    /**
     * @param ReflectionClass $class
     */
    public function setClass(ReflectionClass $class)
    {
        $this->class = $class;
    }

    /**
     * @return ReflectionClass
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param array $annotations
     */
    public function setMethodAnnotations(array $annotations)
    {
        $this->methodAnnotations = $annotations;
    }

    /**
     * @return array
     */
    public function getAllMethodAnnotations()
    {
        return $this->methodAnnotations;
    }

    /**
     * @param string $methodName
     *
     * @return array
     */
    public function getMethodAnnotations($methodName)
    {
        if (!isset($this->methodAnnotations[$methodName])) {
            return [];
        }

        return $this->methodAnnotations[$methodName];
    }
}
