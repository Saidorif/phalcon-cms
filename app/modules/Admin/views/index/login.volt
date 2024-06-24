<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{helper.at('Login')}}</title>
    <link href="/assets/admin/favicon.png" rel="shortcut icon" type="image/vnd.microsoft.icon">
    <link href="/vendor/semantic-2.1/semantic.min.css" rel="stylesheet" type="text/css">
    <link href="/assets/admin/css/admin.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="/vendor/js/html5shiv.js"></script>
        <script src="/vendor/js/respond.min.js"></script>
    <![endif]-->
</head>
<body class="login">
    <div class="section">
        {% if blocked is not defined %}
        <form class="ui form segment" method="post" action="{{ url.get() }}admin/index/login">
            <div class="eskiz_logo"></div>
            {{ flash.output() }}
            <div class="required field">
                <label>{{helper.at('Login')}}</label>
                <div class="ui icon input">
                    {{ form.render('login') }}
                    <i class="user icon"></i>
                </div>
            </div>
            <div class="required field">
                <label>{{helper.at('Password')}}</label>
                <div class="ui icon input">
                    {{ form.render('password') }}
                    <i class="lock icon"></i>
                </div>
            </div>
            <div class="ui error message">
                <div class="header">Errors</div>
            </div>
            <input type="hidden" name="{{ security.getTokenKey() }}"
                   value="{{ security.getToken() }}"/>
            <input type="submit" id="submit" class="ui blue submit button full" value="{{helper.at('Log in')}}">

            <div class="required field">
                <a href="/" class="goto_website positive">Перейти к сайту</a>
            </div>
        </form>
        {% else %}
            <div class="ui form segment">
                <p>{{ helper.translate('Please wait for 5 minutes and try again. You are blocked') }}</p>
            </div>
        {% endif %}
    </div>
</body>
</html>
