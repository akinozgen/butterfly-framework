<?php

/* home/home/inc/header.twig */
class __TwigTemplate_b7a3382c58af75a6d115f8e0452e07c9 extends Twig_Template
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
        echo "<nav class=\"navbar navbar-inverse navbar-fixed-top\">
    <div class=\"container\">
        <div class=\"navbar-header\">
            <button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\" data-target=\"#navbar\" aria-expanded=\"false\" aria-controls=\"navbar\">
                <span class=\"sr-only\">Toggle navigation</span>
                <span class=\"icon-bar\"></span>
                <span class=\"icon-bar\"></span>
                <span class=\"icon-bar\"></span>
            </button>
            <a class=\"navbar-brand\" href=\"#\">";
        // line 10
        echo twig_escape_filter($this->env, (isset($context["application_name"]) ? $context["application_name"] : null), "html", null, true);
        echo "</a>
        </div>
        <div id=\"navbar\" class=\"navbar-collapse collapse\">
            <form class=\"navbar-form navbar-right\">
                <div class=\"form-group\">
                    <input type=\"text\" placeholder=\"Email\" class=\"form-control\">
                </div>
                <div class=\"form-group\">
                    <input type=\"password\" placeholder=\"Password\" class=\"form-control\">
                </div>
                <button type=\"submit\" class=\"btn btn-success\">Sign in</button>
            </form>
        </div><!--/.navbar-collapse -->
    </div>
</nav>";
    }

    public function getTemplateName()
    {
        return "home/home/inc/header.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  17 => 1,  51 => 9,  46 => 15,  44 => 14,  39 => 11,  36 => 10,  34 => 9,  30 => 7,  28 => 10,  24 => 4,  22 => 3,  18 => 1,);
    }
}
