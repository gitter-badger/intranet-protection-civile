<?php

/* acp_permission_roles.html */
class __TwigTemplate_943166821f6ae61ca41dc7b9d2e4e72d extends Twig_Template
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

";
        // line 5
        if ((isset($context["S_EDIT"]) ? $context["S_EDIT"] : null)) {
            // line 6
            echo "
\t<script type=\"text/javascript\">
\t// <![CDATA[
\t\tvar active_pmask = '0';
\t\tvar active_fmask = '0';
\t\tvar active_cat = '0';

\t\tvar id = '000';

\t\tvar role_options = new Array();

\t\t";
            // line 17
            if ((isset($context["S_ROLE_JS_ARRAY"]) ? $context["S_ROLE_JS_ARRAY"] : null)) {
                // line 18
                echo "\t\t\t";
                echo (isset($context["S_ROLE_JS_ARRAY"]) ? $context["S_ROLE_JS_ARRAY"] : null);
                echo "
\t\t";
            }
            // line 20
            echo "\t// ]]>
\t</script>

\t<script type=\"text/javascript\" src=\"style/permissions.js\"></script>

\t<a href=\"";
            // line 25
            echo (isset($context["U_BACK"]) ? $context["U_BACK"] : null);
            echo "\" style=\"float: ";
            echo (isset($context["S_CONTENT_FLOW_END"]) ? $context["S_CONTENT_FLOW_END"] : null);
            echo ";\">&laquo; ";
            echo $this->env->getExtension('phpbb')->lang("BACK");
            echo "</a>

\t<h1>";
            // line 27
            echo $this->env->getExtension('phpbb')->lang("TITLE");
            echo "</h1>

\t<p>";
            // line 29
            echo $this->env->getExtension('phpbb')->lang("EXPLAIN");
            echo "</p>

\t<br />
\t<a href=\"#acl\">&raquo; ";
            // line 32
            echo $this->env->getExtension('phpbb')->lang("SET_ROLE_PERMISSIONS");
            echo "</a>

\t<form id=\"acp_roles\" method=\"post\" action=\"";
            // line 34
            echo (isset($context["U_ACTION"]) ? $context["U_ACTION"] : null);
            echo "\">

\t<fieldset>
\t\t<legend>";
            // line 37
            echo $this->env->getExtension('phpbb')->lang("ROLE_DETAILS");
            echo "</legend>
\t<dl>
\t\t<dt><label for=\"role_name\">";
            // line 39
            echo $this->env->getExtension('phpbb')->lang("ROLE_NAME");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label></dt>
\t\t<dd><input name=\"role_name\" type=\"text\" id=\"role_name\" value=\"";
            // line 40
            echo (isset($context["ROLE_NAME"]) ? $context["ROLE_NAME"] : null);
            echo "\" maxlength=\"255\" /></dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"role_description\">";
            // line 43
            echo $this->env->getExtension('phpbb')->lang("ROLE_DESCRIPTION");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label><br /><span>";
            echo $this->env->getExtension('phpbb')->lang("ROLE_DESCRIPTION_EXPLAIN");
            echo "</span></dt>
\t\t<dd><textarea id=\"role_description\" name=\"role_description\" rows=\"3\" cols=\"45\">";
            // line 44
            echo (isset($context["ROLE_DESCRIPTION"]) ? $context["ROLE_DESCRIPTION"] : null);
            echo "</textarea></dd>
\t</dl>

\t<p class=\"quick\">
\t\t<input type=\"submit\" class=\"button1\" name=\"submit\" value=\"";
            // line 48
            echo $this->env->getExtension('phpbb')->lang("SUBMIT");
            echo "\" />
\t\t";
            // line 49
            echo (isset($context["S_FORM_TOKEN"]) ? $context["S_FORM_TOKEN"] : null);
            echo "
\t</p>
\t</fieldset>

\t";
            // line 53
            if ((isset($context["S_DISPLAY_ROLE_MASK"]) ? $context["S_DISPLAY_ROLE_MASK"] : null)) {
                // line 54
                echo "
\t\t<h1>";
                // line 55
                echo $this->env->getExtension('phpbb')->lang("ROLE_ASSIGNED_TO");
                echo "</h1>

\t\t";
                // line 57
                $location = "permission_roles_mask.html";
                $namespace = false;
                if (strpos($location, '@') === 0) {
                    $namespace = substr($location, 1, strpos($location, '/') - 1);
                    $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                    $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
                }
                $this->env->loadTemplate("permission_roles_mask.html")->display($context);
                if ($namespace) {
                    $this->env->setNamespaceLookUpOrder($previous_look_up_order);
                }
                // line 58
                echo "
\t";
            }
            // line 60
            echo "
\t<p>

\t<a id=\"acl\"></a>

\t<a href=\"#maincontent\">&raquo; ";
            // line 65
            echo $this->env->getExtension('phpbb')->lang("BACK_TO_TOP");
            echo "</a><br />
\t<br /><br />

\t</p>

\t<h1>";
            // line 70
            echo $this->env->getExtension('phpbb')->lang("ACL_TYPE");
            echo "</h1>

\t<fieldset class=\"perm nolegend\">

\t\t<div id=\"advanced00\">
\t\t\t<div class=\"permissions-category\">
\t\t\t\t<ul>
\t\t\t\t";
            // line 77
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["loops"]) ? $context["loops"] : null), "auth"));
            foreach ($context['_seq'] as $context["_key"] => $context["auth"]) {
                // line 78
                echo "\t\t\t\t\t";
                if ($this->getAttribute((isset($context["auth"]) ? $context["auth"] : null), "S_YES")) {
                    // line 79
                    echo "\t\t\t\t\t\t<li class=\"permissions-preset-yes";
                    if ($this->getAttribute((isset($context["auth"]) ? $context["auth"] : null), "S_FIRST_ROW")) {
                        echo " activetab";
                    }
                    echo "\" id=\"tab00";
                    echo $this->getAttribute((isset($context["auth"]) ? $context["auth"] : null), "S_ROW_COUNT");
                    echo "\">
\t\t\t\t\t";
                } elseif ($this->getAttribute((isset($context["auth"]) ? $context["auth"] : null), "S_NEVER")) {
                    // line 81
                    echo "\t\t\t\t\t\t<li class=\"permissions-preset-never";
                    if ($this->getAttribute((isset($context["auth"]) ? $context["auth"] : null), "S_FIRST_ROW")) {
                        echo " activetab";
                    }
                    echo "\" id=\"tab00";
                    echo $this->getAttribute((isset($context["auth"]) ? $context["auth"] : null), "S_ROW_COUNT");
                    echo "\">
\t\t\t\t\t";
                } elseif ($this->getAttribute((isset($context["auth"]) ? $context["auth"] : null), "S_NO")) {
                    // line 83
                    echo "\t\t\t\t\t\t<li class=\"permissions-preset-no";
                    if ($this->getAttribute((isset($context["auth"]) ? $context["auth"] : null), "S_FIRST_ROW")) {
                        echo " activetab";
                    }
                    echo "\" id=\"tab00";
                    echo $this->getAttribute((isset($context["auth"]) ? $context["auth"] : null), "S_ROW_COUNT");
                    echo "\">
\t\t\t\t\t";
                } else {
                    // line 85
                    echo "\t\t\t\t\t\t<li class=\"permissions-preset-custom";
                    if ($this->getAttribute((isset($context["auth"]) ? $context["auth"] : null), "S_FIRST_ROW")) {
                        echo " activetab";
                    }
                    echo "\" id=\"tab00";
                    echo $this->getAttribute((isset($context["auth"]) ? $context["auth"] : null), "S_ROW_COUNT");
                    echo "\">
\t\t\t\t\t";
                }
                // line 87
                echo "\t\t\t\t\t\t<a href=\"#\" onclick=\"swap_options('0','0','";
                echo $this->getAttribute((isset($context["auth"]) ? $context["auth"] : null), "S_ROW_COUNT");
                echo "'); return false;\"><span class=\"tabbg\"><span class=\"colour\"></span>";
                echo $this->getAttribute((isset($context["auth"]) ? $context["auth"] : null), "CAT_NAME");
                echo "</span></a></li>\t
\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['auth'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 89
            echo "\t\t\t\t</ul>
\t\t\t</div>
\t\t\t";
            // line 91
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["loops"]) ? $context["loops"] : null), "auth"));
            foreach ($context['_seq'] as $context["_key"] => $context["auth"]) {
                // line 92
                echo "\t\t\t<div class=\"permissions-panel\" id=\"options00";
                echo $this->getAttribute((isset($context["auth"]) ? $context["auth"] : null), "S_ROW_COUNT");
                echo "\"";
                if ($this->getAttribute((isset($context["auth"]) ? $context["auth"] : null), "S_FIRST_ROW")) {
                } else {
                    echo " style=\"display: none;\"";
                }
                echo ">
\t\t\t\t<div class=\"tablewrap\">
\t\t\t\t\t<table id=\"table00";
                // line 94
                echo $this->getAttribute((isset($context["auth"]) ? $context["auth"] : null), "S_ROW_COUNT");
                echo "\" class=\"table1 not-responsive\">
\t\t\t\t\t<colgroup>
\t\t\t\t\t\t<col class=\"permissions-name\" />
\t\t\t\t\t\t<col class=\"permissions-yes\" />
\t\t\t\t\t\t<col class=\"permissions-no\" />
\t\t\t\t\t\t<col class=\"permissions-never\" />
\t\t\t\t\t</colgroup>
\t\t\t\t\t<thead>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<th class=\"name\" scope=\"col\"><strong>";
                // line 103
                echo $this->env->getExtension('phpbb')->lang("ACL_SETTING");
                echo "</strong></th>
\t\t\t\t\t\t<th class=\"value permissions-yes\" scope=\"col\"><a href=\"#\" onclick=\"mark_options('options00";
                // line 104
                echo $this->getAttribute((isset($context["auth"]) ? $context["auth"] : null), "S_ROW_COUNT");
                echo "', 'y'); set_colours('00";
                echo $this->getAttribute((isset($context["auth"]) ? $context["auth"] : null), "S_ROW_COUNT");
                echo "', false, 'yes'); return false;\">";
                echo $this->env->getExtension('phpbb')->lang("ACL_YES");
                echo "</a></th>
\t\t\t\t\t\t<th class=\"value permissions-no\" scope=\"col\"><a href=\"#\" onclick=\"mark_options('options00";
                // line 105
                echo $this->getAttribute((isset($context["auth"]) ? $context["auth"] : null), "S_ROW_COUNT");
                echo "', 'u'); set_colours('00";
                echo $this->getAttribute((isset($context["auth"]) ? $context["auth"] : null), "S_ROW_COUNT");
                echo "', false, 'no'); return false;\">";
                echo $this->env->getExtension('phpbb')->lang("ACL_NO");
                echo "</a></th>
\t\t\t\t\t\t<th class=\"value permissions-never\" scope=\"col\"><a href=\"#\" onclick=\"mark_options('options00";
                // line 106
                echo $this->getAttribute((isset($context["auth"]) ? $context["auth"] : null), "S_ROW_COUNT");
                echo "', 'n'); set_colours('00";
                echo $this->getAttribute((isset($context["auth"]) ? $context["auth"] : null), "S_ROW_COUNT");
                echo "', false, 'never'); return false;\">";
                echo $this->env->getExtension('phpbb')->lang("ACL_NEVER");
                echo "</a></th>
\t\t\t\t\t</tr>
\t\t\t\t\t</thead>
\t\t\t\t\t<tbody>
\t\t\t\t\t";
                // line 110
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["auth"]) ? $context["auth"] : null), "mask"));
                foreach ($context['_seq'] as $context["_key"] => $context["mask"]) {
                    // line 111
                    echo "\t\t\t\t\t\t";
                    if (($this->getAttribute((isset($context["mask"]) ? $context["mask"] : null), "S_ROW_COUNT") % 2 == 0)) {
                        echo "<tr class=\"row4\">";
                    } else {
                        echo "<tr class=\"row3\">";
                    }
                    // line 112
                    echo "\t\t\t\t\t\t<th class=\"permissions-name";
                    if (($this->getAttribute((isset($context["mask"]) ? $context["mask"] : null), "S_ROW_COUNT") % 2 == 0)) {
                        echo " row4";
                    } else {
                        echo " row3";
                    }
                    echo "\">";
                    echo $this->getAttribute((isset($context["mask"]) ? $context["mask"] : null), "PERMISSION");
                    echo "</th>
\t\t\t\t\t\t\t
\t\t\t\t\t\t<td class=\"permissions-yes\"><label for=\"setting_";
                    // line 114
                    echo $this->getAttribute((isset($context["mask"]) ? $context["mask"] : null), "FIELD_NAME");
                    echo "_y\"><input onchange=\"set_colours('00";
                    echo $this->getAttribute((isset($context["auth"]) ? $context["auth"] : null), "S_ROW_COUNT");
                    echo "', false)\" id=\"setting_";
                    echo $this->getAttribute((isset($context["mask"]) ? $context["mask"] : null), "FIELD_NAME");
                    echo "_y\" name=\"setting[";
                    echo $this->getAttribute((isset($context["mask"]) ? $context["mask"] : null), "FIELD_NAME");
                    echo "]\" class=\"radio\" type=\"radio\"";
                    if ($this->getAttribute((isset($context["mask"]) ? $context["mask"] : null), "S_YES")) {
                        echo " checked=\"checked\"";
                    }
                    echo " value=\"1\" /></label></td>
\t\t\t\t\t\t<td class=\"permissions-no\"><label for=\"setting_";
                    // line 115
                    echo $this->getAttribute((isset($context["mask"]) ? $context["mask"] : null), "FIELD_NAME");
                    echo "_u\"><input onchange=\"set_colours('00";
                    echo $this->getAttribute((isset($context["auth"]) ? $context["auth"] : null), "S_ROW_COUNT");
                    echo "', false)\" id=\"setting_";
                    echo $this->getAttribute((isset($context["mask"]) ? $context["mask"] : null), "FIELD_NAME");
                    echo "_u\" name=\"setting[";
                    echo $this->getAttribute((isset($context["mask"]) ? $context["mask"] : null), "FIELD_NAME");
                    echo "]\" class=\"radio\" type=\"radio\"";
                    if ($this->getAttribute((isset($context["mask"]) ? $context["mask"] : null), "S_NO")) {
                        echo " checked=\"checked\"";
                    }
                    echo " value=\"-1\" /></label></td>
\t\t\t\t\t\t<td class=\"permissions-never\"><label for=\"setting_";
                    // line 116
                    echo $this->getAttribute((isset($context["mask"]) ? $context["mask"] : null), "FIELD_NAME");
                    echo "_n\"><input onchange=\"set_colours('00";
                    echo $this->getAttribute((isset($context["auth"]) ? $context["auth"] : null), "S_ROW_COUNT");
                    echo "', false)\" id=\"setting_";
                    echo $this->getAttribute((isset($context["mask"]) ? $context["mask"] : null), "FIELD_NAME");
                    echo "_n\" name=\"setting[";
                    echo $this->getAttribute((isset($context["mask"]) ? $context["mask"] : null), "FIELD_NAME");
                    echo "]\" class=\"radio\" type=\"radio\"";
                    if ($this->getAttribute((isset($context["mask"]) ? $context["mask"] : null), "S_NEVER")) {
                        echo " checked=\"checked\"";
                    }
                    echo " value=\"0\" /></label></td>
\t\t\t\t\t</tr>
\t\t\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['mask'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 119
                echo "\t\t\t\t\t</tbody>
\t\t\t\t\t</table>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['auth'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 124
            echo "\t\t</div>

\t</fieldset>

\t<fieldset class=\"quick\">
\t\t<input type=\"submit\" class=\"button1\" name=\"submit\" value=\"";
            // line 129
            echo $this->env->getExtension('phpbb')->lang("SUBMIT");
            echo "\" />
\t\t";
            // line 130
            echo (isset($context["S_FORM_TOKEN"]) ? $context["S_FORM_TOKEN"] : null);
            echo "
\t</fieldset>
\t</form>

\t<a href=\"#maincontent\">&raquo; ";
            // line 134
            echo $this->env->getExtension('phpbb')->lang("BACK_TO_TOP");
            echo "</a><br />
\t<br />

";
        } else {
            // line 138
            echo "
\t<h1>";
            // line 139
            echo $this->env->getExtension('phpbb')->lang("TITLE");
            echo "</h1>

\t<p>";
            // line 141
            echo $this->env->getExtension('phpbb')->lang("EXPLAIN");
            echo "</p>

\t<form id=\"acp_roles\" method=\"post\" action=\"";
            // line 143
            echo (isset($context["U_ACTION"]) ? $context["U_ACTION"] : null);
            echo "\">

\t<table class=\"table1\">
\t\t<col class=\"col2\" /><col class=\"col2\" /><col class=\"col1\" /><col class=\"col2\" /><col class=\"col2\" />
\t<thead>
\t<tr>
\t\t<th>";
            // line 149
            echo $this->env->getExtension('phpbb')->lang("ROLE_NAME");
            echo "</th>
\t\t<th colspan=\"2\">";
            // line 150
            echo $this->env->getExtension('phpbb')->lang("OPTIONS");
            echo "</th>
\t</tr>
\t</thead>
\t<tbody>
\t";
            // line 154
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["loops"]) ? $context["loops"] : null), "roles"));
            foreach ($context['_seq'] as $context["_key"] => $context["roles"]) {
                // line 155
                echo "\t<tr>
\t\t<td style=\"vertical-align: top;\"><strong>";
                // line 156
                echo $this->getAttribute((isset($context["roles"]) ? $context["roles"] : null), "ROLE_NAME");
                echo "</strong>
\t\t\t";
                // line 157
                if ($this->getAttribute((isset($context["roles"]) ? $context["roles"] : null), "ROLE_DESCRIPTION")) {
                    echo "<br /><span>";
                    echo $this->getAttribute((isset($context["roles"]) ? $context["roles"] : null), "ROLE_DESCRIPTION");
                    echo "</span>";
                }
                // line 158
                echo "\t\t</td>
\t\t<td style=\"width: 30%; text-align: center; vertical-align: top; white-space: nowrap;\">";
                // line 159
                if ($this->getAttribute((isset($context["roles"]) ? $context["roles"] : null), "U_DISPLAY_ITEMS")) {
                    echo "<a href=\"";
                    echo $this->getAttribute((isset($context["roles"]) ? $context["roles"] : null), "U_DISPLAY_ITEMS");
                    echo "\">";
                    echo $this->env->getExtension('phpbb')->lang("VIEW_ASSIGNED_ITEMS");
                    echo "</a>";
                } else {
                    echo $this->env->getExtension('phpbb')->lang("VIEW_ASSIGNED_ITEMS");
                }
                echo "</td>
\t\t<td class=\"actions\">
\t\t\t<span class=\"up-disabled\" style=\"display:none;\">";
                // line 161
                echo (isset($context["ICON_MOVE_UP_DISABLED"]) ? $context["ICON_MOVE_UP_DISABLED"] : null);
                echo "</span>
\t\t\t<span class=\"up\"><a href=\"";
                // line 162
                echo $this->getAttribute((isset($context["roles"]) ? $context["roles"] : null), "U_MOVE_UP");
                echo "\" data-ajax=\"row_up\">";
                echo (isset($context["ICON_MOVE_UP"]) ? $context["ICON_MOVE_UP"] : null);
                echo "</a></span>
\t\t\t<span class=\"down-disabled\" style=\"display:none;\">";
                // line 163
                echo (isset($context["ICON_MOVE_DOWN_DISABLED"]) ? $context["ICON_MOVE_DOWN_DISABLED"] : null);
                echo "</span>
\t\t\t<span class=\"down\"><a href=\"";
                // line 164
                echo $this->getAttribute((isset($context["roles"]) ? $context["roles"] : null), "U_MOVE_DOWN");
                echo "\" data-ajax=\"row_down\">";
                echo (isset($context["ICON_MOVE_DOWN"]) ? $context["ICON_MOVE_DOWN"] : null);
                echo "</a></span>
\t\t\t<a href=\"";
                // line 165
                echo $this->getAttribute((isset($context["roles"]) ? $context["roles"] : null), "U_EDIT");
                echo "\" title=\"";
                echo $this->env->getExtension('phpbb')->lang("EDIT_ROLE");
                echo "\">";
                echo (isset($context["ICON_EDIT"]) ? $context["ICON_EDIT"] : null);
                echo "</a> 
\t\t\t<a href=\"";
                // line 166
                echo $this->getAttribute((isset($context["roles"]) ? $context["roles"] : null), "U_REMOVE");
                echo "\" title=\"";
                echo $this->env->getExtension('phpbb')->lang("REMOVE_ROLE");
                echo "\" data-ajax=\"row_delete\">";
                echo (isset($context["ICON_DELETE"]) ? $context["ICON_DELETE"] : null);
                echo "</a>
\t\t</td>
\t</tr>
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['roles'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 170
            echo "\t</tbody>
\t</table>

\t<fieldset class=\"quick\">
\t\t";
            // line 174
            echo $this->env->getExtension('phpbb')->lang("CREATE_ROLE");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo " <input type=\"text\" name=\"role_name\" value=\"\" maxlength=\"255\" />";
            if ((isset($context["S_ROLE_OPTIONS"]) ? $context["S_ROLE_OPTIONS"] : null)) {
                echo " <select name=\"options_from\"><option value=\"0\" selected=\"selected\">";
                echo $this->env->getExtension('phpbb')->lang("CREATE_ROLE_FROM");
                echo "</option>";
                echo (isset($context["S_ROLE_OPTIONS"]) ? $context["S_ROLE_OPTIONS"] : null);
                echo "</select>";
            }
            echo " <input class=\"button2\" type=\"submit\" name=\"add\" value=\"";
            echo $this->env->getExtension('phpbb')->lang("SUBMIT");
            echo "\" /><br />
\t\t";
            // line 175
            echo (isset($context["S_FORM_TOKEN"]) ? $context["S_FORM_TOKEN"] : null);
            echo "
\t</fieldset>
\t</form>

\t";
            // line 179
            if ((isset($context["S_DISPLAY_ROLE_MASK"]) ? $context["S_DISPLAY_ROLE_MASK"] : null)) {
                // line 180
                echo "
\t\t<a id=\"assigned_to\"></a>

\t\t<h1>";
                // line 183
                echo $this->env->getExtension('phpbb')->lang("ROLE_ASSIGNED_TO");
                echo "</h1>

\t\t";
                // line 185
                $location = "permission_roles_mask.html";
                $namespace = false;
                if (strpos($location, '@') === 0) {
                    $namespace = substr($location, 1, strpos($location, '/') - 1);
                    $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                    $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
                }
                $this->env->loadTemplate("permission_roles_mask.html")->display($context);
                if ($namespace) {
                    $this->env->setNamespaceLookUpOrder($previous_look_up_order);
                }
                // line 186
                echo "
\t";
            }
            // line 188
            echo "
";
        }
        // line 190
        echo "
";
        // line 191
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
        return "acp_permission_roles.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  585 => 191,  582 => 190,  578 => 188,  574 => 186,  562 => 185,  557 => 183,  552 => 180,  550 => 179,  543 => 175,  528 => 174,  522 => 170,  508 => 166,  500 => 165,  494 => 164,  490 => 163,  484 => 162,  480 => 161,  467 => 159,  464 => 158,  458 => 157,  454 => 156,  451 => 155,  447 => 154,  440 => 150,  436 => 149,  427 => 143,  422 => 141,  417 => 139,  414 => 138,  407 => 134,  400 => 130,  396 => 129,  389 => 124,  379 => 119,  360 => 116,  346 => 115,  332 => 114,  320 => 112,  313 => 111,  309 => 110,  298 => 106,  290 => 105,  282 => 104,  278 => 103,  266 => 94,  255 => 92,  251 => 91,  247 => 89,  236 => 87,  226 => 85,  216 => 83,  206 => 81,  196 => 79,  193 => 78,  189 => 77,  179 => 70,  171 => 65,  164 => 60,  160 => 58,  148 => 57,  143 => 55,  140 => 54,  138 => 53,  131 => 49,  127 => 48,  120 => 44,  113 => 43,  107 => 40,  102 => 39,  97 => 37,  91 => 34,  86 => 32,  80 => 29,  75 => 27,  66 => 25,  59 => 20,  53 => 18,  51 => 17,  38 => 6,  36 => 5,  31 => 2,  19 => 1,);
    }
}
