<?php

/* auth_provider_oauth.html */
class __TwigTemplate_9df1fdbacf1a65e73595bfbe0eaeccac extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "
<div id=\"auth_oauth_settings\">
\t<p>";
        // line 3
        echo $this->env->getExtension('phpbb')->lang("AUTH_PROVIDER_OAUTH_EXPLAIN");
        echo "</p>

\t";
        // line 5
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["loops"]) ? $context["loops"] : null), "oauth_services"));
        foreach ($context['_seq'] as $context["_key"] => $context["oauth_services"]) {
            // line 6
            echo "\t<fieldset>
\t\t<legend>";
            // line 7
            echo $this->getAttribute((isset($context["oauth_services"]) ? $context["oauth_services"] : null), "ACTUAL_NAME");
            echo "</legend>
\t\t<dl>
\t\t\t<dt><label for=\"oauth_service_";
            // line 9
            echo $this->getAttribute((isset($context["oauth_services"]) ? $context["oauth_services"] : null), "NAME");
            echo "_key\">";
            echo $this->env->getExtension('phpbb')->lang("AUTH_PROVIDER_OAUTH_KEY");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label></dt>
\t\t\t<dd><input type=\"text\" id=\"oauth_service_";
            // line 10
            echo $this->getAttribute((isset($context["oauth_services"]) ? $context["oauth_services"] : null), "NAME");
            echo "_key\" size=\"40\" name=\"config[auth_oauth_";
            echo $this->getAttribute((isset($context["oauth_services"]) ? $context["oauth_services"] : null), "NAME");
            echo "_key]\" value=\"";
            echo $this->getAttribute((isset($context["oauth_services"]) ? $context["oauth_services"] : null), "KEY");
            echo "\" /></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"oauth_service_";
            // line 13
            echo $this->getAttribute((isset($context["oauth_services"]) ? $context["oauth_services"] : null), "NAME");
            echo "_secret\">";
            echo $this->env->getExtension('phpbb')->lang("AUTH_PROVIDER_OAUTH_SECRET");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label></dt>
\t\t\t<dd><input type=\"text\" id=\"oauth_service_";
            // line 14
            echo $this->getAttribute((isset($context["oauth_services"]) ? $context["oauth_services"] : null), "NAME");
            echo "_secret\" size=\"40\" name=\"config[auth_oauth_";
            echo $this->getAttribute((isset($context["oauth_services"]) ? $context["oauth_services"] : null), "NAME");
            echo "_secret]\" value=\"";
            echo $this->getAttribute((isset($context["oauth_services"]) ? $context["oauth_services"] : null), "SECRET");
            echo "\" /></dd>
\t\t</dl>
\t</fieldset>
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['oauth_services'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 18
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "auth_provider_oauth.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  78 => 18,  57 => 13,  35 => 7,  32 => 6,  28 => 5,  23 => 3,  125 => 33,  118 => 32,  112 => 29,  105 => 28,  99 => 25,  92 => 24,  66 => 16,  60 => 13,  53 => 12,  47 => 10,  40 => 9,  34 => 5,  27 => 4,  22 => 2,  200 => 52,  193 => 48,  188 => 46,  184 => 45,  180 => 43,  175 => 41,  172 => 40,  158 => 39,  144 => 38,  127 => 37,  124 => 36,  122 => 35,  119 => 34,  108 => 29,  95 => 28,  91 => 26,  86 => 21,  83 => 23,  79 => 20,  76 => 20,  73 => 17,  69 => 18,  64 => 14,  61 => 15,  55 => 12,  51 => 11,  48 => 10,  46 => 9,  41 => 7,  36 => 5,  31 => 2,  19 => 1,);
    }
}
