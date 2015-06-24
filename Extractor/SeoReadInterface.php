<?php
/**
 * This file is part of the Positibe Standard Bundles project.
 *
 * (c) Pedro Carlos Abreu <pcabreus@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Positibe\Bundle\SeoBundle\Extractor;

/**
 * Interface SeoReadInterface
 * @package Positibe\Bundle\SeoBundle\Extractor
 *
 * @author Pedro Carlos Abreu <pcabreus@gmail.com>
 */
interface SeoReadInterface {
    /**
     * Provide a description of this page to be used in SEO context.
     *
     * @return string
     */
    public function getSeoDescription();

    /**
     * Provides a list of keywords for this page to be used in SEO context.
     *
     * @return string|array
     */
    public function getSeoKeywords();

    /**
     * The method returns the absolute URL as a string to redirect to or set to the canonical link.
     *
     * @return string An absolute URL.
     */
    public function getSeoOriginalUrl();

    /**
     * Provides a title of this page to be used in SEO context.
     *
     * @return string
     */
    public function getSeoTitle();
} 