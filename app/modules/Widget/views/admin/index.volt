<div class="ui segment">
    <a href="{{ url.get() }}widget/admin/add" class="ui blue button"><i
                class="add icon"></i> {{ helper.at('Add New') }}</a>
</div>

<table class="ui table very compact celled selectable">
    <thead>
    <tr>
        <th style="width:100px"></th>
        <th style="width:150px">{{ helper.at('Block ID') }}</th>
        <th style="width: 200px">{{ helper.at('Title') }}</th>
        <th>{{ helper.at('HTML') }}</th>
    </tr>
    </thead>
    <tbody>
    {% for item in entries %}
        {% set link = url.get() ~ 'widget/admin/edit/' ~ item.getId() %}
        <tr>
            <td><a href="{{ link }}?lang={{ constant('LANG') }}" class="mini ui icon button"><i class="icon edit"></i>
                    id = {{ item.getId() }}</a></td>
            <td><a href="{{ link }}?lang={{ constant('LANG') }}">{{ item.getBlock() }}</a></td>
            <td><a href="{{ link }}?lang={{ constant('LANG') }}">{{ item.getTitle() }}</a></td>
            <td><textarea>{{ item.getHtml() }}</textarea></td>
        </tr>
    {% endfor %}
    </tbody>
</table>

<link rel="stylesheet" href="{{ url.get() }}vendor/codemirror-4.2/lib/codemirror.css">
<script src="{{ url.get() }}vendor/codemirror-4.2/codemirror-compressed.js"></script>

<script>
    $(function () {
        CodeMirror.fromTextArea(document.querySelector('textarea'), {
            lineNumbers: true,               // показывать номера строк
            matchBrackets: true,             // подсвечивать парные скобки
            mode: "htmlmixed", // стиль подсветки
            indentUnit: 4,                    // размер табуляции
            viewportMargin: Infinity,
            readOnly: true
        });
    });
</script>
