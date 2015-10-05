function EditorTourGuide(e){var t=new Tour({storage:!1});t.addSteps([{element:"#arp_allcolumnsdiv",title:"Real Time Editor",content:"Below you can see that your selected template is loaded in editor. Here you can modify it as per your need.",placement:"top",backdrop:!0,onShown:function(){jQuery("#arp_allcolumnsdiv").css("box-shadow","0 0 0 4px rgba(86,178,11, 1)"),jQuery("#arp_allcolumnsdiv").css("float","left"),jQuery("#arp_allcolumnsdiv").css("padding","10px"),jQuery("#arp_allcolumnsdiv").css("background","#ffffff"),jQuery(".arp_tour").css("margin-top","15px")},onHide:function(){jQuery("#arp_allcolumnsdiv").css("box-shadow",""),jQuery("#arp_allcolumnsdiv").css("float",""),jQuery("#arp_allcolumnsdiv").css("padding",""),jQuery("#arp_allcolumnsdiv").css("background",""),jQuery(".arp_tour").css("margin-top","")},template:"<div class='popover tour arp_tour'><h3 class='popover-title'></h3><div class='popover-content'></div><div class='popover-navigation'><button id='arp_next_two' class='arp_tour_next' style='margin:0 15px 15px;' data-role='next'>Next</button><button class='arp_tour_end_tour' style='margin-right:15px;' data-role='end'>End tour</button></div></nav></div>"},{element:".general_color_opts",title:"Choose color",content:"Select color of your template by clicking the button. you will see color change is applied right away :)",backdrop:!0,placement:"left",onShown:function(){jQuery("#arp_allcolumnsdiv").css("z-index","99999"),jQuery("#arp_allcolumnsdiv").css("position","relative"),jQuery(".general_color_opts").css("box-shadow","0 0 0 4px rgba(86,178,11, 1)"),jQuery(".general_color_opts").css("margin","5px"),jQuery(".general_color_opts").css("padding","0px 6px 6px 2px"),jQuery("#arp_allcolumnsdiv").css("box-shadow","0 0 0 4px rgba(86,178,11, 1)"),jQuery("#arp_allcolumnsdiv").css("float","left"),jQuery("#arp_allcolumnsdiv").css("padding","10px"),jQuery("#arp_allcolumnsdiv").css("background","#ffffff")},onHide:function(){jQuery("#arp_allcolumnsdiv").css("z-index",""),jQuery("#arp_allcolumnsdiv").css("position",""),jQuery(".general_color_opts").css("box-shadow",""),jQuery(".general_color_opts").css("margin-top",""),jQuery(".general_color_opts").css("padding",""),jQuery("#arp_allcolumnsdiv").css("box-shadow",""),jQuery("#arp_allcolumnsdiv").css("float",""),jQuery("#arp_allcolumnsdiv").css("padding",""),jQuery("#arp_allcolumnsdiv").css("background","")},template:"<div class='popover tour arp_tour' style='margin:75px 0 0 -25px'><div class='arrow arrow_color'></div><h3 class='popover-title'></h3><div class='popover-content'></div><div class='popover-navigation'><button class='arp_tour_prev' data-role='prev'>Prev</button> <button id='arp_next_thiree' class='arp_tour_next' data-role='next'>Next</button><button class='arp_tour_end_tour' data-role='end'>End tour</button></div></div>"},{element:"#main_column_0",title:"Column level changes",content:"First click column and on the right side you will see option bar. After selecting column, double click header area to see options for header part.",backdrop:!0,placement:"right",onShown:function(){jQuery("#arp_allcolumnsdiv").addClass("no_arp_tour_hover"),jQuery("#main_column_0").css("box-shadow","0 0 0 4px rgba(86,178,11, 1)")},onHide:function(){jQuery("#arp_allcolumnsdiv").removeClass("no_arp_tour_hover"),jQuery("#main_column_0").css("box-shadow","")},template:"<div style='margin:0 0 0 20px;'; class='popover tour arp_tour'><div class='arrow arrow_header'></div><h3 class='popover-title'></h3><div class='popover-content'></div><div class='popover-navigation'><button class='arp_tour_prev' data-role='prev'>Prev</button><button id='arp_next_four' class='arp_tour_next' data-role='next'>Next</button><button class='arp_tour_end_tour' data-role='end'>End tour</button></div></div>"},{element:"#main_column_0",title:"Pricing area change",content:"Set pricing and its interval from this area.",backdrop:!0,placement:"right",onShown:function(){jQuery("#arp_allcolumnsdiv").addClass("no_arp_tour_hover"),jQuery("#main_column_0").addClass("ArpPricingTableColumnWrapper_inner_selected selected"),jQuery("#main_column_0").find(".arppricetablecolumnprice").trigger("dblclick")},onHide:function(){jQuery("#arp_allcolumnsdiv").removeClass("no_arp_tour_hover"),jQuery("#main_column_0").removeClass("ArpPricingTableColumnWrapper_inner_selected selected")},template:"<div style='margin:0 0 0 20px;'; class='popover tour arp_tour'><div class='arrow arrow_price'></div><h3 class='popover-title'></h3><div class='popover-content'></div><div class='popover-navigation'><button class='arp_tour_prev' data-role='prev'>Prev</button><button id='arp_next_four' class='arp_tour_next' data-role='next'>Next</button><button class='arp_tour_end_tour' data-role='end'>End tour</button></div></div>"},{element:"#preview_btn",title:"Preview button",content:"click 'Next' or 'Preview' button to view your applied changes in saperate responsive tab.",backdrop:!0,placement:"bottom",onNext:function(e){jQuery("#preview_btn").css("box-shadow",""),jQuery("#preview_btn").addClass("DisplayTourGuide"),jQuery("#preview_btn").trigger("click"),jQuery("#arp_allcolumnsdiv").addClass("no_arp_tour_hover"),e.end()},template:"<div style='margin:12px 0 0 -10px;' class='popover tour arp_tour'><div class='arrow'></div><h3 class='popover-title'></h3><div class='popover-content'></div><div class='popover-navigation'><button class='arp_tour_prev' data-role='prev'>Prev</button><button id='arp_next_preview' class='arp_tour_next' data-role='next'>Next</button><button class='arp_tour_end_tour' data-role='end'>End tour</button></div></div>"}]),setTimeout(function(){t.init(),t.start(),e>0&&t.goTo(e)},1e3)}function previewTour(e){console.log(e);var t=new Tour({storage:!1});t.addSteps([{element:".mobile_icon",title:"Change views",content:"Hit Next or Mobile button to view pricing table preview in mobile view.",backdrop:!0,placement:"bottom",onShown:function(){jQuery("#preview_btn").removeClass("DisplayTourGuide")},onNext:function(){jQuery("#mobile_icon").trigger("click")},onPrev:function(e){EditorTourGuide(4),jQuery("#arp_pricing_table_preview .b-close").trigger("click"),e.end()},template:"<div style='margin-top:23px;' class='popover tour arp_tour_preview'><div class='arrow'></div><h3 class='popover-title'></h3><div class='popover-content'></div><div class='popover-navigation'><button class='arp_tour_prev' data-role='prev'>Prev</button><button id='arp_next_mobile' class='arp_tour_next' data-role='next'>Next</button><button class='arp_tour_end_tour' data-role='end'>End tour</button></div></div>"},{element:".mobile_icon",title:"Mobile View",content:"Click 'Next' or close button to get back to editor area.",backdrop:!0,placement:"bottom",onShown:function(){jQuery("#preview_btn").removeClass("DisplayTourGuide")},onNext:function(e){AnimationTours(),jQuery("#arp_pricing_table_preview .b-close").trigger("click"),e.end()},onPrev:function(){jQuery("#computer_icon").trigger("click")},template:"<div style='margin-top:23px;' class='popover tour arp_tour_preview'><div class='arrow'></div><h3 class='popover-title'></h3><div class='popover-content'></div><div class='popover-navigation'><button class='arp_tour_prev' data-role='prev'>Prev</button><button id='arp_next_mobile' class='arp_tour_next' data-role='next'>Next</button><button class='arp_tour_end_tour' data-role='end'>End tour</button></div></div>"}]),setTimeout(function(){t.init(),t.start(),e>0&&t.goTo(e)},1e3)}function AnimationTours(){var e=new Tour({storage:!1});e.addSteps([{element:".general_options_bar_content",title:"General settings",content:"All the template level options like column options, animation effects, tooltip settings etc can be changed in general setting area.",backdrop:!0,placement:"bottom",onShown:function(){jQuery("#preview_btn").removeClass("DisplayTourGuide"),jQuery(".general_options_bar_content").css("box-shadow","0 0 0 4px rgba(86,178,11, 1)"),jQuery(".general_options_bar_content").css("padding","3px"),jQuery(".general_options_bar_content").css("margin-top","7px");var e=jQuery(".general_column_options_tab").width(),t=jQuery(".general_animation_tab").width(),o=jQuery(".general_tooltip_tab").width(),r=jQuery(".general_custom_css_tab").width(),a=parseInt(e)+parseInt(t)+parseInt(o)+parseInt(r);jQuery(".general_options_bar_content").css("width",a+5),jQuery.browser.safari&&jQuery(".arp_tour_preview").css("margin-left","-75%"),jQuery(".general_options_bar_content").css("background","#ffffff"),jQuery(".general_color_opts").hide(),jQuery(".arp_shortcode").hide()},onHide:function(){jQuery(".general_options_bar_content").css("box-shadow",""),jQuery(".general_options_bar_content").css("padding",""),jQuery(".general_options_bar_content").css("margin-top",""),jQuery(".general_options_bar_content").css("width",""),jQuery(".general_options_bar_content").css("background",""),jQuery(".arp_tour_preview").css("margin-left","-25%"),jQuery(".general_color_opts").show(),jQuery(".arp_shortcode").show()},onNext:function(){jQuery("#save_btn").trigger("click")},onPrev:function(e){jQuery(".general_options_bar_content").css("box-shadow",""),jQuery(".general_options_bar_content").css("padding",""),jQuery(".general_options_bar_content").css("margin-top",""),jQuery(".general_options_bar_content").css("width",""),jQuery(".general_options_bar_content").css("background",""),jQuery(".general_color_opts").show(),jQuery(".arp_shortcode").show(),jQuery("#preview_btn").addClass("DisplayTourGuide"),jQuery("#preview_btn").trigger("click"),e.end()},template:"<div style='margin:21px 0 0 -25%;' class='popover tour arp_tour_preview'><div class='arrow'></div><h3 class='popover-title'></h3><div class='popover-content'></div><div class='popover-navigation'><button class='arp_tour_prev' data-role='prev'>Prev</button><button id='arp_next_effects' class='arp_tour_next' data-role='next'>Next</button><button class='arp_tour_end_tour' data-role='end'>End tour</button></div></div>"},{element:".arp_shortcode",title:"Finish",content:"Once you click save button all your changes will be saved as clone of existing template. you can right away copy short code and put it on page. </br>Thank you",backdrop:!0,placement:"bottom",onShown:function(){jQuery(".arp_shortcode").show(),jQuery(".arp_shortcode").css("box-shadow","0 0 0 4px rgba(86,178,11, 1)")},onHide:function(){jQuery(".general_options_bar_content").css("box-shadow","")},onNext:function(e){e.end(),window.location.href="admin.php?page=arprice"},template:"<div style='margin:18px 0 0 0' class='popover tour arp_tour_preview'><div class='arrow'></div><h3 class='popover-title'></h3><div class='popover-content'></div><div class='popover-navigation'><button class='arp_tour_end_tour' data-role='next'>End tour</button></div></div>"}]),setTimeout(function(){e.init(),e.start()},1e3)}jQuery(document).ready(function(){var e=jQuery("#arp_tour_guide_start"),t=new Tour({storage:!1,onStart:function(){return e.addClass("disabled",!0)},onEnd:function(){e.removeClass("disabled",!0)}}),o="<div style='margin-top:18px;' class='popover tour arp_tour'>";o+="<div class='arrow'></div><h3 class='popover-title'></h3>",o+="<div class='popover-content'></div><div class='popover-navigation'>",o+="<button id='arp_next_one' class='arp_tour_next' style='margin:0 15px 15px;' data-role='next'>Next</button>",o+="<button class='arp_tour_end_tour' style='margin-right:15px;'  data-role='end'>End tour</button>",o+="</div>",o+="</div>",t.addSteps([{element:"#arp_template_2",title:"Choose your template",content:"Click 'Next' button to clone selected template.",placement:"bottom",backdrop:!0,onShown:function(){jQuery("#arp_template_2").trigger("click"),jQuery("#arp_template_2").css("background","#ffffff"),jQuery("#arp_template_2").css("box-shadow","0 0 0 4px rgba(86,178,11, 1)")},onHide:function(){jQuery("#arp_template_2").css("background",""),jQuery("#arp_template_2").css("box-shadow","")},onNext:function(e){jQuery("#arp_template_2").find("#clone_template").trigger("click"),setTimeout(function(){EditorTourGuide(0)},1e3),e.end()},template:o}]),t.init(),jQuery(".arp_tour_guide_start_model").click(function(){var e=jQuery("#ajaxurl").val(),o=jQuery(this).attr("id");jQuery.ajax({url:e,type:"POST",data:"action=update_arp_tour_guide_value&arp_tour_guide_value="+o,success:function(e){"1"==e&&t.start()}})}),jQuery(document).on("click","#arp_tour_guide_start",function(e){e.preventDefault(),jQuery(this).hasClass("disabled")||t.restart()});var r=jQuery("#arp_tour_guide_value").val();"yes"==r&&setTimeout(function(){jQuery("#arp_tour_guide_model").bPopup()},1e3)});