{
  "id": "<?=md5($pwa_name)?>",
  "name": "<?=$pwa_name?>",
  "short_name": "<?=$pwa_short_name?>",
  "description": "<?=$pwa_description?>",
  "start_url": "/pwa/dashboard",
  "scope": "<?=$pwa_scope?>",
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
    "elearning"
  ],

  "related_applications": [{
      "platform": "webapp",
      "url": "<?=site_url('manifest.json')?>"
    }
  ],
  "background_color": "<?=$pwa_background_color?>",
  "theme_color": "<?=$pwa_theme_color?>",
  "lang": "<?=$pwa_lang?>",
  "icons": [
    {
      "src": "<?=$pwa_icon_192_maskable?>",
      "sizes": "192x192",
      "type": "image/png",
      "purpose": "any"
    },
    {
      "src": "<?=$pwa_icon_192_maskable?>",
      "sizes": "192x192",
      "type": "image/png",
      "purpose": "maskable"
    },
    {
      "src": "<?=$pwa_icon_512_maskable?>",
      "sizes": "512x512",
      "type": "image/png",
      "purpose": "any"
    },
    {
      "src": "<?=$pwa_icon_512_maskable?>",
      "sizes": "512x512",
      "type": "image/png",
      "purpose": "maskable"
    }
  ],

  "handle_links": "auto",
  "launch_handler": {
    "client_mode": ["navigate-existing", "auto"]
  },

  "url_handlers": [
    {
      "origin": "<?=site_url('*')?>"
    }
  ]  
}
