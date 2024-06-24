{%- macro leaf_item(leaf, url) %}
  {% set url = helper.currentUrl(constant('LANG')) ~ leaf.getSlug() %}
  {% if leaf.getStatus() == 1 %}  
    <li class="{% if leaf.hasChildren() %}dropdown{% endif %} {{helper.addActiveMenu(url)}}">
      <a href="{{ url }}" {% if leaf.hasChildren() %} class="dropdown-toggle" data-toggle="dropdown" data-target="#" {% endif %}>{{ leaf.getTitle() }} {{ helper.activeMenu().activeClass('contacts') }} {% if leaf.hasChildren() %}<span class="caret"></span>{% endif %}</a>
      {% if leaf.hasChildren() %}
        <ul class="dropdown-menu">
          {% for child in leaf.children() %}
            {{ leaf_item(child, url) }}
          {% endfor %}
        </ul>
      {% endif %}
    </li>
  {% endif %}
{%- endmacro %}

{% for root, root_title in entries %}        
  {% if root == 'main' %}
  {% set url = helper.currentUrl(constant('LANG')) %}
  <ul class="main-menu navbar-nav"> 
    <li class="{{helper.addActiveMenu(url)}}"><a href="{{ url }}">{{helper.translate('Home')}}</a></li>           
      {% set menu = menu_helper.menuUpperLeafs(root) %}
      {% for leaf in menu %}
          {{ leaf_item(leaf, url.get()) }}
      {% endfor %}
  </ul>
  {% endif %}
{% endfor %}