<form method="post" action="" class="ui form" enctype="multipart/form-data">
    <div class="ui segment">
        <a href="{{ url.get() }}documentation/admin/index" class="ui button">
            <i class="icon left arrow"></i> {{ helper.at('Back') }}
        </a>

        <div class="ui positive submit button">
            <i class="save icon"></i> {{ helper.at('Save') }}
        </div>

        {% if documentation is defined %}
            <a href="{{ url.get() }}documentation/admin/delete/{{ documentation.getId() }}?lang={{ constant('LANG') }}" class="ui button red">
                <i class="icon trash"></i> {{ helper.at('Delete') }}
            </a>
        {% endif %}
    </div>

    <div class="ui segment">
      <div class="ui grid">
        <div class="twelve wide column">
          {{ form.renderDecorated('title') }}
          {{ form.renderDecorated('author') }}
          {{ form.renderDecorated('text') }}
          {{ form.renderDecorated('category_id') }}
          {{ form.renderDecorated('sources') }}
          {{ form.renderDecorated('url') }}
          {{ form.renderDecorated('file') }}
        </div>
        <div class="four wide column">
          {{ form.renderDecorated('image') }}
        </div>
      </div>
    </div>

</form>

<script>
    $(".ui.form").form({
        fields: {
            title: {
                identifier: 'title',
                rules: [
                    {type: 'empty'}
                ]
            }
        }
    });

  $(document).ready(function(){
    var sources = $('#sources').val();
    var fileinput = $('.fileinput').parent();
    var inputLink = $('#url').parent();

    if(sources == 'lexuz'){
      // fileinput.hide();
      inputLink.show();
    }
    if(sources == 'file'){
      inputLink.hide();
      // fileinput.show();
    }

    $('#sources').on('change', function(){
      if($(this).val() == 'file'){
        inputLink.hide();
        // fileinput.show();
      }
      if($(this).val() == 'lexuz'){
        inputLink.show();
        // fileinput.hide();
      }
    });
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
