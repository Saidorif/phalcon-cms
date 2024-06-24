{{ partial('main/menu') }}

<header>
  <div class="container">
    <div class="row">
      <div class="col-12">            
        <div class="header" >
          <div class="cover"></div>
          <div class="row">
            <nav class="navbar navbar-expand-lg topNav desktopNav">
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#topNavbar" aria-controls="topNavbar" aria-expanded="false">
                <span class="navbar-toggler-icon"><i class="fa fa-bars" aria-hidden="true"></i></span>
              </button>
              <div class="collapse navbar-collapse" id="topNavbar">
                {{ helper.widget('Menu').mainMenu() }}
              </div>
            </nav>
            <div class="col-md-6 col-12">
              <div class="logo">
                <a href="/" title="">
                  <img class="img-fluid" src="/{{ helper.logo() }}" alt="" />
                </a>
              </div>
            </div>                  
            <div class="clearfix"></div>  
          </div>            
        </div><!--/header-->            
      </div>                    
    </div>
  </div>
</header>
<section class="section">
  <div class="container">
  <div class="main-content">
    <div class="subcribe-for pad">
      <h4 class="magazine-title">{{helper.translate('Magazine Tadbirkor Ayol')}}</h4>
      {{helper.blockID('subscribe-magazine')}}
    </div>
    <div class="dflex" style="overflow:hidden;padding:50px 50px 100px;">
    <h1 class="title-center">Анкета подписки на журнал «Тадбиркор аёл»</h1>
    <form action="/payment/magorder" class="payme-member" method="post" enctype="multipart/form-data" id="magazineForm">
      <div class="col-md-6">
        <div class="input-group">
          <label class="input-label">ФИО<span class="text-red">*</span></label>
          <input class="input-red" type="text" name="fio" id="" required="required">
        </div>
        <div class="input-group">
          <label class="input-label">{{ helper.translate('Subtime') }}<span class="text-red">*</span></label>
          <select name="subtime" id="subtime" class="input-red">
            <option value="1">1 {{helper.translate('Month')}}</option>
            <option value="2">2 {{helper.translate('Month')}}</option>
            <option value="3">3 {{helper.translate('Month')}}</option>
            <option value="4">4 {{helper.translate('Month')}}</option>
            <option value="5">5 {{helper.translate('Month')}}</option>
            <option value="6">6 {{helper.translate('Month')}}</option>
            <option value="7">7 {{helper.translate('Month')}}</option>
            <option value="8">8 {{helper.translate('Month')}}</option>
            <option value="9">9 {{helper.translate('Month')}}</option>
            <option value="10">10 {{helper.translate('Month')}}</option>
            <option value="11">11 {{helper.translate('Month')}}</option>
            <option value="12">12 {{helper.translate('Month')}}</option>
          </select>
        </div>
      </div>
      <div class="col-md-6">
        <div class="input-group">
          <label class="input-label">{{helper.translate('Address reciver')}} <span class="text-red">*</span></label>
          <input class="input-red" type="text" name="address" id="" required="required">
        </div>
        <div class="input-group">
          <label class="input-label">{{helper.translate('Phone')}}<span class="text-red">*</span></label>
          <input class="input-red" type="number" name="phone" id="" required="required">
        </div>
      </div>
      <div class="col-md-6" style="margin-top:20px;">
        <div class="input-group">
          <button type="submit" class="btn-orange">{{helper.translate('Get order')}}</button>
        </div>
      </div>
      <div class="col-md-6">
        <div class="input-group">
          <label class="input-label">{{helper.translate('Summa')}}</label>
          {% if priceformonth %}
          <input type="hidden" name="priceformonth" id="priceformonth" value="{{priceformonth}}">
          {% endif %}
          <input type="hidden" name="summa" id="summa" value="{{priceformonth}}" >
          <span class="input-red" id="price">{{priceformonth}}</span>
        </div>        
      </div>
    </form><!-- /. magazineForm -->
    </div>
  </div>
  </div>
</section>
<script>
  var priceformonth = $('#priceformonth').val();
  var subtime = $('#subtime');
  var summa = $('#summa');
  var price = $('#price');

  subtime.on('change', function(){
    var sum = Number($(this).val() * priceformonth).toLocaleString('de-DE');
    price.text(sum);
    summa.val($(this).val() * priceformonth);
  });
</script>