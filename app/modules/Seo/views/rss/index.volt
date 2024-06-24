{{ '<?xml version="1.0" encoding="UTF-8"?>' }}
<rss version="2.0">
	<channel>
		<atom:link xmlns:atom="http://www.w3.org/2005/Atom" href="{{rss_link}}" rel="self" type="application/rss+xml"/>
		<title>{{site_name}}</title>
		<link>{{site_link}}</link>
		<description>{{site_name}}</description>
		{% for news in newsfeed %}
			
			<item>
				<title>{{ news['title'] }}</title>
				<description>{{ news['description'] }}</description>
				<link>{{ news['link'] }}</link>
				<pubDate>{{ news['pubDate'] }}</pubDate>
			</item>
		{% endfor %}
	</channel>
</rss>
