(function() {

    tinymce.PluginManager.add('faurteshortcodes', function( editor )
    {
		
		editor.addMenuItem('shortcode_downloads', {
			text: 'Downloads einfügen',
			context: 'tools',
			onclick: function() {
				editor.insertContent('[downloads category=""]');
			}
		});
		
		editor.addMenuItem('shortcode_organigram', {
			text: 'Organigramm einfügen',
			context: 'tools',
			onclick: function() {
				editor.insertContent('[organigram menu=""]');
			}
		});
		
		editor.addMenuItem('shortcode_assistant', {
			text: 'Assistenten einfügen',
			context: 'tools',
			onclick: function() {
				editor.insertContent('[assistant id=""]');
			}
		});
		
		editor.addMenuItem('shortcode_accordion', {
			text: 'Accordion einfügen',
			context: 'tools',
			onclick: function() {
				editor.insertContent('[collapsibles]<br>[collapse title="Name" color=""]<br>Hier der Text<br>[/collapse]<br>[collapse title="Name" color=""]<br>Hier der Text<br>[/collapse]<br>[/collapsibles]');
			}
		});
                
                editor.addMenuItem('shortcode_univis', {
                        text: 'UnivIS einfügen',
                        context: 'tools',
                        onclick: function() {
                                editor.insertContent('[univis number=""]');
                        }
                });
                
                editor.addMenuItem('shortcode_karte', {
                        text: 'Lageplan (FAU-Karte) einfügen',
                        context: 'tools',
                        onclick: function() {
                                editor.insertContent('[faukarte url="" width="100%"]');
                        }
                });

    });
})();