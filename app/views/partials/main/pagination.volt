{% set link = url.get() ~ substr(router.getRewriteUri(), 1) %}
<nav aria-label="..."> 
  <ul class="pagination"> 
    <li><a href="{{ link }}?page={{ paginate.before }}" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
    {% if paginate.total_pages > 10 %}
      {% if paginate.current > 5 %}
        {% for i in paginate.current-4..paginate.current+5 %}
          {% if i <= paginate.total_pages %}
            <li {% if paginate.current == i %}class="active"{% endif %}><a href="{{ link }}?page={{ i }}">{{ i }}</a></li>
          {% endif %}
        {% endfor %}
      {% else %}
        {% for i in 1..10 %}
          <li {% if paginate.current == i %}class="active"{% endif %}><a href="{{ link }}?page={{ i }}">{{ i }}</a></li>
        {% endfor %}
      {% endif %}
    {% else %}
      {% for i in 1..paginate.total_pages %}
        <li {% if paginate.current == i %}class="active"{% endif %}><a href="{{ link }}?page={{ i }}">{{ i }}</a></li>
      {% endfor %}
    {% endif %}
    <li><a href="{{ link }}?page={{ paginate.next }}" aria-label="Next"><span aria-hidden="true">»</span></a></li> 
  </ul> 
</nav>