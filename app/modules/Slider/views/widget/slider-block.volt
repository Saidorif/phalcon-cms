{% if entries %}
  <div class="slideshow section">    
    {% for item in entries %}     
      <div class="slide">               
        <img src="/{{ item.getBanner() }}" alt="{{item.getTitle()}}">  
        <div class="bg animated fadeInTop">
          {% if(item.getViewTitle() == 1) %} <h1>{{ item.getTitle() }} {% endif %}</h1>
          <div class="text">{{ item.getText() }}</div>
        </div>
      </div>
    {% endfor %}   
  </div>   
  <script type="text/javascript" src="/assets/js/slider.js"></script>
  <script type="text/javascript">
    jQuery(document).ready(function($) { 
      var slider = $(".slideshow").bxSlider({
        auto: true,
        startSlide: 0,
        mode: 'fade',
        pager: false,
        onSlideAfter: function (currentSlideNumber, totalSlideQty, currentSlideHtmlObject) {   
          $('.slideshow .slide .bg').removeClass('animated fadeInTop');
          $('.slideshow .slide').eq(currentSlideHtmlObject).find('.bg').addClass('animated fadeInTop');
        },
        onSliderLoad: function () {
          $('.slideshow > .slide').eq(1).find('.bg').addClass('animated fadeInTop');                       
        },
      });
    });
  </script>
{% endif %}