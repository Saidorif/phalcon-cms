<div class="ui segment">
    <a href="{{ url.get() }}services/category/edit/{{ model.getId() }}?lang={{ constant('LANG') }}" class="ui button">
        <i class="icon left arrow"></i> {{helper.at('Back')}}
    </a>
</div>

<form method="post" class="ui negative message form" action="">
    <p>{{helper.at('Delete type of publication')}} <b>{{ model.getTitle() }}</b>?</p>
    <button type="submit" class="ui button negative"><i class="icon trash"></i> Delete</button>
</form>