<?php

/* home/home/inc/head.twig */
class __TwigTemplate_cc3add5663cd821d32b92f6efbfc0adf extends Twig_Template
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
        return array (  22 => 4,  100 => 69,  98 => 68,  90 => 63,  59 => 35,  36 => 15,  23 => 4,  21 => 3,  17 => 1,);
    }
}
