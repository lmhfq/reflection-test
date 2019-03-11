<?php

declare(strict_types=1);

namespace app\components\drivers;

use app\components\annotations\Logger;
use app\components\annotations\MyAnnotation;
use Doctrine\Annotations\AnnotationReader;
use Doctrine\Annotations\Reader;

class AnnotationDriver
{
    /**
     * @var Reader
     */
    private $reader;

    /**
     * AnnotationDriver constructor.
     * @param Reader|null $reader
     * @throws \Doctrine\Annotations\AnnotationException
     */
    public function __construct(Reader $reader = null)
    {
        if (is_null($reader)) {
            $reader = new AnnotationReader();
        }
        $this->reader = $reader;
    }

    /**
     * 加载注解
     * @author lmh
     * @param \ReflectionClass $class
     * @throws \ReflectionException
     */
    public function loadMetadataForClass(\ReflectionClass $class): void
    {
        $name = $class->name;
        foreach ($this->reader->getClassAnnotations($class) as $annotation) {
            if ($annotation instanceof Logger) {
                $annotation->logger();
            }
        }
        foreach ($class->getMethods() as $method) {
            if ($method->class !== $name) {
                continue;
            }
            $annotations = $this->reader->getMethodAnnotations(new \ReflectionMethod($name, $method->getShortName()));
            foreach ($annotations as $annotation) {
                if ($annotation instanceof Logger) {
                    $annotation->logger();
                }
            }
        }
        foreach ($class->getProperties() as $property) {
            if ($property->class !== $name) {
                continue;
            }
            $annotations = $this->reader->getPropertyAnnotations($property);
            foreach ($annotations as $annotation) {
                if ($annotation instanceof Logger) {
                    $annotation->logger();
                }
            }
        }
    }

    /**
     * @param $class
     * @param $name
     * @throws \ReflectionException
     */
    public function loadMetadataForMethod($class, $name): void
    {
        $annotations = $this->reader->getMethodAnnotations(new \ReflectionMethod($class, $name));
        foreach ($annotations as $annotation) {
            if ($annotation instanceof Logger) {
                $annotation->logger();
            }
        }
    }
}
