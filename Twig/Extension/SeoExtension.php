<?php


namespace Positibe\Bundle\SeoBundle\Twig\Extension;

use Sonata\SeoBundle\Seo\SeoPageInterface;
use Sonata\SeoBundle\Twig\Extension\SeoExtension as SonataSeoExtension;
use Symfony\Cmf\Bundle\SeoBundle\SeoPresentationInterface;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class SeoExtension
 * @package Positibe\Bundle\SeoBundle\Twig\Extension
 *
 * @author Pedro Carlos Abreu <pcabreus@gmail.com>
 */
class SeoExtension extends SonataSeoExtension
{
    private $seoPage;
    private $seoPresentation;
    private $routeRepository;

    public function __construct(SeoPageInterface $seoPage)
    {
        $this->seoPage = $seoPage;
    }

    public function setSeoPresentation(SeoPresentationInterface $seoPresentation)
    {
        $this->seoPresentation = $seoPresentation;
    }

    /**
     * @param mixed $routeRepository
     */
    public function setRouteRepository($routeRepository)
    {
        $this->routeRepository = $routeRepository;
    }

    /**
     * Returns a list of functions to add to the existing list.
     *
     * @return array An array of functions
     */
    public function getFunctions()
    {
        $functions = array(
            new \Twig_SimpleFunction(
                'positibe_seo_add_title',
                array($this, 'addTitle'),
                array('is_safe' => array('html'))
            ),
            new \Twig_SimpleFunction(
                'positibe_seo_set_title',
                array($this, 'setTitle'),
                array('is_safe' => array('html'))
            ),
            new \Twig_SimpleFunction(
                'positibe_seo_set_description',
                array($this, 'setDescription'),
                array('is_safe' => array('html'))
            ),
            new \Twig_SimpleFunction(
                'positibe_seo_set_keywords',
                array($this, 'setKeywords'),
                array('is_safe' => array('html'))
            ),
            new \Twig_SimpleFunction(
                'positibe_seo_paginate',
                array($this, 'paginate'),
                array('is_safe' => array('html'))
            ),
        );

        if ($this->seoPresentation !== null) {
            $functions[] = new \Twig_SimpleFunction(
                'positibe_seo_update', array($this, 'updateSeo'),
                array('is_safe' => array('html'))
            );
        }

        return $functions;
    }


    public function updateSeo($content)
    {
        if ($this->seoPresentation !== null) {
            $this->seoPresentation->updateSeoPage($content);
        }
    }

    /**
     * @param $title
     */
    public function addTitle($title)
    {
        $this->seoPage->addTitle($title);
    }

    /**
     * @param $title
     */
    public function setTitle($title)
    {
        $this->seoPage->setTitle($title);
    }

    /**
     * @param $description
     * @param array $extras
     */
    public function setDescription($description, array $extras = array())
    {
        $this->seoPage->addMeta('name', 'description', $description, $extras);
    }

    /**
     * @param $description
     * @param array $extras
     */
    public function setKeywords($description, array $extras = array())
    {
        $this->seoPage->addMeta('name', 'keywords', $description, $extras);
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'positibe_seo';
    }


} 