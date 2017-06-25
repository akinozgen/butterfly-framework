<?php

/* home/home/inc/header.twig */
class __TwigTemplate_e583a3f77cf746ada208bd8f1dafffc7 extends Twig_Template
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
        echo "<nav class=\"navbar navbar-inverse navbar-static-top\">
    <div class=\"container\">
        <div class=\"navbar-header\">
            <!-- Path.route('/') is generates link to / route (root) -->
            <a href=\"";
        // line 5
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Path"]) ? $context["Path"] : null), "route", array(0 => "/"), "method"), "html", null, true);
        echo "\" class=\"navbar-brand\">
                ";
        // line 6
        echo twig_escape_filter($this->env, (isset($context["application_name"]) ? $context["application_name"] : null), "html", null, true);
        echo "
            </a>
        </div>

        <div class=\"collapse navbar-collapse pull-right\">
            <ul class=\"nav navbar-nav\">
                <!-- Path.route('/login') is generates link to /login route -->
                <li><a href=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Path"]) ? $context["Path"] : null), "route", array(0 => "/login"), "method"), "html", null, true);
        echo "\">Giriş Yap</a></li>
            </ul>
        </div>
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
        return array (  37 => 13,  27 => 6,  23 => 5,  17 => 1,);
    }
}
