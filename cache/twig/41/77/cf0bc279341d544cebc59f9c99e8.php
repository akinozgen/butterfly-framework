<?php

/* home/home/masterpage.twig */
class __TwigTemplate_4177cf0bc279341d544cebc59f9c99e8 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'styles' => array($this, 'block_styles'),
            'container' => array($this, 'block_container'),
            'scripts' => array($this, 'block_scripts'),
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
        echo "    ";
        $this->displayBlock('styles', $context, $blocks);
        // line 5
        echo "<body>

    ";
        // line 7
        $this->env->loadTemplate("home/home/inc/header.twig")->display($context);
        // line 8
        echo "
    <div class=\"container\">
        ";
        // line 10
        $this->displayBlock('container', $context, $blocks);
        // line 11
        echo "    </div>

    ";
        // line 13
        $this->env->loadTemplate("home/home/inc/footer.twig")->display($context);
        // line 14
        echo "    ";
        $this->env->loadTemplate("home/home/inc/scripts.twig")->display($context);
        // line 15
        echo "    ";
        $this->displayBlock('scripts', $context, $blocks);
        // line 16
        echo "</body>
</html>";
    }

    // line 4
    public function block_styles($context, array $blocks = array())
    {
    }

    // line 10
    public function block_container($context, array $blocks = array())
    {
    }

    // line 15
    public function block_scripts($context, array $blocks = array())
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
        return array (  68 => 15,  63 => 10,  58 => 4,  53 => 16,  50 => 15,  47 => 14,  45 => 13,  41 => 11,  39 => 10,  35 => 8,  33 => 7,  29 => 5,  26 => 4,  24 => 3,  20 => 1,);
    }
}
