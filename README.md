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


ToDo
----

* Translate the sonata_seo metas and title configuration. e.j. sonata_seo.page.title: "%seo.title%" = 'es' -> 'mi blog personal', 'en' -> 'My personal blog'.
* To load part of title and metas using event. To be able to do this: "To learn more about Symfony - %seo.current_category_blog% | %seo.title%".

* Cuando se realiza un filstrado desde una página 3 por ejemplo se filtra y lo deja en la página 3
