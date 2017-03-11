var URL = 'www.apparelsourcing.com.au/';/* http://localhost/AS/        www.pdbl.net/AS/       www.apparelsourcing.com.au/ */
window.onerror=function(desc,page,line,chr){
/* alert('JavaScript error occurred! \n'
  +'\nError description: \t'+desc
  +'\nPage address:      \t'+page
  +'\nLine number:       \t'+line
 );*/
}

$(function(){
 $('a').focus(function(){this.blur();});
 SI.Files.stylizeAll();
 slider.init();

 $('input.text-default').each(function(){
  $(this).attr('default',$(this).val());
 }).focus(function(){
  if($(this).val()==$(this).attr('default'))
   $(this).val('');
 }).blur(function(){
  if($(this).val()=='')
   $(this).val($(this).attr('default'));
 });

 $('input.text,textarea.text').focus(function(){
  $(this).addClass('textfocus');
 }).blur(function(){
  $(this).removeClass('textfocus');
 });

 var popopenobj=0,popopenaobj=null;
 $('a.popup').click(function(){
  var pid=$(this).attr('rel').split('|')[0],_os=parseInt($(this).attr('rel').split('|')[1]);
  var pobj=$('#'+pid);
  if(!pobj.length)
   return false;
  if(typeof popopenobj=='object' && popopenobj.attr('id')!=pid){
   popopenobj.hide(50);
   $(popopenaobj).parent().removeClass(popopenobj.attr('id').split('-')[1]+'-open');
   popopenobj=null;
  }
  return false;
 });
 $('p.images img').click(function(){
  var newbg=$(this).attr('src').split('bg/bg')[1].split('-thumb')[0];
  $(document.body).css('backgroundImage','url('+_siteRoot+'images/bg/bg'+newbg+'.jpg)');
 
  $(this).parent().find('img').removeClass('on');
  $(this).addClass('on');
  return false;
 });
 $(window).load(function(){
  $.each(css_ims,function(){(new Image()).src=_siteRoot+'css/images/'+this;});
  $.each(css_cims,function(){
   var css_im=this;
   $.each(['blue','purple','pink','red','grey','green','yellow','orange'],function(){
    (new Image()).src=_siteRoot+'css/'+this+'/'+css_im;
   });
  });
 }); 
 $('div.sc-large div.img:has(div.tml)').each(function(){
  $('div.tml',this).hide();
  $(this).append('<a href="#" class="tml_open">&nbsp;</a>').find('a').css({
   left:parseInt($(this).offset().left)+864,top:parseInt($(this).offset().top)+1
  }).click(function(){
   $(this).siblings('div.tml').slideToggle();
   return false;
  }).focus(function(){this.blur();}); 
 });
});
var slider={
 num:-1,
 cur:0,
 cr:[],
 al:null,
 at:10*1000,
 ar:true,
 init:function(){
  if(!slider.data || !slider.data.length)
   return false;

  var d=slider.data;
  slider.num=d.length;
  var pos=Math.floor(Math.random()*1);//slider.num);
  for(var i=0;i<slider.num;i++){
   $('#'+d[i].id).css({left:((i-pos)*1000)});
   $('#slide-nav').append('<a id="slide-link-'+i+'" href="#" onclick="slider.slide('+i+');return false;" onfocus="this.blur();">'+(i+1)+'</a>');
  }

  $('img,div#slide-controls',$('div#slide-holder')).fadeIn();
  slider.text(d[pos]);
  slider.on(pos);
  slider.cur=pos;
  window.setTimeout('slider.auto();',slider.at);
 },
 auto:function(){
  if(!slider.ar)
   return false;

  var next=slider.cur+1;
  if(next>=slider.num) next=0;
  slider.slide(next);
 },
 slide:function(pos){
  if(pos<0 || pos>=slider.num || pos==slider.cur)
   return;

  window.clearTimeout(slider.al);
  slider.al=window.setTimeout('slider.auto();',slider.at);

  var d=slider.data;
  for(var i=0;i<slider.num;i++)
   $('#'+d[i].id).stop().animate({left:((i-pos)*1000)},1000,'swing');
  
  slider.on(pos);
  slider.text(d[pos]);
  slider.cur=pos;
 },
 on:function(pos){
  $('#slide-nav a').removeClass('on');
  $('#slide-nav a#slide-link-'+pos).addClass('on');
 },
 text:function(di){
  slider.cr['a']=di.client;
  slider.cr['b']=di.desc;
  slider.ticker('#slide-client span',di.client,0,'a');
  slider.ticker('#slide-desc',di.desc,0,'b');
 },
 ticker:function(el,text,pos,unique){
  if(slider.cr[unique]!=text)
   return false;

  ctext=text.substring(0,pos)+(pos%2?'-':'_');
  $(el).html(ctext);

  if(pos==text.length)
   $(el).html(text);
  else
   window.setTimeout('slider.ticker("'+el+'","'+text+'",'+(pos+1)+',"'+unique+'");',30);
 }
};
// STYLING FILE INPUTS 1.0 | Shaun Inman <http://www.shauninman.com/> | 2007-09-07
if(!window.SI){var SI={};};
SI.Files={
 htmlClass:'SI-FILES-STYLIZED',
 fileClass:'file',
 wrapClass:'cabinet',
 
 fini:false,
 able:false,
 init:function(){
  this.fini=true;
 },
 stylize:function(elem){
  if(!this.fini){this.init();};
  if(!this.able){return;};
  
  elem.parentNode.file=elem;
  elem.parentNode.onmousemove=function(e){
   if(typeof e=='undefined') e=window.event;
   if(typeof e.pageY=='undefined' &&  typeof e.clientX=='number' && document.documentElement){
    e.pageX=e.clientX+document.documentElement.scrollLeft;
    e.pageY=e.clientY+document.documentElement.scrollTop;
   };
   var ox=oy=0;
   var elem=this;
   if(elem.offsetParent){
    ox=elem.offsetLeft;
    oy=elem.offsetTop;
    while(elem=elem.offsetParent){
     ox+=elem.offsetLeft;
     oy+=elem.offsetTop;
    };
   };
  };
 },
 stylizeAll:function(){
  if(!this.fini){this.init();};
  if(!this.able){return;};
 }
};


function WeSeeTextArea()
{
	tinyMCE.init({
		// General options
		
		mode : "textareas",
		theme : "advanced",
		plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

		// Theme options
		theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr",
		theme_advanced_buttons4 : "cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft,|,insertdate,inserttime,preview,|,forecolor,backcolor,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],
		forced_root_block : "", 
  	 	force_br_newlines : true,
        force_p_newlines : false,
		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
}


function ScreenResize()
{	 
	if(self.innerWidth < 768)
	{
		/*var height=467;
		var curr=self.innerWidth;
		
		height=Number(curr)/Number(height);
		
		height=Math.round(340*Number(height));
		alert(curr+' '+height);
		document.getElementById('wrappslider').style.height=height+"px";*/
		document.getElementById('wrappslider').style.height="467px";
		document.getElementById('container_logo').style.marginTop="471px";
		document.getElementById('slide-runner').style.height="100%";
		document.getElementById('slide-holder').style.height="100%";
		document.getElementById('1').setAttribute('href','javascript:');
		document.getElementById('2').setAttribute('href','javascript:');
	}
	else
	{
		document.getElementById('wrappslider').style.height="340px";
		document.getElementById('slide-runner').style.height="100%";
		document.getElementById('slide-holder').style.height="66%";
		document.getElementById('1').setAttribute('href','gui/common_category.php?category=MQ==');
		document.getElementById('2').setAttribute('href','gui/common_category.php?category=Mg==');
	
	}
}
