{% if entries2 %}
<section class="section main-content">
  <div class="container">
    <h1 class="text-center">{{ title }}</h1>
    {{helper.widget('Breadcrumbs').breadcrumbs()}}
    <div class="row">
      <div class=" col-md-12 tender-posts">
        <div class="content">   

          <div class="docs row">
            {% for item in entries %}
              {% if item.getSources() == 'lexuz' %}
              <div class="col-md-12">
                <div class="documents2 documentation2">
                  <div class="document-img2">
                    <img src="/assets/icons/document-img.png" alt="">
                  </div><!-- /. document-img -->
                  <div class="document-content">
                    <h4><a href="{{ item.getUrl() }}">{{ item.getTitle() }}</a></h4>
                    <a href="{{ item.getUrl() }}" target="_blank" class="document-link">{{ item.getUrl() }}</a>
                    <p>
                      <a href="{{ item.getUrl() }}" target="_blank" class="document-more text-uppercase" target="_blank"><i class="fa fa-window">desktop_windows</i> {{helper.translate('To link')}}</a>
                    </p>
                  </div><!-- /. document-cotent -->
                </div>            
              </div>
              {% endif %}
              {% if item.getSources() == 'file' %}               
                <div class="col-md-6">
                  <div class="documents2 documentation2">
                    <div class="document-img2">
                      {% if item.getFormat()|lowercase == 'docx' %}
                      <img src="/assets/img/docx.png" alt="{{ item.getTitle() }}" class="img-fluid">
                      {% endif %}
                      {% if item.getFormat()|lowercase == 'doc' %}
                      <img src="/assets/img/docx.png" alt="{{ item.getTitle() }}" class="img-fluid">
                      {% endif %}
                      {% if item.getFormat()|lowercase == 'jpg' %}
                      <img src="/assets/img/jpg.png" alt="{{ item.getTitle() }}" class="img-fluid">
                      {% endif %}
                      {% if item.getFormat()|lowercase == 'jpeg' %}
                      <img src="/assets/img/jpg.png" alt="{{ item.getTitle() }}" class="img-fluid">
                      {% endif %}
                      {% if item.getFormat()|lowercase == 'pdf' %}
                      <img src="/assets/img/pdf.png" alt="{{ item.getTitle() }}" class="img-fluid">
                      {% endif %}
                    </div><!-- /. document-img -->
                  <div class="document-content2">
                    <h4><a href="{{ item.getUrl() }}{{item.getFile()}}">{{ item.getTitle() }}</a></h4>
                    <p class="down-info"><span class="space">{{ helper.translate('Format') }}: {{ item.getFormat() }}</span> <span>{{ helper.translate('Size') }}: {{ item.getSize() }} КБ</span></p>
                    <p>
                      <a href="{{ item.getUrl() }}{{item.getFile()}}" class="document-more2 text-uppercase" target="_blank"><i class="fab fa-windows"></i> {{helper.translate('Download')}}</a>
                    </p>
                  </div><!-- /. document-cotent -->
                  </div>         
                </div>
              {% endif %}
            {% endfor %}
          </div><!-- /. docs -->

        </div>
      </div>
    </div>
  </div>
</section>
{% endif %}

{% if entries3 %}
<!-- site content start -->
<main class="content center-block">
    <div class="content__inner">
        {{helper.widget('Breadcrumbs').breadcrumbs()}}
        <div class="content__h1-wrap">
            <div class="content__h1">{{ title }}</div>
                <div class="content__print-share">
                <a href="#!" class="content__share"><img src="/assets/icons/share_blue.svg" alt="">Поделиться</a>
                    <a href="#!" class="content__print"><img src="/assets/icons/print_green.svg" alt="">Печатать</a>
            </div>
        </div>
    <div class="news-list {{ format }}">
{% if categories %}
<div class="nav nav-tabs mb-4" id="myTab" role="tablist">
  {% for index, cat in categories %}
  <a class="btn btn-success cats-btn {% if index == 0 %}active{% endif %}" id="home-tab{{index}}" data-toggle="tab" href="#home{{index}}" role="tab" aria-controls="home{{index}}" aria-selected="true">{{cat.getTitle()}}</a>
  {% endfor %}
</div>
{% endif %}

{% if categories %}
<div class="tab-content" id="myTabContent">
{% for index, cat in categories %}
{% set entries = cat.documents %}
  <div class="tab-pane fade {% if index == 0 %}show active{% endif %}" id="home{{index}}" role="tabpanel" aria-labelledby="home-tab{{index}}">
      {% for item in entries %}
        {% set image = helper.image([
          'id': item.getId(),
          'type': 'documentation',
          'width': 250,
          'height': 340,
          'strategy': 'a'
        ]) %}
        {% if image.isExists() %}{% set imageExists = true %}{% else %}{% set imageExists = false %}{% endif %}
        <div class="news-list__item">
            <div class="news-list__image">
                {% if imageExists %}
                  {{ image.imageHTML() }}
                {% endif %}
            </div>

            <div class="news-list__body">
                <div class="news-list__title">
                    {{ item.title }}
                </div>

                <div class="news-list__text-part">
                    <div class="news-list__anonce">
                        <p>{{helper.translate('Author')}} : {{item.getAuthor()}}</p>
                        <p>{{helper.translate('Annotation')}} : {{item.getText()}}</p>
                    </div>
                    <div class="btn-groups library-items">
                    {% if item.getFormat()|lowercase == 'pdf' %}
                    {% if item.getSources() == 'lexuz' %}
                    {% set file = item.getUrl() %}
                    {% else %}
                    {% set file = item.getUrl() ~ item.getFile() %}
                    {% endif %}
                      <a href="{{file}}" data-fancybox="gallery" class="btn btn-main"><i class="fa fa-eye"></i> {{helper.translate('Read on site')}}</a>
                      <a href="{{file}}" download class="btn btn-main"><i class="fa fa-download"></i> {{helper.translate('Download')}}</a>
                    {% endif %}
                    
                      <a href="#" class="s_facebook share_item social-sharing_w"><i class="fa fa-facebook"></i></a>
                      <a href="#" class="s_twitter share_item social-sharing_w"><i class="fa fa-twitter"></i></a>
                      <a href="#" class="s_telegram share_item social-sharing_w"><i class="fa fa-telegram"></i></a>
                    
                    <script type="text/javascript">
                      jQuery(document).ready(function () {
                        var site_url = $(location).attr('href');
                        $(".social-sharing_w").ShareLink({"title":"{{ item.getTitle() }}","text":"{{ helper.announce(item.getText(),100) }}","image":"/{{ item.getImage() }}", "url":site_url});
                      });
                    </script>
                    </div>
                </div>
            </div>
        </div>      
      {% endfor %}
  </div>
{% endfor %}
</div>
{% endif %}

    </div>
    </div>

    <aside class="right-bar">
        {{helper.widget('Menu').sidebarMenu()}}

        <div class="right-bar-last-news">
            {{helper.widget('Publication').sidebarNews()}}
        </div>
    </aside>
</main>

<!-- site content end -->
{% endif %}
