<?php

/* home/home/masterpage.twig */
class __TwigTemplate_52275b5efc6e6ababb6f303766e9c1ad extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'container' => array($this, 'block_container'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!doctype html>
<html class=\"no-js\" lang=\"\">
    ";
        // line 3
        $this->env->loadTemplate("home/home/inc/head.twig")->display($context);
        // line 4
        echo "<body>
    <div class=\"container\">
    ";
        // line 6
        $this->env->loadTemplate("home/home/inc/header.twig")->display($context);
        // line 7
        echo "    <div class=\"container\">
        <!-- Example row of columns -->
        ";
        // line 9
        $this->displayBlock('container', $context, $blocks);
        // line 10
        echo "        ";
        $this->env->loadTemplate("home/home/inc/footer.twig")->display($context);
        // line 11
        echo "    </div>
</div>

    ";
        // line 14
        $this->env->loadTemplate("home/home/inc/scripts.twig")->display($context);
        // line 15
        echo "</body>
</html>";
    }

    // line 9
    public function block_container($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "home/home/masterpage.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  51 => 9,  46 => 15,  44 => 14,  39 => 11,  36 => 10,  34 => 9,  30 => 7,  28 => 6,  24 => 4,  22 => 3,  18 => 1,);
    }
}
