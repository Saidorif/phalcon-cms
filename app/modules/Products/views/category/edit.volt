<form method="post" class="ui form" action="" enctype="multipart/form-data">

    <!--controls-->
    <div class="ui segment">

        <a href="{{ url.get() }}products/category?lang={{ constant('LANG') }}" class="ui button">
            <i class="icon left arrow"></i> {{helper.at('Back')}}
        </a>

        <div class="ui green submit button">
            <i class="save icon"></i> {{helper.at('Save')}}
        </div>

        {% if model is defined %}
        {% if model.getId() %}

            <a href="{{ url.get() }}products/category/delete/{{ model.getId() }}?lang={{ constant('LANG') }}"
               class="ui button red">
                <i class="icon trash"></i> {{helper.at('Delete')}}
            </a>

            {% if model.getId() %}
                <a class="ui blue button" target="_blank"
                   href="{{ helper.langUrl(['for':'products','type':model.getSlug()]) }}">
                    See section on site
                </a>
            {% endif %}

        {% endif %}
        {% endif %}

    </div>
    <!--end controls-->

    <div class="ui segment">
        <div class="ui grid">
            <div class="ten wide column">
                {{ form.renderDecorated('title') }}
                {{ form.renderDecorated('slug') }}
                {{ form.renderDecorated('meta_title') }}
                {{ form.renderDecorated('meta_description') }}
                {{ form.renderDecorated('text') }}
            </div>            
            <div class="six wide column gallery-half">
                {{ form.renderDecorated('foto') }}
                {{ form.renderDecorated('limit') }}
                {{ form.renderDecorated('menu_check') }}
                {#{ form.renderDecorated('parent_id') }#}
                <div class="ui fluid search selection dropdown">
                  <input type="hidden" name="parent_id" {% if model is defined %}value="{{model.getParentId()}}" {% else %} value="" {% endif %}>
                  <i class="dropdown icon"></i>
                  {#% if model is defined %#} 
                    {#% if model.getParentId() %#}
                    <div class="default text">{% if model.parent %} {{model.parent.getTitle()}} {% else %} Нет родитель {% endif %}</div>
                    {#% endif %#}
                  {#% else %#}
                  <!-- <div class="default text">Нет родитель</div> -->
                  {#% endif %#}
                  {% if categories %}
                  <div class="menu">
                    {% for cat in categories %}
                    <div class="item {% if model.getId() %} {% if cat.getId() == model.getParentId() %} active selected {% endif %}{% endif %}"  data-value="{{cat.getId()}}"></i>{{cat.getTitle()}}</div>
                    {% endfor %}
                  </div>
                  {% endif %}
                </div>
            </div>
        </div>
    </div>

</form>

<!--ui semantic-->
<script>
    $('.ui.form').form({
        fields: {
            title: {
                identifier: 'title',
                rules: [
                    {type: 'empty'}
                ]
            },
            // slug: {
            //     identifier: 'slug',
            //     rules: [
            //         {type: 'empty'}
            //     ]
            // }
        }
    });
</script><!--/end ui semantic-->
<script type="text/javascript" src="{{ url.get() }}vendor/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
  tinymce.init({ selector:'#text',
  language: 'ru', 
  height: 500,
  plugins: [
    "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking responsivefilemanager",
    "table contextmenu directionality emoticons template textcolor paste textcolor colorpicker textpattern"
  ],

  toolbar1: "bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
  toolbar2: "cut copy paste | bullist numlist | blockquote | link unlink | responsivefilemanager image media | code | forecolor backcolor | table | subscript superscript",

  menubar: false,
  image_advtab: true ,
  external_filemanager_path:"/vendor/responsive_filemanager/filemanager/",
  filemanager_title:"Responsive Filemanager" ,
  external_plugins: { "filemanager" : "/vendor/responsive_filemanager/filemanager/plugin.min.js"},
  toolbar_items_size: 'small'});
</script>