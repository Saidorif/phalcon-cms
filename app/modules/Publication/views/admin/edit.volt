<link rel="stylesheet" type="text/css" href="/assets/fonts/font-awesome/css/font-awesome.min.css" />
<style>
    #icons{
    font-family: 'FontAwesome', 'Second Font name';
    font-size:20px;
    }
</style>
<form method="post" class="ui form" action="" enctype="multipart/form-data">

    <!--controls-->
    <div class="ui segment">

        {% set typeBackUrl = ((type is defined) ? '/' ~ type : '') %}
        <a href="{{ url.get() }}publication/admin{{ typeBackUrl }}?lang={{ constant('LANG') }}" class="ui button">
            <i class="icon left arrow"></i> {{ helper.at('Back') }}
        </a>

        <div class="ui green submit button">
            <i class="save icon"></i> {{ helper.at('Save') }}
        </div>

        {% if model.getId() %}

            <a href="{{ url.get() }}publication/admin/delete/{{ model.getId() }}?lang={{ constant('LANG') }}" class="ui button red">
                <i class="icon trash"></i> {{ helper.at('Delete') }}
            </a>

            {% if model.getId() %}
                <a class="ui blue button" target="_blank"
                   href="{{ helper.langUrl(['for':'publication','type':model.getTypeSlug(), 'slug':model.getSlug()]) }}">
                    {{ helper.at('View Online') }}
                </a>
            {% endif %}

        {% endif %}

    </div>
    <!--end controls-->

    <div class="ui segment">
        <div class="ui grid">
            <div class="twelve wide column">
                {{ form.renderDecorated('title') }}
                {{ form.renderDecorated('slug') }}
                {{ form.renderDecorated('meta_title') }}
                {{ form.renderDecorated('meta_description') }}
                {{ form.renderDecorated('index_page') }}
                {{ form.renderDecorated('text') }}
            </div>
            <div class="four wide column">
                {{ form.renderDecorated('type_id') }}
                {{ form.renderDecorated('date') }}
                {{ form.renderDecorated('preview_src') }}
                {{ form.renderDecorated('icons') }}
                {{ form.renderDecorated('preview_inner') }}
            </div>
        </div>
    </div>

</form>

<!--ui semantic-->
<script>
    $( ".ui.form" ).form({
        fields: {
            title: {
                identifier: 'title',
                rules: [
                    {type: 'empty'}
                ]
            }
        }
    });
</script><!--/end ui semantic-->

<link rel="stylesheet" href="{{ url.path() }}vendor/bootstrap/datetimepicker/bootstrap-datetimepicker.min.css">
<script src="{{ url.path() }}vendor/bootstrap/datetimepicker/moment.js"></script>
<script src="{{ url.path() }}vendor/bootstrap/datetimepicker/bootstrap-datetimepicker.min.js"></script>
<script>
    $('#date').datetimepicker({
        locale: 'en',
        format: 'YYYY-MM-DD HH:mm:ss',
        showClose: true
    });
</script>

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