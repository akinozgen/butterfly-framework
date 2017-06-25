<?php

/* home/home/inc/footer.twig */
class __TwigTemplate_49bfcb401758872681b35c347174d8ca extends Twig_Template
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
        echo "<footer style=\"position:fixed; bottom: 0; left: 0; right: 0;\">
    <div align=\"center\">
        <p>&copy; 2017 ";
        // line 3
        echo twig_escape_filter($this->env, (isset($context["application_name"]) ? $context["application_name"] : null), "html", null, true);
        echo ", Inc.</p>
    </div>
</footer>";
    }

    public function getTemplateName()
    {
        return "home/home/inc/footer.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  21 => 3,  17 => 1,);
    }
}
