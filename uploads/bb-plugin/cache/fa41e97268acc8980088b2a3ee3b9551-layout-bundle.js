
jQuery(function($){$(function(){$('.fl-node-qsz61mxkp80j .fl-photo-img').on('mouseenter',function(e){$(this).data('title',$(this).attr('title')).removeAttr('title');}).on('mouseleave',function(e){$(this).attr('title',$(this).data('title')).data('title',null);});});window._fl_string_to_slug_regex='a-zA-Z0-9';});
(function($){$(function(){if('undefined'!==typeof $.fn.fitVids){$('.fl-module-fl-post-content').fitVids();}});})(jQuery);jQuery(function($){$(function(){$('.fl-node-nkmj0cwbpv7r .fl-photo-img').on('mouseenter',function(e){$(this).data('title',$(this).attr('title')).removeAttr('title');}).on('mouseleave',function(e){$(this).attr('title',$(this).data('title')).data('title',null);});});window._fl_string_to_slug_regex='a-zA-Z0-9';});(function($){FLBuilderPostGrid=function(settings)
{this.settings=settings;this.nodeClass='.fl-node-'+settings.id;this.matchHeight=settings.matchHeight;if('columns'==this.settings.layout){this.wrapperClass=this.nodeClass+' .fl-post-grid';this.postClass=this.nodeClass+' .fl-post-column';}
else{this.wrapperClass=this.nodeClass+' .fl-post-'+this.settings.layout;this.postClass=this.wrapperClass+'-post';}
if(this._hasPosts()){this._initLayout();this._initInfiniteScroll();}};FLBuilderPostGrid.prototype={settings:{},nodeClass:'',wrapperClass:'',postClass:'',gallery:null,currPage:1,totalPages:1,_hasPosts:function()
{return $(this.postClass).length>0;},_initLayout:function()
{switch(this.settings.layout){case'columns':this._columnsLayout();break;case'grid':this._gridLayout();break;case'gallery':this._galleryLayout();break;}
$(this.postClass).css('visibility','visible');FLBuilderLayout._scrollToElement($(this.nodeClass+' .fl-paged-scroll-to'));},_columnsLayout:function()
{$(this.wrapperClass).imagesLoaded($.proxy(function(){this._gridLayoutMatchHeight();},this));$(window).on('resize',$.proxy(function(){$(this.wrapperClass).imagesLoaded($.proxy(function(){this._gridLayoutMatchHeight();},this));},this));},_gridLayout:function()
{var wrap=$(this.wrapperClass);wrap.masonry({columnWidth:this.nodeClass+' .fl-post-grid-sizer',gutter:parseInt(this.settings.postSpacing),isFitWidth:true,itemSelector:this.postClass,transitionDuration:0,isRTL:this.settings.isRTL});wrap.imagesLoaded($.proxy(function(){this._gridLayoutMatchHeight();wrap.masonry();},this));$(window).scroll($.debounce(25,function(){wrap.masonry()}));},_gridLayoutMatchHeight:function()
{var highestBox=0;if(!this._isMatchHeight()){$(this.nodeClass+' .fl-post-grid-post').css('height','');return;}
$(this.nodeClass+' .fl-post-grid-post').css('height','').each(function(){if($(this).height()>highestBox){highestBox=$(this).height();}});$(this.nodeClass+' .fl-post-grid-post').height(highestBox);},_isMatchHeight:function(){var width=$(window).width(),breakpoints=FLBuilderLayoutConfig.breakpoints,matchLarge=''!=this.matchHeight.large?this.matchHeight.large:this.matchHeight.default,matchMedium=''!=this.matchHeight.medium?this.matchHeight.medium:this.matchHeight.default,matchSmall=''!=this.matchHeight.responsive?this.matchHeight.responsive:this.matchHeight.default;return(width>breakpoints.medium&&1==this.matchHeight.default)||(width>breakpoints.medium&&width<=breakpoints.large&&1==matchLarge)||(width>breakpoints.small&&width<=breakpoints.medium&&1==matchMedium)||(width<=breakpoints.small&&1==matchSmall);},_galleryLayout:function()
{this.gallery=new FLBuilderGalleryGrid({'wrapSelector':this.wrapperClass,'itemSelector':'.fl-post-gallery-post','isRTL':this.settings.isRTL});},_initInfiniteScroll:function()
{var isScroll='scroll'==this.settings.pagination||'load_more'==this.settings.pagination,pages=$(this.nodeClass+' .fl-builder-pagination').find('li .page-numbers:not(.next)');if(pages.length>1){total=pages.last().text().replace(/\D/g,'')
this.totalPages=parseInt(total);}
if(isScroll&&this.totalPages>1&&'undefined'===typeof FLBuilder){this._infiniteScroll();if('load_more'==this.settings.pagination){this._infiniteScrollLoadMore();}}},_infiniteScroll:function(settings)
{var path=$(this.nodeClass+' .fl-builder-pagination a.next').attr('href'),pagePattern=/(.*?(\/|\&|\?)paged-[0-9]{1,}(\/|=))([0-9]{1,})+(.*)/,wpPattern=/^(.*?\/?page\/?)(?:\d+)(.*?$)/,pageMatched=null,scrollData={navSelector:this.nodeClass+' .fl-builder-pagination',nextSelector:this.nodeClass+' .fl-builder-pagination a.next',itemSelector:this.postClass,prefill:true,bufferPx:200,loading:{msgText:'Loading',finishedMsg:'',img:FLBuilderLayoutConfig.paths.pluginUrl+'img/ajax-loader-grey.gif',speed:1}};if(pagePattern.test(path)){scrollData.path=function(currPage){pageMatched=path.match(pagePattern);path=pageMatched[1]+currPage+pageMatched[5];return path;}}
else if(wpPattern.test(path)){scrollData.path=path.match(wpPattern).slice(1);}
$(this.wrapperClass).infinitescroll(scrollData,$.proxy(this._infiniteScrollComplete,this));setTimeout(function(){$(window).trigger('resize');},100);},_infiniteScrollComplete:function(elements)
{var wrap=$(this.wrapperClass);elements=$(elements);if(this.settings.layout=='columns'){wrap.imagesLoaded($.proxy(function(){this._gridLayoutMatchHeight();elements.css('visibility','visible');},this));}
else if(this.settings.layout=='grid'){wrap.imagesLoaded($.proxy(function(){this._gridLayoutMatchHeight();wrap.masonry('appended',elements);wrap.masonry();elements.css('visibility','visible');},this));}
else if(this.settings.layout=='gallery'){this.gallery.resize();elements.css('visibility','visible');}
if('load_more'==this.settings.pagination){$(this.wrapperClass+' .fl-post-grid-sizer.masonry-brick').appendTo(this.wrapperClass);$('#infscr-loading').appendTo(this.wrapperClass);}
elements.find('img[srcset]').each(function(index,img){img.outerHTML=img.outerHTML;});this.currPage++;this._removeLoadMoreButton();},_infiniteScrollLoadMore:function()
{var wrap=$(this.wrapperClass);$(window).unbind('.infscr');$(this.nodeClass+' .fl-builder-pagination-load-more .fl-button').on('click',function(){if($('#infscr-loading').length){$('#infscr-loading').remove();}
wrap.infinitescroll('retrieve');return false;});},_removeLoadMoreButton:function()
{if('load_more'==this.settings.pagination&&this.totalPages==this.currPage){$(this.nodeClass+' .fl-builder-pagination-load-more').remove();}}};})(jQuery);(function($){$(function(){new FLBuilderPostGrid({id:'8cqd6rp9gf5n',layout:'columns',pagination:'numbers',postSpacing:'50',postWidth:'300',matchHeight:{default:'1',large:'',medium:'',responsive:''},isRTL:false});});})(jQuery);
(function($){FLThemeBuilderHeaderLayout={win:null,body:null,header:null,overlay:false,hasAdminBar:false,stickyOn:'',breakpointWidth:0,init:function()
{var editing=$('html.fl-builder-edit').length,header=$('.fl-builder-content[data-type=header]'),menuModule=header.find('.fl-module-menu'),breakpoint=null;if(!editing&&header.length){header.imagesLoaded($.proxy(function(){this.win=$(window);this.body=$('body');this.header=header.eq(0);this.overlay=!!Number(header.attr('data-overlay'));this.hasAdminBar=!!$('body.admin-bar').length;this.stickyOn=this.header.data('sticky-on');breakpoint=this.header.data('sticky-breakpoint');if(''==this.stickyOn){if(typeof FLBuilderLayoutConfig.breakpoints[breakpoint]!==undefined){this.breakpointWidth=FLBuilderLayoutConfig.breakpoints[breakpoint];}
else{this.breakpointWidth=FLBuilderLayoutConfig.breakpoints.medium;}}
if(Number(header.attr('data-sticky'))){this.header.data('original-top',this.header.offset().top);this.win.on('resize',$.throttle(500,$.proxy(this._initSticky,this)));this._initSticky();}},this));}},_initSticky:function(e)
{var header=$('.fl-builder-content[data-type=header]'),windowSize=this.win.width(),makeSticky=false;makeSticky=this._makeWindowSticky(windowSize);if(makeSticky||(this.breakpointWidth>0&&windowSize>=this.breakpointWidth)){this.win.on('scroll.fl-theme-builder-header-sticky',$.proxy(this._doSticky,this));if(e&&'resize'===e.type){if(this.header.hasClass('fl-theme-builder-header-sticky')){this._doSticky(e);}
this._adjustStickyHeaderWidth();}
if(Number(header.attr('data-shrink'))){this.header.data('original-height',this.header.outerHeight());this.win.on('resize',$.throttle(500,$.proxy(this._initShrink,this)));this._initShrink();}
this._initFlyoutMenuFix(e);}else{this.win.off('scroll.fl-theme-builder-header-sticky');this.win.off('resize.fl-theme-builder-header-sticky');this.header.removeClass('fl-theme-builder-header-sticky');this.header.removeAttr('style');this.header.parent().css('padding-top','0');}},_makeWindowSticky:function(windowSize)
{var makeSticky=false;switch(this.stickyOn){case'xl':makeSticky=windowSize>FLBuilderLayoutConfig.breakpoints['large'];break;case'':case'desktop':makeSticky=windowSize>=FLBuilderLayoutConfig.breakpoints['medium'];break;case'desktop-medium':makeSticky=windowSize>FLBuilderLayoutConfig.breakpoints['small'];break;case'large':makeSticky=windowSize>FLBuilderLayoutConfig.breakpoints['medium']&&windowSize<=FLBuilderLayoutConfig.breakpoints['large'];break;case'large-medium':makeSticky=windowSize>FLBuilderLayoutConfig.breakpoints['small']&&windowSize<=FLBuilderLayoutConfig.breakpoints['large'];break;case'medium':makeSticky=(windowSize<=FLBuilderLayoutConfig.breakpoints['medium']&&windowSize>FLBuilderLayoutConfig.breakpoints['small']);break;case'medium-mobile':makeSticky=(windowSize<=FLBuilderLayoutConfig.breakpoints['medium']);break;case'mobile':makeSticky=(windowSize<=FLBuilderLayoutConfig.breakpoints['small']);break;case'all':makeSticky=true;break;}
return makeSticky;},_doSticky:function(e)
{var winTop=Math.floor(this.win.scrollTop()),headerTop=Math.floor(this.header.data('original-top')),hasStickyClass=this.header.hasClass('fl-theme-builder-header-sticky'),hasScrolledClass=this.header.hasClass('fl-theme-builder-header-scrolled'),beforeHeader=this.header.prevAll('.fl-builder-content'),bodyTopPadding=parseInt(jQuery('body').css('padding-top')),winBarHeight=$('#wpadminbar').length?$('#wpadminbar').outerHeight():0,headerHeight=0;if(isNaN(bodyTopPadding)){bodyTopPadding=0;}
if(this.hasAdminBar&&this.win.width()>600){winTop+=Math.floor(winBarHeight);}
if(winTop>headerTop){if(!hasStickyClass){if(e&&('scroll'===e.type||'smartscroll'===e.type)){this.header.addClass('fl-theme-builder-header-sticky');if(this.overlay&&beforeHeader.length){this.header.css('top',winBarHeight);}}
if(!this.overlay){this._adjustHeaderHeight();}}}
else if(hasStickyClass){this.header.removeClass('fl-theme-builder-header-sticky');this.header.removeAttr('style');this.header.parent().css('padding-top','0');}
this._adjustStickyHeaderWidth();if(winTop>headerTop){if(!hasScrolledClass){this.header.addClass('fl-theme-builder-header-scrolled');}}else if(hasScrolledClass){this.header.removeClass('fl-theme-builder-header-scrolled');}
this._flyoutMenuFix(e);},_initFlyoutMenuFix:function(e){var header=this.header,menuModule=header.find('.fl-menu'),flyoutMenu=menuModule.find('.fl-menu-mobile-flyout'),isPushMenu=menuModule.hasClass('fl-menu-responsive-flyout-push')||menuModule.hasClass('fl-menu-responsive-flyout-push-opacity'),isSticky=header.hasClass('fl-theme-builder-header-sticky'),isOverlay=menuModule.hasClass('fl-menu-responsive-flyout-overlay'),flyoutPos=menuModule.hasClass('fl-flyout-right')?'right':'left',flyoutParent=header.parent().is('header')?header.parent().parent():header.parent();isFullWidth=this.win.width()===header.width(),flyoutLayout='',activePos=250,headerPos=0;if(!flyoutMenu.length){return;}
if(this.win.width()>header.parent().width()){headerPos=(this.win.width()-header.width())/2;}
if(isOverlay){activePos=headerPos;}
else if(isPushMenu){activePos=activePos+headerPos;}
flyoutMenu.data('activePos',activePos);if(isPushMenu){flyoutLayout='push-'+flyoutPos;}
else if(isOverlay){flyoutLayout='overlay-'+flyoutPos;}
if(isPushMenu&&!$('html').hasClass('fl-theme-builder-has-flyout-menu')){$('html').addClass('fl-theme-builder-has-flyout-menu');}
if(!flyoutParent.hasClass('fl-theme-builder-flyout-menu-'+flyoutLayout)){flyoutParent.addClass('fl-theme-builder-flyout-menu-'+flyoutLayout);}
if(!header.hasClass('fl-theme-builder-flyout-menu-overlay')&&isOverlay){header.addClass('fl-theme-builder-flyout-menu-overlay');}
if(!header.hasClass('fl-theme-builder-header-full-width')&&isFullWidth){header.addClass('fl-theme-builder-header-full-width');}
else if(!isFullWidth){header.removeClass('fl-theme-builder-header-full-width');}
menuModule.on('click','.fl-menu-mobile-toggle',$.proxy(function(event){if(menuModule.find('.fl-menu-mobile-toggle.fl-active').length){$('html').addClass('fl-theme-builder-flyout-menu-active');event.stopImmediatePropagation();}
else{$('html').removeClass('fl-theme-builder-flyout-menu-active');}
this._flyoutMenuFix(event);},this));},_flyoutMenuFix:function(e){var header=this.header,menuModule=header.find('.fl-menu'),flyoutMenu=menuModule.find('.fl-menu-mobile-flyout'),isPushMenu=menuModule.hasClass('fl-menu-responsive-flyout-push')||menuModule.hasClass('fl-menu-responsive-flyout-push-opacity'),flyoutPos=menuModule.hasClass('fl-flyout-right')?'right':'left',menuOpacity=menuModule.find('.fl-menu-mobile-opacity'),isScroll='undefined'!==typeof e&&'scroll'===e.handleObj.type,activePos='undefined'!==typeof flyoutMenu.data('activePos')?flyoutMenu.data('activePos'):0,headerPos=(this.win.width()-header.width())/2,inactivePos=headerPos>0?activePos+4:254;if(!flyoutMenu.length){return;}
if(this.overlay){return;}
if($('.fl-theme-builder-flyout-menu-active').length){if(isScroll&&!flyoutMenu.hasClass('fl-menu-disable-transition')){flyoutMenu.addClass('fl-menu-disable-transition');}
if(header.hasClass('fl-theme-builder-header-sticky')){if(!isScroll){setTimeout($.proxy(function(){flyoutMenu.css(flyoutPos,'-'+activePos+'px');},this),1);}
else{flyoutMenu.css(flyoutPos,'-'+activePos+'px');}}
else{flyoutMenu.css(flyoutPos,'0px');}}
else{if(flyoutMenu.hasClass('fl-menu-disable-transition')){flyoutMenu.removeClass('fl-menu-disable-transition');}
if(header.hasClass('fl-theme-builder-flyout-menu-overlay')&&headerPos>0&&headerPos<250){if(header.hasClass('fl-theme-builder-header-sticky')){inactivePos=headerPos+254;}
else{inactivePos=254;}}
if(e&&e.type==='resize'){inactivePos=headerPos+254;}
flyoutMenu.css(flyoutPos,'-'+inactivePos+'px');}
if(e&&menuModule.is('.fl-menu-responsive-flyout-overlay')&&$.infinitescroll){e.stopImmediatePropagation();}
if(menuOpacity.length){if(header.hasClass('fl-theme-builder-header-sticky')){if('0px'===menuOpacity.css('left')){menuOpacity.css('left','-'+headerPos+'px');}}
else{menuOpacity.css('left','');}}},_adjustStickyHeaderWidth:function(){if($('body').hasClass('fl-fixed-width')){var parentWidth=this.header.parent().width();if(this.win.width()>=992){this.header.css({'margin':'0 auto','max-width':parentWidth,});}
else{this.header.css({'margin':'','max-width':'',});}}},_adjustHeaderHeight:function(){var beforeHeader=this.header.prevAll('.fl-builder-content'),beforeHeaderHeight=0,beforeHeaderFix=0,headerHeight=Math.floor(this.header.outerHeight()),bodyTopPadding=parseInt($('body').css('padding-top')),wpAdminBarHeight=0,totalHeaderHeight=0;if(isNaN(bodyTopPadding)){bodyTopPadding=0;}
if(beforeHeader.length){$.each(beforeHeader,function(){beforeHeaderHeight+=Math.floor($(this).outerHeight());});beforeHeaderFix=2;}
if(this.hasAdminBar&&this.win.width()<=600){wpAdminBarHeight=Math.floor($('#wpadminbar').outerHeight());}
totalHeaderHeight=Math.floor(beforeHeaderHeight+headerHeight);if(headerHeight>0){var headerParent=this.header.parent(),headerParentTopPadding=0;if($(headerParent).is('body')){headerParentTopPadding=Math.floor(headerHeight-wpAdminBarHeight);}else{headerParentTopPadding=Math.floor(headerHeight-bodyTopPadding-wpAdminBarHeight);}
$(headerParent).css('padding-top',(headerParentTopPadding-beforeHeaderFix)+'px');this.header.css({'-webkit-transform':'translate(0px, -'+totalHeaderHeight+'px)','-ms-transform':'translate(0px, -'+totalHeaderHeight+'px)','transform':'translate(0px, -'+totalHeaderHeight+'px)'});}},_initShrink:function(e)
{if(this.win.width()>=this.breakpointWidth){this.win.on('scroll.fl-theme-builder-header-shrink',$.proxy(this._doShrink,this));this._setImageMaxHeight();if(this.win.scrollTop()>0){this._doShrink();}}else{this.header.parent().css('padding-top','0');this.win.off('scroll.fl-theme-builder-header-shrink');this._removeShrink();this._removeImageMaxHeight();}},_doShrink:function(e)
{var winTop=this.win.scrollTop(),headerTop=this.header.data('original-top'),headerHeight=this.header.data('original-height'),shrinkImageHeight=this.header.data('shrink-image-height'),windowSize=this.win.width(),makeSticky=this._makeWindowSticky(windowSize),hasClass=this.header.hasClass('fl-theme-builder-header-shrink');if(this.hasAdminBar){winTop+=32;}
if(makeSticky&&(winTop>headerTop+headerHeight)){if(!hasClass){this.header.addClass('fl-theme-builder-header-shrink');this.header.find('img').each(function(i){var image=$(this),maxMegaMenu=image.closest('.max-mega-menu').length,imageInLightbox=image.closest('.fl-button-lightbox-content').length,imageInNavMenu=image.closest('li.menu-item').length;if(!(imageInLightbox||imageInNavMenu||maxMegaMenu)){image.css('max-height',shrinkImageHeight);}});this.header.find('.fl-row-content-wrap').each(function(){var row=$(this);if(parseInt(row.css('padding-bottom'))>5){row.addClass('fl-theme-builder-header-shrink-row-bottom');}
if(parseInt(row.css('padding-top'))>5){row.addClass('fl-theme-builder-header-shrink-row-top');}});this.header.find('.fl-module-content').each(function(){var module=$(this);if(parseInt(module.css('margin-bottom'))>5){module.addClass('fl-theme-builder-header-shrink-module-bottom');}
if(parseInt(module.css('margin-top'))>5){module.addClass('fl-theme-builder-header-shrink-module-top');}});}}else if(hasClass){this.header.find('img').css('max-height','');this._removeShrink();}
if('undefined'===typeof(e)&&$('body').hasClass('fl-fixed-width')){if(!this.overlay){this._adjustHeaderHeight();}}},_removeShrink:function()
{var rows=this.header.find('.fl-row-content-wrap'),modules=this.header.find('.fl-module-content');rows.removeClass('fl-theme-builder-header-shrink-row-bottom');rows.removeClass('fl-theme-builder-header-shrink-row-top');modules.removeClass('fl-theme-builder-header-shrink-module-bottom');modules.removeClass('fl-theme-builder-header-shrink-module-top');this.header.removeClass('fl-theme-builder-header-shrink');},_setImageMaxHeight:function()
{var head=$('head'),stylesId='fl-header-styles-'+this.header.data('post-id'),styles='',images=this.header.find('.fl-module-content img');if($('#'+stylesId).length){return;}
images.each(function(i){var image=$(this),height=image.height(),node=image.closest('.fl-module').data('node'),className='fl-node-'+node+'-img-'+i,maxMegaMenu=image.closest('.max-mega-menu').length,imageInLightbox=image.closest('.fl-button-lightbox-content').length,imageInNavMenu=image.closest('li.menu-item').length;if(!(imageInLightbox||imageInNavMenu||maxMegaMenu)){image.addClass(className);styles+='.'+className+' { max-height: '+(height?height:image[0].height)+'px }';}});if(''!==styles){head.append('<style id="'+stylesId+'">'+styles+'</style>');}},_removeImageMaxHeight:function()
{$('#fl-header-styles-'+this.header.data('post-id')).remove();},};$(function(){FLThemeBuilderHeaderLayout.init();});})(jQuery);