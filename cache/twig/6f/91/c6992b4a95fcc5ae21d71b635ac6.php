<?php

/* home/home/inc/scripts.twig */
class __TwigTemplate_6f91c6992b4a95fcc5ae21d71b635ac6 extends Twig_Template
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
        echo "<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src=\"";
        // line 2
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Path"]) ? $context["Path"] : null), "js", array(0 => "jquery.js"), "method"), "html", null, true);
        echo "\"></script>
<script src=\"";
        // line 3
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Path"]) ? $context["Path"] : null), "js", array(0 => "bootstrap.min.js"), "method"), "html", null, true);
        echo "\"></script>
<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script>
    (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;e=o.createElement(i);r=o.getElementsByTagName(i)[0];e.src='//www.google-analytics.com/analytics.js';r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
    ga('create','UA-XXXXX-X');ga('send','pageview');
</script>";
    }

    public function getTemplateName()
    {
        return "home/home/inc/scripts.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  24 => 3,  20 => 2,  17 => 1,);
    }
}
