
jQuery(function($){$(function(){$('.fl-node-5c6efe24bc78b .fl-photo-img').on('mouseenter',function(e){$(this).data('title',$(this).attr('title')).removeAttr('title');}).on('mouseleave',function(e){$(this).attr('title',$(this).data('title')).data('title',null);});});window._fl_string_to_slug_regex='a-zA-Z0-9';});(function($){$('.fl-node-493q8cbg0zr2 .fl-slider-next').empty();$('.fl-node-493q8cbg0zr2 .fl-slider-prev').empty();var testimonials=$('.fl-node-493q8cbg0zr2 .fl-testimonials').bxSlider({autoStart:0,auto:true,adaptiveHeight:true,pause:6000,mode:'fade',autoDirection:'next',speed:500,pager:1,nextSelector:'.fl-node-493q8cbg0zr2 .fl-slider-next',prevSelector:'.fl-node-493q8cbg0zr2 .fl-slider-prev',nextText:'<i class="fas fa-chevron-circle-right"></i>',prevText:'<i class="fas fa-chevron-circle-left"></i>',controls:0,onSliderLoad:function(currentIndex){$('.fl-node-493q8cbg0zr2 .fl-testimonials').addClass('fl-testimonials-loaded');$('.fl-node-493q8cbg0zr2 .fl-slider-next a').attr('aria-label','Next testimonial.');$('.fl-node-493q8cbg0zr2 .fl-slider-prev a').attr('aria-label','Previous testimonial.');},onSliderResize:function(currentIndex){this.working=false;this.reloadSlider();},onSlideBefore:function(ele,oldIndex,newIndex){$('.fl-node-493q8cbg0zr2 .fl-slider-next a').addClass('disabled');$('.fl-node-493q8cbg0zr2 .fl-slider-prev a').addClass('disabled');$('.fl-node-493q8cbg0zr2 .bx-controls .bx-pager-link').addClass('disabled');},onSlideAfter:function(ele,oldIndex,newIndex){$('.fl-node-493q8cbg0zr2 .fl-slider-next a').removeClass('disabled');$('.fl-node-493q8cbg0zr2 .fl-slider-prev a').removeClass('disabled');$('.fl-node-493q8cbg0zr2 .bx-controls .bx-pager-link').removeClass('disabled');},onSlideNext:function(ele,oldIndex,newIndex){$('.fl-node-493q8cbg0zr2 .fl-slider-next').attr('aria-pressed','true');$('.fl-node-493q8cbg0zr2 .fl-slider-prev').attr('aria-pressed','false');},onSlidePrev:function(ele,oldIndex,newIndex){$('.fl-node-493q8cbg0zr2 .fl-slider-next').attr('aria-pressed','false');$('.fl-node-493q8cbg0zr2 .fl-slider-prev').attr('aria-pressed','true');}});if('undefined'!==typeof(FLBuilder)){var reloadTestimonials=function(){setTimeout(function(){testimonials.reloadSlider();},50);}
FLBuilder.addHook('responsive-editing-switched',reloadTestimonials);FLBuilder.addHook('col-resize-drag',reloadTestimonials);FLBuilder.addHook('col-deleted',reloadTestimonials);}})(jQuery);(function($){$('.fl-node-xmwrlob9ud2k .fl-slider-next').empty();$('.fl-node-xmwrlob9ud2k .fl-slider-prev').empty();var testimonials=$('.fl-node-xmwrlob9ud2k .fl-testimonials').bxSlider({autoStart:0,auto:true,adaptiveHeight:true,pause:6000,mode:'fade',autoDirection:'next',speed:1000,pager:1,nextSelector:'.fl-node-xmwrlob9ud2k .fl-slider-next',prevSelector:'.fl-node-xmwrlob9ud2k .fl-slider-prev',nextText:'<i class="fas fa-chevron-circle-right"></i>',prevText:'<i class="fas fa-chevron-circle-left"></i>',controls:0,onSliderLoad:function(currentIndex){$('.fl-node-xmwrlob9ud2k .fl-testimonials').addClass('fl-testimonials-loaded');$('.fl-node-xmwrlob9ud2k .fl-slider-next a').attr('aria-label','Next testimonial.');$('.fl-node-xmwrlob9ud2k .fl-slider-prev a').attr('aria-label','Previous testimonial.');},onSliderResize:function(currentIndex){this.working=false;this.reloadSlider();},onSlideBefore:function(ele,oldIndex,newIndex){$('.fl-node-xmwrlob9ud2k .fl-slider-next a').addClass('disabled');$('.fl-node-xmwrlob9ud2k .fl-slider-prev a').addClass('disabled');$('.fl-node-xmwrlob9ud2k .bx-controls .bx-pager-link').addClass('disabled');},onSlideAfter:function(ele,oldIndex,newIndex){$('.fl-node-xmwrlob9ud2k .fl-slider-next a').removeClass('disabled');$('.fl-node-xmwrlob9ud2k .fl-slider-prev a').removeClass('disabled');$('.fl-node-xmwrlob9ud2k .bx-controls .bx-pager-link').removeClass('disabled');},onSlideNext:function(ele,oldIndex,newIndex){$('.fl-node-xmwrlob9ud2k .fl-slider-next').attr('aria-pressed','true');$('.fl-node-xmwrlob9ud2k .fl-slider-prev').attr('aria-pressed','false');},onSlidePrev:function(ele,oldIndex,newIndex){$('.fl-node-xmwrlob9ud2k .fl-slider-next').attr('aria-pressed','false');$('.fl-node-xmwrlob9ud2k .fl-slider-prev').attr('aria-pressed','true');}});if('undefined'!==typeof(FLBuilder)){var reloadTestimonials=function(){setTimeout(function(){testimonials.reloadSlider();},50);}
FLBuilder.addHook('responsive-editing-switched',reloadTestimonials);FLBuilder.addHook('col-resize-drag',reloadTestimonials);FLBuilder.addHook('col-deleted',reloadTestimonials);}})(jQuery);jQuery(function($){$(function(){$('.fl-node-l50w3eihobrf .fl-photo-img').on('mouseenter',function(e){$(this).data('title',$(this).attr('title')).removeAttr('title');}).on('mouseleave',function(e){$(this).attr('title',$(this).data('title')).data('title',null);});});window._fl_string_to_slug_regex='a-zA-Z0-9';});jQuery(function($){$(function(){$('.fl-node-pzja78f26ryh .fl-photo-img').on('mouseenter',function(e){$(this).data('title',$(this).attr('title')).removeAttr('title');}).on('mouseleave',function(e){$(this).attr('title',$(this).data('title')).data('title',null);});});window._fl_string_to_slug_regex='a-zA-Z0-9';});(function($){FLBuilderAccordion=function(settings)
{this.settings=settings;this.nodeClass='.fl-node-'+settings.id;this._init();};FLBuilderAccordion.prototype={settings:{},nodeClass:'',_init:function()
{$(this.nodeClass+' .fl-accordion-button').on('click',$.proxy(this._buttonClick,this));$(this.nodeClass+' .fl-accordion-button').on('keypress',$.proxy(this._buttonClick,this));$(this.nodeClass+' .fl-accordion-button').on('focus',$.proxy(this._focusIn,this));$(this.nodeClass+' .fl-accordion-button').on('focusout',$.proxy(this._focusOut,this));FLBuilderLayout.preloadAudio(this.nodeClass+' .fl-accordion-content');this._openActiveAccordion();},_openActiveAccordion:function(e){var activeAccordion=$(this.nodeClass+' .fl-accordion-item.fl-accordion-item-active');if(activeAccordion.length>0){activeAccordion.find('.fl-accordion-content').show();}},_buttonClick:function(e)
{var button=$(e.target).closest('.fl-accordion-button'),accordion=button.closest('.fl-accordion'),item=button.closest('.fl-accordion-item'),allContent=accordion.find('.fl-accordion-content'),allIcons=accordion.find('.fl-accordion-button i.fl-accordion-button-icon'),content=button.siblings('.fl-accordion-content'),icon=button.find('i.fl-accordion-button-icon');if(!this._validClick(e)){return;}
e.preventDefault();if(accordion.hasClass('fl-accordion-collapse')){accordion.find('.fl-accordion-item-active').removeClass('fl-accordion-item-active');accordion.find('.fl-accordion-button').attr('aria-expanded','false');accordion.find('.fl-accordion-content').attr('aria-hidden','true');allContent.slideUp('normal');if(allIcons.find('svg').length>0){allIcons.find('svg').attr("data-icon",'plus');}else{allIcons.removeClass(this.settings.activeIcon);allIcons.addClass(this.settings.labelIcon);}}
if(content.is(':hidden')){button.attr('aria-expanded','true');item.addClass('fl-accordion-item-active');item.find('.fl-accordion-content').attr('aria-hidden','false');content.slideDown('normal',this._slideDownComplete);if(icon.find('svg').length>0){icon.find('svg').attr("data-icon",'minus');}else{icon.removeClass(this.settings.labelIcon);icon.addClass(this.settings.activeIcon);}
icon.find('span').text('Collapse');}
else{button.attr('aria-expanded','false');item.removeClass('fl-accordion-item-active');item.find('.fl-accordion-content').attr('aria-hidden','true');content.slideUp('normal',this._slideUpComplete);if(icon.find('svg').length>0){icon.find('svg').attr("data-icon",'plus');}else{icon.removeClass(this.settings.activeIcon);icon.addClass(this.settings.labelIcon);}
icon.find('span').text('Expand');}},_focusIn:function(e)
{var button=$(e.target).closest('.fl-accordion-button');button.attr('aria-selected','true');},_focusOut:function(e)
{var button=$(e.target).closest('.fl-accordion-button');button.attr('aria-selected','false');},_slideUpComplete:function()
{var content=$(this),accordion=content.closest('.fl-accordion');accordion.trigger('fl-builder.fl-accordion-toggle-complete');},_slideDownComplete:function()
{var content=$(this),accordion=content.closest('.fl-accordion'),item=content.parent(),win=$(window);FLBuilderLayout.refreshGalleries(content);FLBuilderLayout.refreshGridLayout(content);FLBuilderLayout.reloadSlider(content);FLBuilderLayout.resizeAudio(content);FLBuilderLayout.reloadGoogleMap(content);FLBuilderLayout.resizeSlideshow();if(item.offset().top<win.scrollTop()+100){$('html, body').animate({scrollTop:item.offset().top-100},500,'swing');}
accordion.trigger('fl-builder.fl-accordion-toggle-complete');},_validClick:function(e)
{return(e.which==1||e.which==13||e.which==32||e.which==undefined)?true:false;}};})(jQuery);(function($){$(function(){new FLBuilderAccordion({id:'d6x1irz3mwjs',defaultItem:false,labelIcon:'fas fa-plus',activeIcon:'fas fa-minus',});});})(jQuery);jQuery(function($){$(function(){$('.fl-node-om1bvf946swc .fl-photo-img').on('mouseenter',function(e){$(this).data('title',$(this).attr('title')).removeAttr('title');}).on('mouseleave',function(e){$(this).attr('title',$(this).data('title')).data('title',null);});});window._fl_string_to_slug_regex='a-zA-Z0-9';});(function($){$(function(){new FLBuilderAccordion({id:'lfv9iuwdpgs0',defaultItem:false,labelIcon:'fas fa-plus',activeIcon:'fas fa-minus',});});})(jQuery);jQuery(function($){$(function(){$('.fl-node-zsm1kx23jboq .fl-photo-img').on('mouseenter',function(e){$(this).data('title',$(this).attr('title')).removeAttr('title');}).on('mouseleave',function(e){$(this).attr('title',$(this).data('title')).data('title',null);});});window._fl_string_to_slug_regex='a-zA-Z0-9';});(function($){$(function(){$('.fl-embed-video').fitVids();if(($('.fl-module-video .fl-wp-video video').length>1)&&typeof $.fn.mediaelementplayer!=='undefined'){$('.fl-module-video .fl-wp-video video').mediaelementplayer({pauseOtherPlayers:false});}});FLBuilderVideo=function(settings){this.nodeID=settings.id;this.nodeClass='.fl-node-'+settings.id;this.wrapperClass=this.nodeClass+' .fl-video';this._initVideo();this._initStickyOnScroll();};FLBuilderVideo.prototype={_initVideo:function(){var origTop=$(this.nodeClass).offset().top,origLeft=$(this.nodeClass).offset().left,origHeight=$(this.nodeClass).outerHeight(),origWidth=$(this.nodeClass).outerWidth();$(this.nodeClass).attr('data-orig-top',origTop);$(this.nodeClass).attr('data-orig-left',origLeft);$(this.nodeClass).attr('data-orig-height',origHeight);$(this.nodeClass).attr('data-orig-width',origWidth);},_makeSticky:function(){var origLeft=$(this.nodeClass).data('orig-left'),origHeight=$(this.nodeClass).data('orig-height'),origWidth=$(this.nodeClass).data('orig-width');$(this.nodeClass).addClass('fl-video-sticky');$(this.nodeClass).css('left',origLeft);$(this.nodeClass).css('height',origHeight);$(this.nodeClass).css('width',origWidth);},_removeSticky:function(){$(this.nodeClass).removeClass('fl-video-sticky');},_initStickyOnScroll:function(){$(window).on('scroll',$.proxy(function(e){var win=$(window),winTop=win.scrollTop(),nodeTop=$(this.nodeClass).data('orig-top');isSticky=$(this.nodeClass).hasClass('fl-video-sticky');if(winTop>=nodeTop){if(!isSticky){this._makeSticky();}}else{this._removeSticky();}},this));},};})(jQuery);(function($){})(jQuery);(function($){FLBuilderPostSlider=function(settings){this.settings=settings.settings;this.nodeClass='.fl-node-'+settings.id;this.wrapperClass=this.nodeClass+' .fl-post-slider-wrapper';this.postClass=this.nodeClass+' .fl-post-slider-post';this.prevSliderBtn=$(this.nodeClass+' .slider-prev');this.nextSliderBtn=$(this.nodeClass+' .slider-next');this.navigation=settings.navigationControls;if(this._hasPosts()){this._initSlider();}};FLBuilderPostSlider.prototype={settings:{},nodeClass:'',wrapperClass:'',postClass:'',prevSliderBtn:'',nextSliderBtn:'',navigation:false,slider:'',_hasPosts:function(){return $(this.postClass).length>0;},_getSettings:function(){var settings={onSliderLoad:function(){$(this.wrapperClass).addClass('fl-post-slider-loaded');}.bind(this),}
return $.extend({},this.settings,settings);},_initSlider:function(){this.slider=$(this.wrapperClass).bxSlider(this._getSettings());$(this.wrapperClass).data('bxSlider',this.slider);if(this.navigation){this.prevSliderBtn.on('click',function(e){e.preventDefault();this.slider.goToPrevSlide();}.bind(this));this.nextSliderBtn.on('click',function(e){e.preventDefault();this.slider.goToNextSlide();}.bind(this));}},};})(jQuery);(function($){$(function(){new FLBuilderPostSlider({id:'w2um5cga0ips',settings:{mode:'horizontal',pager:false,auto:false,pause:5000,speed:1000,infiniteLoop:false,adaptiveHeight:true,controls:false,autoHover:true,onSlideBefore:function(ele,oldIndex,newIndex){$('.fl-node-w2um5cga0ips .fl-post-slider-navigation a').addClass('disabled');$('.fl-node-w2um5cga0ips .bx-controls .bx-pager-link').addClass('disabled');},onSlideAfter:function(ele,oldIndex,newIndex){$('.fl-node-w2um5cga0ips .fl-post-slider-navigation a').removeClass('disabled');$('.fl-node-w2um5cga0ips .bx-controls .bx-pager-link').removeClass('disabled');}}});});})(jQuery);(function($){$(function(){new FLBuilderPostGrid({id:'x49pn5mbgk1t',layout:'feed',pagination:'none',postSpacing:'60',postWidth:'300',matchHeight:{default:'0',large:'',medium:'',responsive:''},isRTL:false});});})(jQuery);(function($){$(function(){new FLBuilderPostGrid({id:'jd2pwiqoreh1',layout:'columns',pagination:'numbers',postSpacing:'50',postWidth:'300',matchHeight:{default:'1',large:'',medium:'',responsive:''},isRTL:false});});})(jQuery);jQuery(function($){$(function(){$('.fl-node-p8mnqio193l5 .fl-photo-img').on('mouseenter',function(e){$(this).data('title',$(this).attr('title')).removeAttr('title');}).on('mouseleave',function(e){$(this).attr('title',$(this).data('title')).data('title',null);});});window._fl_string_to_slug_regex='a-zA-Z0-9';});(function($){FLBuilderTabs=function(settings)
{this.settings=settings;this.nodeClass='.fl-node-'+settings.id;this.tabsOnMobile=settings.tabsOnMobile;this._init();};FLBuilderTabs.prototype={settings:{},nodeClass:'',_init:function()
{var win=$(window);$(this.nodeClass+' .fl-tabs-labels .fl-tabs-label').click($.proxy(this._labelClick,this));$(this.nodeClass+' .fl-tabs-labels .fl-tabs-label').on('keypress',$.proxy(this._labelClick,this));$(this.nodeClass+' .fl-tabs-panels .fl-tabs-label').click($.proxy(this._responsiveLabelClick,this));$(this.nodeClass+' .fl-tabs-panels .fl-tabs-label').on('keypress',$.proxy(this._responsiveLabelClick,this));win.on('resize',$.proxy(this._setupTabs,this));if($(this.nodeClass+' .fl-tabs-vertical').length>0){this._resize();win.off('resize'+this.nodeClass);win.on('resize'+this.nodeClass,$.proxy(this._resize,this));}
FLBuilderLayout.preloadAudio(this.nodeClass+' .fl-tabs-panel-content');this._setupTabs();},_labelClick:function(e)
{var label=$(e.target).closest('.fl-tabs-label'),index=label.data('index'),wrap=label.closest('.fl-tabs'),allIcons=wrap.find('.fl-tabs-panels .fl-tabs-label .fas'),icon=wrap.find('.fl-tabs-panels .fl-tabs-label[data-index="'+index+'"] .fas');if(!this._validClick(e)){return;}
allIcons.addClass('fa-plus');icon.removeClass('fa-plus');wrap.find('.fl-tabs-labels:first > .fl-tab-active').removeClass('fl-tab-active').attr('aria-selected','false').attr('aria-expanded','false');wrap.find('.fl-tabs-panels:first > .fl-tabs-panel > .fl-tab-active').removeClass('fl-tab-active');wrap.find('.fl-tabs-panels:first > .fl-tabs-panel > .fl-tabs-panel-content').attr('aria-hidden','true').css('display','');wrap.find('.fl-tabs-labels:first > .fl-tabs-label[data-index="'+index+'"]').addClass('fl-tab-active').attr('aria-selected','true').attr('aria-expanded','true');wrap.find('.fl-tabs-panels:first > .fl-tabs-panel > .fl-tabs-panel-label[data-index="'+index+'"]').addClass('fl-tab-active');wrap.find('.fl-tabs-panels:first > .fl-tabs-panel > .fl-tabs-panel-content[data-index="'+index+'"]').addClass('fl-tab-active').attr('aria-hidden','false');FLBuilderLayout.refreshGalleries(wrap.find('.fl-tabs-panel-content[data-index="'+index+'"]'));FLBuilderLayout.refreshGridLayout(wrap.find('.fl-tabs-panel-content[data-index="'+index+'"]'));FLBuilderLayout.reloadSlider(wrap.find('.fl-tabs-panel-content[data-index="'+index+'"]'));FLBuilderLayout.resizeAudio(wrap.find('.fl-tabs-panel-content[data-index="'+index+'"]'));FLBuilderLayout.resizeSlideshow();FLBuilderLayout.reloadGoogleMap(wrap.find('.fl-tabs-panel-content[data-index="'+index+'"]'));e.preventDefault();},_responsiveLabelClick:function(e)
{var label=$(e.target).closest('.fl-tabs-label'),wrap=label.closest('.fl-tabs'),index=label.data('index'),content=label.siblings('.fl-tabs-panel-content'),activeContent=wrap.find('.fl-tabs-panel-content.fl-tab-active'),activeIndex=activeContent.data('index'),allIcons=wrap.find('.fl-tabs-panels .fl-tabs-label > .fas'),icon=label.find('.fas');if(!this._validClick(e)){return;}
if(label.hasClass('fl-tab-active')||wrap.hasClass('fl-tabs-animation')){return;}
allIcons.addClass('fa-plus');icon.removeClass('fa-plus');wrap.addClass('fl-tabs-animation');activeContent.slideUp('normal');content.slideDown('normal',function(){wrap.find('.fl-tab-active').removeClass('fl-tab-active').attr('aria-hidden','true');wrap.find('.fl-tabs-panels:first > .fl-tabs-panel > .fl-tabs-panel-content').attr('aria-hidden','true');wrap.find('.fl-tabs-label[data-index="'+index+'"]').addClass('fl-tab-active').attr('aria-hidden','false');wrap.find('.fl-tabs-panels:first > .fl-tabs-panel > .fl-tabs-panel-content[data-index="'+index+'"]').attr('aria-hidden','false');content.addClass('fl-tab-active');wrap.removeClass('fl-tabs-animation');FLBuilderLayout.refreshGalleries(content);FLBuilderLayout.refreshGridLayout(content);FLBuilderLayout.reloadSlider(content);FLBuilderLayout.resizeAudio(content);FLBuilderLayout.reloadGoogleMap(wrap.find('.fl-tabs-panel-content[data-index="'+index+'"]'));if(label.offset().top<$(window).scrollTop()+100){$('html, body').animate({scrollTop:label.offset().top-100},500,'swing');}});},_resize:function()
{$(this.nodeClass+' .fl-tabs-vertical').each($.proxy(this._resizeVertical,this));},_resizeVertical:function(e)
{var wrap=$(this.nodeClass+' .fl-tabs-vertical'),labels=wrap.find('.fl-tabs-labels'),panels=wrap.find('.fl-tabs-panels');panels.css('min-height',labels.height()+'px');},_validClick:function(e)
{return(e.which==1||e.which==13||e.which==32)?true:false;},_setupTabs:function(){var winWidth=$(window).width(),activeTabContent=$(this.nodeClass+' .fl-tabs-panel-content.fl-tab-active'),activeTabPanel=activeTabContent.parent(),activeTabLabelIcon=activeTabPanel.find('i'),smallBreakPoint=FLBuilderLayoutConfig.breakpoints.small,mediumBreakPoint=FLBuilderLayoutConfig.breakpoints.medium;if(winWidth<=smallBreakPoint&&'close-all'==this.tabsOnMobile){activeTabContent.hide();activeTabLabelIcon.addClass('fa-plus');}else if(winWidth>=mediumBreakPoint){activeTabContent.show();activeTabLabelIcon.removeClass('fa-plus');}},};})(jQuery);(function($){$(function(){new FLBuilderTabs({id:'69audel2of5y',tabsOnMobile:'open-active',});});})(jQuery);jQuery(function($){if(typeof $.fn.magnificPopup!=='undefined'){$('.fl-node-7rspe84ah6uq a').magnificPopup({type:'image',closeOnContentClick:true,closeBtnInside:false,tLoading:'',preloader:true,image:{titleSrc:function(item){}},callbacks:{open:function(){$('.mfp-preloader').html('<i class="fas fa-spinner fa-spin fa-3x fa-fw"></i>');}}});}
window._fl_string_to_slug_regex='a-zA-Z0-9';});jQuery(function($){$(function(){$('.fl-node-aijhqv1tuz8f .fl-photo-img').on('mouseenter',function(e){$(this).data('title',$(this).attr('title')).removeAttr('title');}).on('mouseleave',function(e){$(this).attr('title',$(this).data('title')).data('title',null);});});window._fl_string_to_slug_regex='a-zA-Z0-9';});jQuery(function($){$(function(){$('.fl-node-0ufcst4o3wex .fl-photo-img').on('mouseenter',function(e){$(this).data('title',$(this).attr('title')).removeAttr('title');}).on('mouseleave',function(e){$(this).attr('title',$(this).data('title')).data('title',null);});});window._fl_string_to_slug_regex='a-zA-Z0-9';});jQuery(function($){$(function(){$('.fl-node-zrutoe54lnjs .fl-photo-img').on('mouseenter',function(e){$(this).data('title',$(this).attr('title')).removeAttr('title');}).on('mouseleave',function(e){$(this).attr('title',$(this).data('title')).data('title',null);});});window._fl_string_to_slug_regex='a-zA-Z0-9';});jQuery(function($){$(function(){$('.fl-node-j1cugsl502ie .fl-photo-img').on('mouseenter',function(e){$(this).data('title',$(this).attr('title')).removeAttr('title');}).on('mouseleave',function(e){$(this).attr('title',$(this).data('title')).data('title',null);});});window._fl_string_to_slug_regex='a-zA-Z0-9';});jQuery(function($){$(function(){$('.fl-node-a439j0ivxlgy .fl-photo-img').on('mouseenter',function(e){$(this).data('title',$(this).attr('title')).removeAttr('title');}).on('mouseleave',function(e){$(this).attr('title',$(this).data('title')).data('title',null);});});window._fl_string_to_slug_regex='a-zA-Z0-9';});