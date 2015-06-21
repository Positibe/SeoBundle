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

use Symfony\Cmf\Bundle\SeoBundle\Extractor\DescriptionReadInterface;
use Symfony\Cmf\Bundle\SeoBundle\Extractor\KeywordsReadInterface;
use Symfony\Cmf\Bundle\SeoBundle\Extractor\OriginalUrlReadInterface;
use Symfony\Cmf\Bundle\SeoBundle\Extractor\TitleReadInterface;

/**
 * Interface SeoReadInterface
 * @package Positibe\Bundle\SeoBundle\Extractor
 *
 * @author Pedro Carlos Abreu <pcabreus@gmail.com>
 */
interface SeoReadInterface extends
    TitleReadInterface,
    DescriptionReadInterface,
    OriginalUrlReadInterface,
    KeywordsReadInterface
{

} 