{
  "id": "<?=md5($brand_name)?>",
  "name": "<?=$brand_name?>",
  "short_name": "<?=$brand_name?>",
  "description": "اپلیکیشن <?=$brand_name?>",
  "start_url": "/pwa/dashboard",
  "scope": "/",
  "display": "standalone",
  "display_override": ["tabbed", "standalone", "fullscreen"],
  "tab_strip": {
    "new_tab_button": {
      "url": "/"
    }
  },
  "orientation": "portrait",
  "categories": [
    "education",
    "eleaning"
  ],
  "related_applications": [{
      "platform": "webapp",
      "url": "<?=site_url('manifest.json')?>"
    }
  ],
  "background_color": "#ffffff",
  "theme_color": "<?=$theme_color?>",
  "lang": "fa-IR",
  "icons": [
    {
      "src": "https://up.7learn.com/1/mdm/madam-192-maskable.png",
      "sizes": "192x192",
      "type": "<?=$mime_type?>"
    },
    {
      "src": "https://up.7learn.com/1/mdm/madam-512-maskable.png",
      "sizes": "512x512",
      "type": "<?=$mime_type?>"
    }
  ],

  "handle_links": "auto",
  "launch_handler": {
    "client_mode": ["navigate-existing", "auto"]
  },

  "url_handlers": [
    {
      "origin": "<?=site_url('/*')?>"
    }
  ]  
}
