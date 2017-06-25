<?php

/* home/home/sub/main.twig */
class __TwigTemplate_126df82d8cd83f3c55eaf9f2f5850367 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("home/home/masterpage.twig");

        $this->blocks = array(
            'container' => array($this, 'block_container'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "home/home/masterpage.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_container($context, array $blocks = array())
    {
        // line 4
        echo "    <div class=\"row\">
        ";
        // line 5
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["specs"]) ? $context["specs"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["spec"]) {
            // line 6
            echo "            <div class=\"col-md-4\">
                <h2>";
            // line 7
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["spec"]) ? $context["spec"] : null), "title"), "html", null, true);
            echo "</h2>
                <p>";
            // line 8
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["spec"]) ? $context["spec"] : null), "description"), "html", null, true);
            echo "</p>
            </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['spec'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 11
        echo "    </div>
";
    }

    public function getTemplateName()
    {
        return "home/home/sub/main.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  52 => 11,  43 => 8,  39 => 7,  36 => 6,  32 => 5,  29 => 4,  26 => 3,);
    }
}
