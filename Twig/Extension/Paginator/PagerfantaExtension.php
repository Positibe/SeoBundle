<?php
/**
 * This file is part of the Positibe Standard Bundles project.
 *
 * (c) Pedro Carlos Abreu <pcabreus@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Positibe\Bundle\SeoBundle\Twig\Extension\Paginator;

use Pagerfanta\PagerfantaInterface;
use Positibe\Bundle\SeoBundle\Entity\SeoRoute;
use Symfony\Component\DependencyInjection\ContainerInterface;
use WhiteOctober\PagerfantaBundle\Twig\PagerfantaExtension as BasePagerfantaExtention;

/**
 * Class PagerfantaExtension
 * @package Positibe\Bundle\SeoBundle\Twig\Extension\Paginator
 *
 * @author Pedro Carlos Abreu <pcabreus@gmail.com>
 */
class PagerfantaExtension extends BasePagerfantaExtention
{
    private $defaultView;
    private $viewFactory;
    private $route;
    private $request;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);

        $this->route = $container->get('router');
        $this->defaultView = $container->getParameter('white_october_pagerfanta.default_view');
        $this->viewFactory = $container->get('white_october_pagerfanta.view_factory');
        $this->request = $container->get('request_stack')->getCurrentRequest();
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            'positibe_seo_paginate' => new \Twig_Function_Method(
                $this,
                'renderPagerfanta',
                array('is_safe' => array('html'))
            ),

        );
    }

    /**
     * Renders a pagerfanta.
     *
     * @param PagerfantaInterface $pagerfanta
     * @param null $viewName
     * @param array $options
     * @return string
     * @throws \Exception
     */
    public function renderPagerfanta(PagerfantaInterface $pagerfanta, $viewName = null, array $options = array())
    {
        if (null === $viewName) {
            $viewName = $this->defaultView;
        }

        $router = $this->route;

        $request = $this->request;

        if (isset($options['paginate_pattern'])) {
            $paginatePattern = $options['paginate_pattern'];
        } elseif ($route = $request->get('routeDocument')) {
            $paginatePattern = $route->getGroup();
        } else {
            return parent::renderPagerfanta($pagerfanta, $viewName, $options);
        }
        // make sure we read the route parameters from the passed option array
        $defaultRouteParams = array_merge($request->query->all(), $request->attributes->get('_route_params'));

        if (array_key_exists('routeParams', $options)) {
            $options['routeParams'] = array_merge($defaultRouteParams, $options['routeParams']);
        } else {
            $options['routeParams'] = $defaultRouteParams;
        }

        $routeParams = $options['routeParams'];

        //elimina el parámetro `page` ya que no se incluye en la ruta pues está explícito en esta
        if (isset($routeParams['page'])) {
            unset($routeParams['page']);
        }

        $routeGenerator = function ($page) use ($router, $paginatePattern, $routeParams) {
            $routeName = $paginatePattern;
            if ($page > 1) {
                $routeName .= '_' . $page;
            }

            return $router->generate($routeName, $routeParams);
        };

        return $this->viewFactory->get($viewName)->render($pagerfanta, $routeGenerator, $options);
    }

    public function getName()
    {
        return 'positibe_seo_pagerfanta';
    }
} 