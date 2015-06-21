Positibe Seo Bundle
===================

This bundle provide some simple extensions of SonataSeoBundle

Instalation
-----------



Documentation
-------------

1. Add title to seo configuration via `positibe_seo_add_title`
2. Set title to seo configuration via `positibe_seo_set_title`
3. Set meta description to seo configuration via `positibe_seo_set_description`
4. Set meta keywords to seo configuration via `positibe_seo_set_keywords`
5. Translation of meta seo

Nuevo documentar
~~~~~~~~~~~~~~~~

Se la agregó al sistema soporte para CmfSeoBundle

Ahora maneja extractores y contenedores de seo, ver CmfSeoBundle documentación.

Al no usar el CmfRoutingBundle, es necesario hacer manualmente la carga de estas funciones.
Si se usa el SyliusResourceBundle, se pueden configuarar las rutas para definir las opciones de seo por rutas
sino se puede hacer en una plantilla.
Antes de poner `sonata_seo_title()` en las plantillas twig debe agregar `positibe_seo_update(resource)` pasandole el recurso por parámetro.
La forma adecuada de hacer esto es en la plantilla base crear un bloque para los metas:

    # [twig]
    # app/Resources/views/base.html.twig
    {% block metas %}
        {{ sonata_seo_title() }}
        {{ sonata_seo_metadatas() }}
        {{ sonata_seo_link_canonical() }}
        {{ sonata_seo_lang_alternates() }}
    {% endblock %}

y en la plantillas específica:

    # [twig]
    # app/Resources/views/posts/show.html.twig
    {% extends 'base.html.twig' %}

    {% block metas %}
        {{ positibe_seo_update(news) }}
        {{ parent() }}
    {% endblock %}

Nuevo a documentar
~~~~~~~~~~~~~~~~~~

Se incorpora la posibilidad de manejar las rutas a traves del ChainRouter y el DynamicRouting de Symfony Cmf.

para habilitar la funcionalidad basta con tener instalado el CmfRoutingBundle.

> **Importante**: Es necesario que en AppKernel.php se declare primero el CmfRoutingBundle y después vaya el PositibeSeoBundle.

    new Knp\Bundle\MenuBundle\KnpMenuBundle(),
    new Sonata\BlockBundle\SonataBlockBundle(),
    new Sonata\SeoBundle\SonataSeoBundle(),
    new Symfony\Cmf\Bundle\SeoBundle\CmfSeoBundle(),
    new Symfony\Cmf\Bundle\RoutingBundle\CmfRoutingBundle(),
    new Positibe\Bundle\SeoBundle\PositibeSeoBundle(),

Para hacer uso de este solo debemos crear las rutas normalmente como Symfony Cmf con la posibilidad de agregarle el seo
de cada ruta: `title`, `description`, `keywords`.

Agregar a la configuración del cmf_seo: routeDocument

    [yaml]
    cmf_seo:
        content_key: routeDocument

> **Nota:** La actual versión no soporta otras características de seo como los extra, pero sería posible agregarlo.

Nuevo documentar
~~~~~~~~~~~~~~~~

Crear una ruta por página al realizar un paginado a una entidad.
Es posible ir creando bajo necesidad (e.j. cada 20 entidades creadas) una ruta correspondiente a una segunda (o tercera, etc.)
página.

En vez de:
    pagina 1 = `/lista`
    página 2 = `/lista?page=2`

Sería:
    pagina 1 = `/lista`
    pagina 2 = `/lista-pagina-2`

De esta forma también cada ruta tendría su propio `title`, `description` y `keywords`, sin tener contenido duplicado.
Ensima de esto se pueden realizar las operaciones normales de paginado:

Para usarlo basta con instalar un bundle paginador soportado por el bundle:

> **Importante:** Hasta el momento solo está soportado WhiteOctoberPagerfantaBundle.

### WhiteOctoberPagerfantaBundle ###

    [twig]
    {{ positibe_seo_paginate(entity, 'twitter_bootstrap3_translated')}}

Tener en cuanta si se utiliza el SyliusResourceBundle para filtrar dirigir directamente a la página inicial que se almacena
en el atributo `group`.

    <form class="form-inline form-filter" action="{{ path(app.request.get('routeDocument').group) }}" method="get">
        <!-- .... -->
    </form>

Cargar Seo desde la configuración de las rutas
----------------------------------------------

Por escribir...

ToDo
----

* Translate the sonata_seo metas and title configuration. e.j. sonata_seo.page.title: "%seo.title%" = 'es' -> 'mi blog personal', 'en' -> 'My personal blog'.
* To load part of title and metas using event. To be able to do this: "To learn more about Symfony - %seo.current_category_blog% | %seo.title%".

* Cuando se realiza un filstrado desde una página 3 por ejemplo se filtra y lo deja en la página 3
