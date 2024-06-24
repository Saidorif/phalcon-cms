{{ partial('main/header') }}

{{content()}}   

{{ partial('main/footer') }}

{% if registry.cms['PROFILER'] %}
    {{ helper.dbProfiler() }}
{% endif %}

{{ helper.javascript('body') }}