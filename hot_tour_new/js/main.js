'use strict'

const URL = 'http://vadzim.ddns.net:89/hot_tour_new/';

import {OwlAnimate} from './classes/owl_animate.js';
import {ApplyAos} from './classes/apply_aos.js';
import {BackToTop} from './classes/back_to_top.js';
import {LandNav} from './classes/custom_nav.js';
import {AnimateNav} from './classes/custom_nav.js';
import {NavbarCollapse} from './classes/navbar_collapse.js';
import {Preloader} from './classes/preloader.js';


new OwlAnimate({
  'container':'.header-carousel',
  'animate': {
    'nth-1':{
      'items': ['.header-form','.desc-col'],
      'animateCss': ['fadeInLeft','fadeInRight']
    }
  },
  'item':'.item',
  'owlSet':{
    'nav':true,
    'items':1,
    'loop':true,
    'dots':true
  }
});

$(document).ready(function(){
  $(".blog-carousel").owlCarousel({
    'nav':true,
    'loop':true,
    'dots':false,
    'responsive':{
      0: {
        'margin':10,
        'stagePadding': 10,
        'items':1
      },
      576: {
        'margin':10,
        'stagePadding': 10,
        'items':2
      },
      768: {
        'margin':10,
        'stagePadding': 10,
        'items':3
      },
      992: {
        'margin':50,
        'stagePadding': 50,
        'items':3
      },
      1200: {
        'margin':50,
        'stagePadding': 50,
        'items':3
      },
      1800: {
        'margin':50,
        'stagePadding': 50,
        'items':4
      }
    }
  });
});

$(document).ready(function(){
  $(".testimonials-carousel").owlCarousel({
    'nav':false,
    'loop':true,
    'dots':false,
    'responsive':{
      0: {
        'margin':10,
        'stagePadding': 10,
        'items':1
      },
      576: {
        'margin':10,
        'stagePadding': 10,
        'items':2
      },
      768: {
        'margin':10,
        'stagePadding': 10,
        'items':3
      },
      992: {
        'margin':50,
        'stagePadding': 50,
        'items':3
      },
      1200: {
        'margin':50,
        'stagePadding': 50,
        'items':3
      },
      1800: {
        'margin':50,
        'stagePadding': 50,
        'items':4
      }
    }
  });
});


new ApplyAos({
  'items':[
    '.section-title',
    '.section-sub-title',
    '.section-div',
    '.blog-item',
    '.box-item',
    '.item-testimony'
  ],
  'animate':[
    'fade-in',
    'fade-in',
    'fade-right',
    'fade-up',
    'fade-up',
    'fade-up'
  ],
  'globalSet':{
    'duration': 1000
  }
});


new NavbarCollapse({
  'container':'.nav-menu-wrap',
  'menu':'#topMenu',
  'openBtn':'.drop-down-btn',
  'closeBtn':'.close-btn',
  'collapseClass':'nav-collapse',
  'navBtn':'.nav-menu',
  'animateNav':'fadeInRight',
  'breakPoint': 700,
  'transition': .3,
  'menuDisplay':'flex',
  'openBtnDisplay':'flex'
});

new BackToTop({
  'style':'blue'
});

new LandNav({
  'nav':'#navBar',
  'links':'.navigate',
  'offset':50
});

new AnimateNav({
  'nav':'#navBar',
  'offset': 300
});
