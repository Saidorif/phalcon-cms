

  {# {% set url = helper.currentUrl(constant('LANG')) %}
    <a href="{{ url }}"><img src="/{{ helper.logo }}" alt=""></a>

	{% set languages = helper.languages() %}
	{% if languages|length > 1 %}
    <div class="languages">
    	<div id="curLang"><span class="title"></span> <span class="caret"></span></div>
    	<ul class="language-switcher">
        {% for language in languages %}
          <li>
            {{ helper.langSwitcher(language['iso'], language['name']) }}
          </li>
        {% endfor %}
      </ul>
    </div>
	{% endif %} #}
