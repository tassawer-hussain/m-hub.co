<?php
   add_filter('elementor/icons_manager/additional_tabs', 'fioxen_custom_icons_filters' , 9999999, 1);
   function fioxen_custom_icons_filters( $tabs = array() ) {
      $newicons = [
         "flaticon-government",
         "flaticon-game-controller",
         "flaticon-serving-dish",
         "flaticon-suitcase",
         "flaticon-dumbbell",
         "flaticon-gift-box",
         "flaticon-chef",
         "flaticon-shopping",
         "flaticon-place",
         "flaticon-find",
         "flaticon-social-care",
         "flaticon-email",
         "flaticon-color-palette",
         "flaticon-museum",
         "flaticon-balloons",
         "flaticon-gamepad",
         "flaticon-add-user",
         "flaticon-laptop",
         "flaticon-headphone",
         "flaticon-email-1",
         "flaticon-play-button",
         "flaticon-map",
         "flaticon-star",
         "flaticon-calendar",
         "flaticon-star-1",
         "flaticon-right-arrow",
         "flaticon-avatar"
      ];

      $icons['gva_custom_icon'] = array(
         'name'          => 'fioxen-icons-theme',
         'label'         => esc_html__( 'Icons Theme', 'fioxen-themer' ),
         'labelIcon'     => 'fas fa-user',
         'prefix'        => '',
         'displayPrefix' => '',
         'icons'         => $newicons,
         'url'          => GAVIAS_FIOXEN_PLUGIN_URL . 'elementor/assets/libs/icons/style.css',
         'ver'           => '1.0'
      );
      return array_merge( $tabs, $icons );
   }

   add_action( 'wp_print_footer_scripts', 'fioxen_insert_icons_footer_css'  );
   function fioxen_insert_icons_footer_css() {
      echo '<link rel="stylesheet" type="text/css" href="' . GAVIAS_FIOXEN_PLUGIN_URL . 'elementor/assets/libs/icons/style.css">';
   }

   add_filter( 'elementor/icons_manager/additional_tabs', 'fioxen_ti_icon' );  
   function fioxen_ti_icon( $icons = array() ) {
       $ti_icons = array(
         'ti-wand',
         'ti-volume',
         'ti-user',
         'ti-unlock',
         'ti-unlink',
         'ti-trash',
         'ti-thought',
         'ti-target',
         'ti-tag',
         'ti-tablet',
         'ti-star',
         'ti-spray',
         'ti-signal',
         'ti-shopping-cart',
         'ti-shopping-cart-full',
         'ti-settings',
         'ti-search',
         'ti-zoom-in',
         'ti-zoom-out',
         'ti-cut',
         'ti-ruler',
         'ti-ruler-pencil',
         'ti-ruler-alt',
         'ti-bookmark',
         'ti-bookmark-alt',
         'ti-reload',
         'ti-plus',
         'ti-pin',
         'ti-pencil',
         'ti-pencil-alt',
         'ti-paint-roller',
         'ti-paint-bucket',
         'ti-na',
         'ti-mobile',
         'ti-minus',
         'ti-medall',
         'ti-medall-alt',
         'ti-marker',
         'ti-marker-alt',
         'ti-arrow-up',
         'ti-arrow-right',
         'ti-arrow-left',
         'ti-arrow-down',
         'ti-lock',
         'ti-location-arrow',
         'ti-link',
         'ti-layout',
         'ti-layers',
         'ti-layers-alt',
         'ti-key',
         'ti-import',
         'ti-image',
         'ti-heart',
         'ti-heart-broken',
         'ti-hand-stop',
         'ti-hand-open',
         'ti-hand-drag',
         'ti-folder',
         'ti-flag',
         'ti-flag-alt',
         'ti-flag-alt-2',
         'ti-eye',
         'ti-export',
         'ti-exchange-vertical',
         'ti-desktop',
         'ti-cup',
         'ti-crown',
         'ti-comments',
         'ti-comment',
         'ti-comment-alt',
         'ti-close',
         'ti-clip',
         'ti-angle-up',
         'ti-angle-right',
         'ti-angle-left',
         'ti-angle-down',
         'ti-check',
         'ti-check-box',
         'ti-camera',
         'ti-announcement',
         'ti-brush',
         'ti-briefcase',
         'ti-bolt',
         'ti-bolt-alt',
         'ti-blackboard',
         'ti-bag',
         'ti-move',
         'ti-arrows-vertical',
         'ti-arrows-horizontal',
         'ti-fullscreen',
         'ti-arrow-top-right',
         'ti-arrow-top-left',
         'ti-arrow-circle-up',
         'ti-arrow-circle-right',
         'ti-arrow-circle-left',
         'ti-arrow-circle-down',
         'ti-angle-double-up',
         'ti-angle-double-right',
         'ti-angle-double-left',
         'ti-angle-double-down',
         'ti-zip',
         'ti-world',
         'ti-wheelchair',
         'ti-view-list',
         'ti-view-list-alt',
         'ti-view-grid',
         'ti-uppercase',
         'ti-upload',
         'ti-underline',
         'ti-truck',
         'ti-timer',
         'ti-ticket',
         'ti-thumb-up',
         'ti-thumb-down',
         'ti-text',
         'ti-stats-up',
         'ti-stats-down',
         'ti-split-v',
         'ti-split-h',
         'ti-smallcap',
         'ti-shine',
         'ti-shift-right',
         'ti-shift-left',
         'ti-shield',
         'ti-notepad',
         'ti-server',
         'ti-quote-right',
         'ti-quote-left',
         'ti-pulse',
         'ti-printer',
         'ti-power-off',
         'ti-plug',
         'ti-pie-chart',
         'ti-paragraph',
         'ti-panel',
         'ti-package',
         'ti-music',
         'ti-music-alt',
         'ti-mouse',
         'ti-mouse-alt',
         'ti-money',
         'ti-microphone',
         'ti-menu',
         'ti-menu-alt',
         'ti-map',
         'ti-map-alt',
         'ti-loop',
         'ti-location-pin',
         'ti-list',
         'ti-light-bulb',
         'ti-Italic',
         'ti-info',
         'ti-infinite',
         'ti-id-badge',
         'ti-hummer',
         'ti-home',
         'ti-help',
         'ti-headphone',
         'ti-harddrives',
         'ti-harddrive',
         'ti-gift',
         'ti-game',
         'ti-filter',
         'ti-files',
         'ti-file',
         'ti-eraser',
         'ti-envelope',
         'ti-download',
         'ti-direction',
         'ti-direction-alt',
         'ti-dashboard',
         'ti-control-stop',
         'ti-control-shuffle',
         'ti-control-play',
         'ti-control-pause',
         'ti-control-forward',
         'ti-control-backward',
         'ti-cloud',
         'ti-cloud-up',
         'ti-cloud-down',
         'ti-clipboard',
         'ti-car',
         'ti-calendar',
         'ti-book',
         'ti-bell',
         'ti-basketball',
         'ti-bar-chart',
         'ti-bar-chart-alt',
         'ti-back-right',
         'ti-back-left',
         'ti-arrows-corner',
         'ti-archive',
         'ti-anchor',
         'ti-align-right',
         'ti-align-left',
         'ti-align-justify',
         'ti-align-center',
         'ti-alert',
         'ti-alarm-clock',
         'ti-agenda',
         'ti-write',
         'ti-window',
         'ti-widgetized',
         'ti-widget',
         'ti-widget-alt',
         'ti-wallet',
         'ti-video-clapper',
         'ti-video-camera',
         'ti-vector',
         'ti-themify-logo',
         'ti-themify-favicon',
         'ti-themify-favicon-alt',
         'ti-support',
         'ti-stamp',
         'ti-split-v-alt',
         'ti-slice',
         'ti-shortcode',
         'ti-shift-right-alt',
         'ti-shift-left-alt',
         'ti-ruler-alt-2',
         'ti-receipt',
         'ti-pin2',
         'ti-pin-alt',
         'ti-pencil-alt2',
         'ti-palette',
         'ti-more',
         'ti-more-alt',
         'ti-microphone-alt',
         'ti-magnet',
         'ti-line-double',
         'ti-line-dotted',
         'ti-line-dashed',
         'ti-layout-width-full',
         'ti-layout-width-default',
         'ti-layout-width-default-alt',
         'ti-layout-tab',
         'ti-layout-tab-window',
         'ti-layout-tab-v',
         'ti-layout-tab-min',
         'ti-layout-slider',
         'ti-layout-slider-alt',
         'ti-layout-sidebar-right',
         'ti-layout-sidebar-none',
         'ti-layout-sidebar-left',
         'ti-layout-placeholder',
         'ti-layout-menu',
         'ti-layout-menu-v',
         'ti-layout-menu-separated',
         'ti-layout-menu-full',
         'ti-layout-media-right-alt',
         'ti-layout-media-right',
         'ti-layout-media-overlay',
         'ti-layout-media-overlay-alt',
         'ti-layout-media-overlay-alt-2',
         'ti-layout-media-left-alt',
         'ti-layout-media-left',
         'ti-layout-media-center-alt',
         'ti-layout-media-center',
         'ti-layout-list-thumb',
         'ti-layout-list-thumb-alt',
         'ti-layout-list-post',
         'ti-layout-list-large-image',
         'ti-layout-line-solid',
         'ti-layout-grid4',
         'ti-layout-grid3',
         'ti-layout-grid2',
         'ti-layout-grid2-thumb',
         'ti-layout-cta-right',
         'ti-layout-cta-left',
         'ti-layout-cta-center',
         'ti-layout-cta-btn-right',
         'ti-layout-cta-btn-left',
         'ti-layout-column4',
         'ti-layout-column3',
         'ti-layout-column2',
         'ti-layout-accordion-separated',
         'ti-layout-accordion-merged',
         'ti-layout-accordion-list',
         'ti-ink-pen',
         'ti-info-alt',
         'ti-help-alt',
         'ti-headphone-alt',
         'ti-hand-point-up',
         'ti-hand-point-right',
         'ti-hand-point-left',
         'ti-hand-point-down',
         'ti-gallery',
         'ti-face-smile',
         'ti-face-sad',
         'ti-credit-card',
         'ti-control-skip-forward',
         'ti-control-skip-backward',
         'ti-control-record',
         'ti-control-eject',
         'ti-comments-smiley',
         'ti-brush-alt',
         'ti-youtube',
         'ti-vimeo',
         'ti-twitter',
         'ti-time',
         'ti-tumblr',
         'ti-skype',
         'ti-share',
         'ti-share-alt',
         'ti-rocket',
         'ti-pinterest',
         'ti-new-window',
         'ti-microsoft',
         'ti-list-ol',
         'ti-linkedin',
         'ti-layout-sidebar-2',
         'ti-layout-grid4-alt',
         'ti-layout-grid3-alt',
         'ti-layout-grid2-alt',
         'ti-layout-column4-alt',
         'ti-layout-column3-alt',
         'ti-layout-column2-alt',
         'ti-instagram',
         'ti-google',
         'ti-github',
         'ti-flickr',
         'ti-facebook',
         'ti-dropbox',
         'ti-dribbble',
         'ti-apple',
         'ti-android',
         'ti-save',
         'ti-save-alt',
         'ti-yahoo',
         'ti-wordpress',
         'ti-vimeo-alt',
         'ti-twitter-alt',
         'ti-tumblr-alt',
         'ti-trello',
         'ti-stack-overflow',
         'ti-soundcloud',
         'ti-sharethis',
         'ti-sharethis-alt',
         'ti-reddit',
         'ti-pinterest-alt',
         'ti-microsoft-alt',
         'ti-linux',
         'ti-jsfiddle',
         'ti-joomla',
         'ti-html5',
         'ti-flickr-alt',
         'ti-email',
         'ti-drupal',
         'ti-dropbox-alt',
         'ti-css3',
         'ti-rss',
         'ti-rss-alt'
      
       );
       
       $icons['fioxen-ti-icons'] = array(
           'name'          => 'fioxen-icons-ti',
           'label'         => esc_html__( 'TI Icons', 'fioxen-themer' ),
           'labelIcon'     => 'fas fa-user',
           'prefix'        => '',
           'displayPrefix' => '',
           'icons'         => $ti_icons,
            'url'          => GAVIAS_FIOXEN_PLUGIN_URL . 'elementor/assets/libs/ti-icons/icons.css',
           'ver'           => '1.0',
       );

       return $icons;
   }