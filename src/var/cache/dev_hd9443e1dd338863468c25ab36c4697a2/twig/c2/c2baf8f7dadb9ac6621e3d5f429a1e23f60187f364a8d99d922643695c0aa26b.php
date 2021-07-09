<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* @Administration/administration/index.html.twig */
class __TwigTemplate_593f4cb45d14ae1b29de1fc0d4e83d24bc686cf18945d98e98504094ca139b39 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'administration_favicons' => [$this, 'block_administration_favicons'],
            'administration_templates' => [$this, 'block_administration_templates'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Administration/administration/index.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Administration/administration/index.html.twig"));

        // line 1
        echo "<!DOCTYPE html>
<html>
<head>
    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <title>
        Shopware Administration (c) shopware AG
    </title>

    ";
        // line 10
        $this->displayBlock('administration_favicons', $context, $blocks);
        // line 20
        echo "
    <link rel=\"stylesheet\" href=\"";
        // line 21
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("static/css/vendors-node.css", "@Administration"), "html", null, true);
        echo "\">
    <link rel=\"stylesheet\" href=\"";
        // line 22
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("static/css/app.css", "@Administration"), "html", null, true);
        echo "\">

</head>
<body>

<div id=\"app\"></div>

";
        // line 29
        $this->displayBlock('administration_templates', $context, $blocks);
        // line 30
        echo "
<script nonce=\"";
        // line 31
        echo twig_escape_filter($this->env, ($context["cspNonce"] ?? null), "html", null, true);
        echo "\" src=\"";
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("static/js/runtime.js", "@Administration"), "html", null, true);
        echo "\"></script>
<script nonce=\"";
        // line 32
        echo twig_escape_filter($this->env, ($context["cspNonce"] ?? null), "html", null, true);
        echo "\" src=\"";
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("static/js/vendors-node.js", "@Administration"), "html", null, true);
        echo "\"></script>
<script nonce=\"";
        // line 33
        echo twig_escape_filter($this->env, ($context["cspNonce"] ?? null), "html", null, true);
        echo "\" src=\"";
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("static/js/commons.js", "@Administration"), "html", null, true);
        echo "\"></script>
<script nonce=\"";
        // line 34
        echo twig_escape_filter($this->env, ($context["cspNonce"] ?? null), "html", null, true);
        echo "\" src=\"";
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("static/js/app.js", "@Administration"), "html", null, true);
        echo "\"></script>

<script nonce=\"";
        // line 36
        echo twig_escape_filter($this->env, ($context["cspNonce"] ?? null), "html", null, true);
        echo "\">
    /*
        root-level domain configuration

        host:               shopware.next
        port:               80
        scheme:             http
        schemeAndHttpHost:  http://shopware.next
        uri:                http://shopware.next/admin
        basePath:
        pathInfo:           /admin

        -----------------------------------------------

        sub-folder domain configuration

        host:               localhost
        port:               80
        scheme:             http
        schemeAndHttpHost:  http://localhost
        uri:                http://localhost/next/web/admin
        basePath:           /next/web
        pathInfo:           /admin
    */
    Shopware.Application.start({
        apiContext: {
            host: '";
        // line 62
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["app"] ?? null), "request", [], "any", false, false, false, 62), "host", [], "any", false, false, false, 62), "html", null, true);
        echo "',
            port: ";
        // line 63
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["app"] ?? null), "request", [], "any", false, false, false, 63), "port", [], "any", false, false, false, 63), "html", null, true);
        echo ",
            scheme: '";
        // line 64
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["app"] ?? null), "request", [], "any", false, false, false, 64), "scheme", [], "any", false, false, false, 64), "html", null, true);
        echo "',
            schemeAndHttpHost: '";
        // line 65
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["app"] ?? null), "request", [], "any", false, false, false, 65), "schemeAndHttpHost", [], "any", false, false, false, 65), "html", null, true);
        echo "',
            uri: '";
        // line 66
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["app"] ?? null), "request", [], "any", false, false, false, 66), "uri", [], "any", false, false, false, 66), "html", null, true);
        echo "',
            basePath: '";
        // line 67
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["app"] ?? null), "request", [], "any", false, false, false, 67), "basePath", [], "any", false, false, false, 67), "html", null, true);
        echo "',
            pathInfo: '";
        // line 68
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["app"] ?? null), "request", [], "any", false, false, false, 68), "pathInfo", [], "any", false, false, false, 68), "html", null, true);
        echo "',
            liveVersionId: '";
        // line 69
        echo twig_escape_filter($this->env, ($context["liveVersionId"] ?? null), "html", null, true);
        echo "',
            systemLanguageId: '";
        // line 70
        echo twig_escape_filter($this->env, ($context["systemLanguageId"] ?? null), "html", null, true);
        echo "',
            apiVersion: ";
        // line 71
        echo twig_escape_filter($this->env, ($context["apiVersion"] ?? null), "html", null, true);
        echo ",
            assetPath: '";
        // line 72
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("", "asset"), "html", null, true);
        echo "'
        },
        appContext: {
            features: ";
        // line 75
        echo json_encode(($context["features"] ?? null));
        echo ",
            firstRunWizard: ";
        // line 76
        echo ((($context["firstRunWizard"] ?? null)) ? ("true") : ("false"));
        echo ",
            systemCurrencyId: '";
        // line 77
        echo twig_escape_filter($this->env, ($context["systemCurrencyId"] ?? null), "html", null, true);
        echo "',
            systemCurrencyISOCode: '";
        // line 78
        echo twig_escape_filter($this->env, ($context["systemCurrencyISOCode"] ?? null), "html", null, true);
        echo "'
        }
    });
</script>

</body>
</html>
";
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 10
    public function block_administration_favicons($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "administration_favicons"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "administration_favicons"));

        // line 11
        echo "        <link rel=\"apple-touch-icon\" sizes=\"180x180\" href=\"";
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("static/img/favicon/apple-touch-icon.png", "@Administration"), "html", null, true);
        echo "\">
        <link rel=\"icon\" type=\"image/png\" sizes=\"16x16\" href=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("static/img/favicon/favicon-16x16.png", "@Administration"), "html", null, true);
        echo "\">
        <link rel=\"icon\" type=\"image/png\" sizes=\"32x32\" href=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("static/img/favicon/favicon-32x32.png", "@Administration"), "html", null, true);
        echo "\" id=\"dynamic-favicon\">
        <link rel=\"icon\" type=\"image/png\" sizes=\"192x192\" href=\"";
        // line 14
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("static/img/favicon/android-chrome-192x192.png", "@Administration"), "html", null, true);
        echo "\">
        <link rel=\"icon\" type=\"image/png\" sizes=\"256x256\" href=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("static/img/favicon/android-chrome-256x256.png", "@Administration"), "html", null, true);
        echo "\">
        <meta name=\"msapplication-TileImage\" content=\"";
        // line 16
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("static/img/favicon/mstile-150x150.png", "@Administration"), "html", null, true);
        echo "\">
        <meta name=\"msapplication-TileColor\" content=\"#189eff\">
        <meta name=\"theme-color\" content=\"#189eff\">
    ";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 29
    public function block_administration_templates($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "administration_templates"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "administration_templates"));

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "@Administration/administration/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  255 => 29,  241 => 16,  237 => 15,  233 => 14,  229 => 13,  225 => 12,  220 => 11,  210 => 10,  192 => 78,  188 => 77,  184 => 76,  180 => 75,  174 => 72,  170 => 71,  166 => 70,  162 => 69,  158 => 68,  154 => 67,  150 => 66,  146 => 65,  142 => 64,  138 => 63,  134 => 62,  105 => 36,  98 => 34,  92 => 33,  86 => 32,  80 => 31,  77 => 30,  75 => 29,  65 => 22,  61 => 21,  58 => 20,  56 => 10,  45 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<!DOCTYPE html>
<html>
<head>
    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <title>
        Shopware Administration (c) shopware AG
    </title>

    {% block administration_favicons %}
        <link rel=\"apple-touch-icon\" sizes=\"180x180\" href=\"{{ asset('static/img/favicon/apple-touch-icon.png', '@Administration') }}\">
        <link rel=\"icon\" type=\"image/png\" sizes=\"16x16\" href=\"{{ asset('static/img/favicon/favicon-16x16.png', '@Administration') }}\">
        <link rel=\"icon\" type=\"image/png\" sizes=\"32x32\" href=\"{{ asset('static/img/favicon/favicon-32x32.png', '@Administration') }}\" id=\"dynamic-favicon\">
        <link rel=\"icon\" type=\"image/png\" sizes=\"192x192\" href=\"{{ asset('static/img/favicon/android-chrome-192x192.png', '@Administration') }}\">
        <link rel=\"icon\" type=\"image/png\" sizes=\"256x256\" href=\"{{ asset('static/img/favicon/android-chrome-256x256.png', '@Administration') }}\">
        <meta name=\"msapplication-TileImage\" content=\"{{ asset('static/img/favicon/mstile-150x150.png', '@Administration') }}\">
        <meta name=\"msapplication-TileColor\" content=\"#189eff\">
        <meta name=\"theme-color\" content=\"#189eff\">
    {% endblock %}

    <link rel=\"stylesheet\" href=\"{{ asset('static/css/vendors-node.css', '@Administration') }}\">
    <link rel=\"stylesheet\" href=\"{{ asset('static/css/app.css', '@Administration') }}\">

</head>
<body>

<div id=\"app\"></div>

{% block administration_templates %}{% endblock %}

<script nonce=\"{{ cspNonce }}\" src=\"{{ asset('static/js/runtime.js', '@Administration') }}\"></script>
<script nonce=\"{{ cspNonce }}\" src=\"{{ asset('static/js/vendors-node.js', '@Administration') }}\"></script>
<script nonce=\"{{ cspNonce }}\" src=\"{{ asset('static/js/commons.js', '@Administration') }}\"></script>
<script nonce=\"{{ cspNonce }}\" src=\"{{ asset('static/js/app.js', '@Administration') }}\"></script>

<script nonce=\"{{ cspNonce }}\">
    /*
        root-level domain configuration

        host:               shopware.next
        port:               80
        scheme:             http
        schemeAndHttpHost:  http://shopware.next
        uri:                http://shopware.next/admin
        basePath:
        pathInfo:           /admin

        -----------------------------------------------

        sub-folder domain configuration

        host:               localhost
        port:               80
        scheme:             http
        schemeAndHttpHost:  http://localhost
        uri:                http://localhost/next/web/admin
        basePath:           /next/web
        pathInfo:           /admin
    */
    Shopware.Application.start({
        apiContext: {
            host: '{{ app.request.host }}',
            port: {{ app.request.port }},
            scheme: '{{ app.request.scheme }}',
            schemeAndHttpHost: '{{ app.request.schemeAndHttpHost }}',
            uri: '{{ app.request.uri }}',
            basePath: '{{ app.request.basePath }}',
            pathInfo: '{{ app.request.pathInfo }}',
            liveVersionId: '{{ liveVersionId }}',
            systemLanguageId: '{{ systemLanguageId }}',
            apiVersion: {{ apiVersion }},
            assetPath: '{{ asset('', 'asset') }}'
        },
        appContext: {
            features: {{ features|json_encode|raw }},
            firstRunWizard: {{ firstRunWizard ? 'true' : 'false' }},
            systemCurrencyId: '{{ systemCurrencyId }}',
            systemCurrencyISOCode: '{{ systemCurrencyISOCode }}'
        }
    });
</script>

</body>
</html>
", "@Administration/administration/index.html.twig", "/var/www/html/vendor/shopware/administration/Resources/views/administration/index.html.twig");
    }
}
