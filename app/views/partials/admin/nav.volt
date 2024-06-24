<div class="top-panel-admin">
  <div class="actions">
    <a href="{{ url.get() }}" class="ui blue button" target="_blank">
      <i class="home icon"></i>{{ helper.at('View Site') }}
    </a>
    <a href="javascript:void(0);" class="ui red tiny button" onclick="document.getElementById('logout-form').submit()">
      <i class="plane icon"></i>{{ helper.at('Logout') }}
    </a>

    <form action="{{ url.get() }}admin/index/logout" method="post" style="display: none;" id="logout-form">
      <input type="hidden" name="{{ security.getTokenKey() }}" value="{{ security.getToken() }}">
    </form>
  </div>
</div>

<div class="ui left fixed vertical pointing inverted menu">
  <div class="item text-center">
    <a class="eskiz_logo" href="{{ url.get() }}admin/index">
      <img src="/assets/admin/images/logo2.png" height="55" width="auto" alt="Eskiz IT Company">
    </a>
  </div>
  <div class="item">
      <div class="menu first">
          <a class="item{{ helper.activeMenu().activeClass('admin-page') }}" href="{{ url.get() }}page/admin">
              {{ helper.at('Pages') }}
          </a>
          <a class="item{{ helper.activeMenu().activeClass('admin-publication') }}"
             href="{{ url.get() }}publication/admin">
              {{ helper.at('Publications') }}
          </a>
          <a class="item{{ helper.activeMenu().activeClass('admin-widget') }}" href="{{ url.get() }}widget/admin">
              {{ helper.at('Blocks') }}
          </a>
          <a class="item{{ helper.activeMenu().activeClass('admin-slider') }}" href="{{ url.get() }}slider/admin">
              {{ helper.at('Slider') }}
          </a>
          <a class="item{{ helper.activeMenu().activeClass('admin-employee') }}" href="{{ url.get() }}employee/admin">
              {{ helper.at('Employee') }}
          </a>
          <a class="item{{ helper.activeMenu().activeClass('menu') }}" href="{{ url.get() }}menu/admin">
              {{ helper.at('Menu') }}
          </a>
          <a class="item{{ helper.activeMenu().activeClass('admin-portfolio') }}"
             href="{{ url.get() }}portfolio/admin">
              {{ helper.at('Portfolio') }}
          </a>
          <a class="item{{ helper.activeMenu().activeClass('admin-reviews') }}"
             href="{{ url.get() }}reviews/admin">
              {{ helper.at('Reviews') }}
          </a>
          <a class="item{{ helper.activeMenu().activeClass('admin-products') }}"
             href="{{ url.get() }}products/admin">
              {{ helper.at('Products') }}
          </a>
          <a class="item{{ helper.activeMenu().activeClass('admin-partner') }}"
             href="{{ url.get() }}partner/admin">
              {{ helper.at('Partner') }}
          </a>
          <a class="item{{ helper.activeMenu().activeClass('admin-faq') }}"
             href="{{ url.get() }}faq/admin">
              {{ helper.at('Faq') }}
          </a>
          <a class="item{{ helper.activeMenu().activeClass('admin-knowledge') }}"
             href="{{ url.get() }}knowledge/admin">
              База знаний
          </a>
      </div>
  </div>
  <div class="item first">
    <div class="header">{{ helper.at('Settings') }} </div>

    <div class="menu">
      <a class="item{{ helper.activeMenu().activeClass('admin-translate') }}" href="{{ url.get() }}cms/translate">
        {{ helper.at('Translate') }}
      </a>
      <a class="item{{ helper.activeMenu().activeClass('admin-settings') }}" href="{{ url.get() }}cms/settings">
        {{ helper.at('Settings site') }}
      </a>
    </div>
  </div>
  <div class="item">
      <div class="header">{{ helper.at('Admin') }}</div>

      <div class="menu">
          <a class="item{{ helper.activeMenu().activeClass('admin-user') }}" href="{{ url.get() }}admin/admin-user">
              {{ helper.at('Manage Users') }}
          </a>
          <a class="item{{ helper.activeMenu().activeClass('admin-cms') }}" href="{{ url.get() }}cms/configuration">
              {{ helper.at('CMS Configuration') }}
          </a>
          <a class="item{{ helper.activeMenu().activeClass('admin-language') }}" href="{{ url.get() }}cms/language">
              {{ helper.at('Languages') }}
          </a>
          <a class="item{{ helper.activeMenu().activeClass('admin-javascript') }}"
             href="{{ url.get() }}cms/javascript">
              {{ '<head>, <body> javascript'|escape }}
          </a>
      </div>
  </div>
  <div class="item">
    <div class="header">SEO </div>

    <div class="menu">
        <a class="item{{ helper.activeMenu().activeClass('seo-robots') }}" href="{{ url.get() }}seo/robots">
            Robots.txt
        </a>
    </div>
  </div>

</div>
