<?php
/**
 * This file is part of the Positibe Standard Bundles project.
 *
 * (c) Pedro Carlos Abreu <pcabreus@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Positibe\Bundle\SeoBundle\Loader;

use Positibe\Bundle\SeoBundle\Extractor\SeoReadInterface;
use Sonata\SeoBundle\Seo\SeoPageInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class SeoLoader
 * @package Positibe\Bundle\SeoBundle\Loader
 *
 * @author Pedro Carlos Abreu <pcabreus@gmail.com>
 */
class SeoLoader
{
    /**
     * @var SeoPageInterface
     */
    private $seoPage;

    public function __construct(SeoPageInterface $seoPage)
    {
        $this->seoPage = $seoPage;
    }

    /**
     * Cargar a través de un recurso pasado en las $options
     *
     * @param Request $request
     * @param array $options
     */
    public function load(Request $request, array $options = array())
    {
        /** @var SeoReadInterface $seoObject */
        $seoObject = $options['resource'];
        if ($this->seoPage !== null && isset($seoObject) && $seoObject instanceof SeoReadInterface) {
            $this->loadSeo($seoObject);
        }
    }

    /**
     * @param SeoReadInterface $seoReadObject
     * @return SeoPageInterface
     */
    public function loadSeo(SeoReadInterface $seoReadObject)
    {
        $this->seoPage->addTitle($seoReadObject->getSeoTitle());
        $this->seoPage->addMeta('name', 'description', $seoReadObject->getSeoDescription(), array());
        $this->seoPage->addMeta('name', 'keywords', $seoReadObject->getSeoKeywords(), array());
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
} 