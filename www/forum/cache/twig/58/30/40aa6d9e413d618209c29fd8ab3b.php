<?php

/* acp_email.html */
class __TwigTemplate_583040aa6d9e413d618209c29fd8ab3b extends Twig_Template
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
        $location = "overall_header.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->env->loadTemplate("overall_header.html")->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<a id=\"maincontent\"></a>

<h1>";
        // line 5
        echo $this->env->getExtension('phpbb')->lang("ACP_MASS_EMAIL");
        echo "</h1>

<p>";
        // line 7
        echo $this->env->getExtension('phpbb')->lang("ACP_MASS_EMAIL_EXPLAIN");
        echo "</p>

";
        // line 9
        if ((isset($context["S_WARNING"]) ? $context["S_WARNING"] : null)) {
            // line 10
            echo "\t<div class=\"errorbox\">
\t\t<h3>";
            // line 11
            echo $this->env->getExtension('phpbb')->lang("WARNING");
            echo "</h3>
\t\t<p>";
            // line 12
            echo (isset($context["WARNING_MSG"]) ? $context["WARNING_MSG"] : null);
            echo "</p>
\t</div>
";
        }
        // line 15
        echo "
<form id=\"acp_email\" method=\"post\" action=\"";
        // line 16
        echo (isset($context["U_ACTION"]) ? $context["U_ACTION"] : null);
        echo "\">

<fieldset>
\t<legend>";
        // line 19
        echo $this->env->getExtension('phpbb')->lang("COMPOSE");
        echo "</legend>
<dl>
\t<dt><label for=\"group\">";
        // line 21
        echo $this->env->getExtension('phpbb')->lang("SEND_TO_GROUP");
        echo $this->env->getExtension('phpbb')->lang("COLON");
        echo "</label></dt>
\t<dd><select id=\"group\" name=\"g\">";
        // line 22
        echo (isset($context["S_GROUP_OPTIONS"]) ? $context["S_GROUP_OPTIONS"] : null);
        echo "</select></dd>
</dl>
<dl>
\t<dt><label for=\"usernames\">";
        // line 25
        echo $this->env->getExtension('phpbb')->lang("SEND_TO_USERS");
        echo $this->env->getExtension('phpbb')->lang("COLON");
        echo "</label><br /><span>";
        echo $this->env->getExtension('phpbb')->lang("SEND_TO_USERS_EXPLAIN");
        echo "</span></dt>
\t<dd><textarea name=\"usernames\" id=\"usernames\" rows=\"5\" cols=\"40\">";
        // line 26
        echo (isset($context["USERNAMES"]) ? $context["USERNAMES"] : null);
        echo "</textarea></dd>
\t<dd>[ <a href=\"";
        // line 27
        echo (isset($context["U_FIND_USERNAME"]) ? $context["U_FIND_USERNAME"] : null);
        echo "\" onclick=\"find_username(this.href); return false;\">";
        echo $this->env->getExtension('phpbb')->lang("FIND_USERNAME");
        echo "</a> ]</dd>
</dl>
<dl>
\t<dt><label for=\"subject\">";
        // line 30
        echo $this->env->getExtension('phpbb')->lang("SUBJECT");
        echo $this->env->getExtension('phpbb')->lang("COLON");
        echo "</label></dt>
\t<dd><input name=\"subject\" type=\"text\" id=\"subject\" value=\"";
        // line 31
        echo (isset($context["SUBJECT"]) ? $context["SUBJECT"] : null);
        echo "\" /></dd>
</dl>
<dl>
\t<dt><label for=\"message\">";
        // line 34
        echo $this->env->getExtension('phpbb')->lang("MASS_MESSAGE");
        echo $this->env->getExtension('phpbb')->lang("COLON");
        echo "</label><br /><span>";
        echo $this->env->getExtension('phpbb')->lang("MASS_MESSAGE_EXPLAIN");
        echo "</span></dt>
\t<dd><textarea id=\"message\" name=\"message\" rows=\"10\" cols=\"60\">";
        // line 35
        echo (isset($context["MESSAGE"]) ? $context["MESSAGE"] : null);
        echo "</textarea></dd>
</dl>
<dl>
\t<dt><label for=\"priority\">";
        // line 38
        echo $this->env->getExtension('phpbb')->lang("MAIL_PRIORITY");
        echo $this->env->getExtension('phpbb')->lang("COLON");
        echo "</label></dt>
\t<dd><select id=\"priority\" name=\"mail_priority_flag\">";
        // line 39
        echo (isset($context["S_PRIORITY_OPTIONS"]) ? $context["S_PRIORITY_OPTIONS"] : null);
        echo "</select></dd>
</dl>
<dl>
\t<dt><label for=\"banned\">";
        // line 42
        echo $this->env->getExtension('phpbb')->lang("MAIL_BANNED");
        echo $this->env->getExtension('phpbb')->lang("COLON");
        echo "</label><br /><span>";
        echo $this->env->getExtension('phpbb')->lang("MAIL_BANNED_EXPLAIN");
        echo "</span></dt>
\t<dd><input id=\"banned\" name=\"mail_banned_flag\" type=\"checkbox\" class=\"radio\" /></dd>
</dl>
<dl>
\t<dt><label for=\"send\">";
        // line 46
        echo $this->env->getExtension('phpbb')->lang("SEND_IMMEDIATELY");
        echo $this->env->getExtension('phpbb')->lang("COLON");
        echo "</label></dt>
\t<dd><input id=\"send\" type=\"checkbox\" class=\"radio\" name=\"send_immediately\" checked=\"checked\" /></dd>
</dl>

";
        // line 50
        // line 51
        echo "
<p class=\"submit-buttons\">
\t<input class=\"button1\" type=\"submit\" id=\"submit\" name=\"submit\" value=\"";
        // line 53
        echo $this->env->getExtension('phpbb')->lang("SEND_EMAIL");
        echo "\" />&nbsp;
\t<input class=\"button2\" type=\"reset\" id=\"reset\" name=\"reset\" value=\"";
        // line 54
        echo $this->env->getExtension('phpbb')->lang("RESET");
        echo "\" />
</p>
";
        // line 56
        echo (isset($context["S_FORM_TOKEN"]) ? $context["S_FORM_TOKEN"] : null);
        echo "
</fieldset>
</form>

";
        // line 60
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->env->loadTemplate("overall_footer.html")->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "acp_email.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  179 => 60,  172 => 56,  167 => 54,  163 => 53,  159 => 51,  158 => 50,  150 => 46,  140 => 42,  134 => 39,  129 => 38,  123 => 35,  116 => 34,  110 => 31,  105 => 30,  97 => 27,  93 => 26,  86 => 25,  80 => 22,  75 => 21,  70 => 19,  64 => 16,  61 => 15,  55 => 12,  51 => 11,  48 => 10,  46 => 9,  41 => 7,  36 => 5,  31 => 2,  19 => 1,);
    }
}
