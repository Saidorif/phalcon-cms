<div class="ui segment">
    <a href="{{ url.get() }}products/admin/edit/{{ model.getId() }}?lang={{ constant('LANG') }}" class="ui button">
        <i class="icon left arrow"></i> {{helper.at('Back')}}
    </a>

    <form method="post" class="ui negative message form" action="">
        <p>{{helper.at('Delete product')}} <b>{{ model.getTitle() }}</b>?</p>
        <button type="submit" class="ui button negative"><i class="icon trash"></i> {{helper.at('Delete')}}</button>
    </form>

</div>

