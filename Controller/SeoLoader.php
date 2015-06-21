<?php
/**
 * This file is part of the Positibe Standard Bundles project.
 *
 * (c) Pedro Carlos Abreu <pcabreus@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Positibe\Bundle\SeoBundle\Controller;

use Sonata\SeoBundle\Seo\SeoPageInterface;
use Symfony\Cmf\Bundle\SeoBundle\SeoPresentationInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class SeoLoader
 * @package Positibe\Bundle\SeoBundle\Controller
 *
 * @author Pedro Carlos Abreu <pcabreus@gmail.com>
 */
class SeoLoader
{
    /**
     * @var SeoPageInterface
     */
    private $seoPage;

    /**
     * @var SeoPresentationInterface
     */
    private $seoPresentation;

    public function __construct(SeoPageInterface $seoPage)
    {
        $this->seoPage = $seoPage;
    }

    /**
     * @param SeoPresentationInterface $seoPresentation
     */
    public function setSeoPresentation(SeoPresentationInterface $seoPresentation)
    {
        $this->seoPresentation = $seoPresentation;
    }

    /**
     * Hay dos variante de carga del seo desde la configuración de los parámetros:
     *      type = resource: lo que indica que se va a cargar a través de un recurso pasado en las $options
     *      type = static: lo que indica que el seo se cargará desde la propia configuración mediante:
     *          _positibe_seo:
     *              type: static
     *              title: "Título mío"
     *              metas:
     *                  keywords: "a, b, c"
     *                  description: "Esta es mi descripción"
     *
     * @param Request $request
     * @param array $options
     */
    public function load(Request $request, array $options = array())
    {
        if ($request->attributes->has('_positibe_seo') && isset($request->attributes->get('_positibe_seo')['type'])) {

            $seoConfig = $request->attributes->get('_positibe_seo');

            if ($this->seoPresentation !== null && $seoConfig['type'] === 'resource' && isset($options['resource'])) {
                $seoPresentation = $this->seoPresentation;
                $seoPresentation->updateSeoPage($options['resource']);
            } elseif ($seoConfig['type'] === 'static') {
                $seoPage = $this->seoPage;
                if (isset($seoConfig['title'])) {
                    $seoPage->setTitle($seoConfig['title']);
                }
                if (isset($seoConfig['metas']['description'])) {
                    $seoPage->addMeta('name', 'description', $seoConfig['metas']['description'], array());
                }
                if (isset($seoConfig['metas']['keywords'])) {
                    $seoPage->addMeta('name', 'keywords', $seoConfig['metas']['keywords'], array());
                }
            }
        }
    }
} 