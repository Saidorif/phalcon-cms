{% if entries %}
  
  {% for item in entries %}     
    <div class="col-md-12">               
      <img src="/{{ item.p.foto }}" alt="{{item.title}}">  
      <div class="bg">
        <h1>{{ item.title }}</h1>
        <h2>{{ item.job }}</h2>
        <h2>{{ item.p.phone }}</h2>
        <h2>{{ item.p.email }}</h2>
        <p>{{ item.text }}</p>
      </div>
    </div>
  {% endfor %}   
 
{% endif %}