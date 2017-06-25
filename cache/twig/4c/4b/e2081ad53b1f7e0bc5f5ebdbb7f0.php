<?php

/* home/home/inc/head.twig */
class __TwigTemplate_4c4be2081ad53b1f7e0bc5f5ebdbb7f0 extends Twig_Template
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
        echo "<head>
    <meta charset=\"utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <title>";
        // line 4
        echo twig_escape_filter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true);
        echo "</title>
    <meta name=\"description\" content=\"\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <!-- Bootstrap -->
    <link rel=\"stylesheet\" href=\"//netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css\">
    <!-- Font-Awesome -->
    <link rel=\"stylesheet\" href=\"//netdna.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css\">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src=\"//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js\"></script>
    <script src=\"//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js\"></script>
    <![endif]-->
    <script src=\"//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js\"></script>
</head>";
    }

    public function getTemplateName()
    {
        return "home/home/inc/head.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  17 => 1,  51 => 9,  46 => 15,  44 => 14,  39 => 11,  36 => 10,  34 => 9,  30 => 7,  28 => 6,  24 => 4,  22 => 4,  18 => 1,);
    }
}
