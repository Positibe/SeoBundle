<?php


namespace Positibe\Bundle\SeoBundle\Twig\Extension;

use Sonata\SeoBundle\Twig\Extension\SeoExtension as SonataSeoExtension;
use Positibe\Bundle\SeoBundle\Loader\SeoLoader;
use Positibe\Bundle\SeoBundle\Extractor\SeoReadInterface;

/**
 * Class SeoExtension
 * @package Positibe\Bundle\SeoBundle\Twig\Extension
 *
 * @author Pedro Carlos Abreu <pcabreus@gmail.com>
 */
class SeoExtension extends SonataSeoExtension
{
    protected $seoLoader;


    public function __construct(SeoLoader $seoLoader)
    {
        $this->seoLoader = $seoLoader;
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
            )
        );

        return $functions;
    }

    /**
     * @param SeoReadInterface $content
     */
    public function updateSeo(SeoReadInterface $content)
    {
        $this->seoLoader->loadSeo($content);
    }

    /**
     * @param $title
     */
    public function addTitle($title)
    {
        $this->seoLoader->addTitle($title);
    }

    /**
     * @param $title
     */
    public function setTitle($title)
    {
        $this->seoLoader->setTitle($title);
    }

    /**
     * @param $description
     * @param array $extras
     */
    public function setDescription($description, array $extras = array())
    {
        $this->seoLoader->setDescription($description, $extras);
    }

    /**
     * @param $description
     * @param array $extras
     */
    public function setKeywords($description, array $extras = array())
    {
        $this->seoLoader->setKeywords($description, $extras);
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