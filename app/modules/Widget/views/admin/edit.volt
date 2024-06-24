<div class="ui segment">
    <a href="{{ url.get() }}widget/admin/index" class="ui button">
        <i class="icon left arrow"></i> {{ helper.at('Back') }}
    </a>
    {% if widget is defined %}
        <a href="{{ url.get() }}widget/admin/delete/{{ widget.getId() }}?lang={{ constant('LANG') }}" class="ui button red">
            <i class="icon trash"></i> {{ helper.at('Delete') }}
        </a>
    {% endif %}
</div>

<form method="post" action="" class="ui form segment">
    {% if widget is defined %}
        <p>ID = <b><?php echo $widget->getBlock() ?></b></p>
    {% else %}
        {{ form.renderDecorated('block') }}
    {% endif %}
    {{ form.renderDecorated('title') }}
    {{ form.renderDecorated('html') }}

    <div class="ui green submit button">
        <i class="save icon"></i> {{ helper.at('Save') }}
    </div>
</form>

<script>
    $('.ui.form').form({});
</script>

<link rel="stylesheet" href="{{ url.get() }}vendor/codemirror-4.2/lib/codemirror.css">
<script src="{{ url.get() }}vendor/codemirror-4.2/codemirror-compressed.js"></script>

<script>
    $(function () {
        CodeMirror.fromTextArea(document.getElementById('html'), {
            lineNumbers: true,               // показывать номера строк
            matchBrackets: true,             // подсвечивать парные скобки
            mode: "htmlmixed", // стиль подсветки
            indentUnit: 4,                    // размер табуляции
            viewportMargin: Infinity
        });
    });
</script>
