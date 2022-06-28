/**
 * Resize function without multiple trigger
 * 
 * Usage:
 * $(window).smartresize(function(){  
 *     // code here
 * });
 */
(function($,sr){
    // debouncing function from John Hann
    // http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
    var debounce = function (func, threshold, execAsap) {
      var timeout;

        return function debounced () {
            var obj = this, args = arguments;
            function delayed () {
                if (!execAsap)
                    func.apply(obj, args); 
                timeout = null; 
            }

            if (timeout)
                clearTimeout(timeout);
            else if (execAsap)
                func.apply(obj, args);

            timeout = setTimeout(delayed, threshold || 100); 
        };
    };

    // smartresize 
    jQuery.fn[sr] = function(fn){  return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr); };
})(jQuery,'smartresize');
/**
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var CURRENT_URL = window.location.href.split('#')[0].split('?')[0],
    $BODY = $('body'),
    $MENU_TOGGLE = $('#menu_toggle'),
    $SIDEBAR_MENU = $('#sidebar-menu'),
    $SIDEBAR_FOOTER = $('.sidebar-footer'),
    $LEFT_COL = $('.left_col'),
    $RIGHT_COL = $('.right_col'),
    $NAV_MENU = $('.nav_menu'),
    $FOOTER = $('footer');

	
	
// Sidebar
	function init_sidebar() {
	// TODO: This is some kind of easy fix, maybe we can improve this
	var setContentHeight = function () {
		// reset height
		$RIGHT_COL.css('min-height', $(window).height());

		var bodyHeight = $BODY.outerHeight(),
			footerHeight = $BODY.hasClass('footer_fixed') ? -10 : $FOOTER.height(),
			leftColHeight = $LEFT_COL.eq(1).height() + $SIDEBAR_FOOTER.height(),
			contentHeight = bodyHeight < leftColHeight ? leftColHeight : bodyHeight;

		// normalize content
		contentHeight -= $NAV_MENU.height() + footerHeight;

		$RIGHT_COL.css('min-height', contentHeight);
	};

	  $SIDEBAR_MENU.find('a').on('click', function(ev) {
		  //console.log('clicked - sidebar_menu');
	        var $li = $(this).parent();

	        if ($li.is('.active')) {
	            $li.removeClass('active active-sm');
	            $('ul:first', $li).slideUp(function() {
	                setContentHeight();
	            });
	        } else {
	            // prevent closing menu if we are on child menu
	            if (!$li.parent().is('.child_menu')) {
	                $SIDEBAR_MENU.find('li').removeClass('active active-sm');
	                $SIDEBAR_MENU.find('li ul').slideUp();
	            }else
	            {
					if ( $BODY.is( ".nav-sm" ) )
					{
						$SIDEBAR_MENU.find( "li" ).removeClass( "active active-sm" );
						$SIDEBAR_MENU.find( "li ul" ).slideUp();
					}
				}
	            $li.addClass('active');

	            $('ul:first', $li).slideDown(function() {
	                setContentHeight();
	            });
	        }
	    });

	// toggle small or large menu 
	$MENU_TOGGLE.on('click', function() {
			//console.log('clicked - menu toggle');
			
			if ($BODY.hasClass('nav-md')) {
				$SIDEBAR_MENU.find('li.active ul').hide();
				$SIDEBAR_MENU.find('li.active').addClass('active-sm').removeClass('active');
			} else {
				$SIDEBAR_MENU.find('li.active-sm ul').show();
				$SIDEBAR_MENU.find('li.active-sm').addClass('active').removeClass('active-sm');
			}

		$BODY.toggleClass('nav-md nav-sm');

		setContentHeight();

		$('.dataTable').each ( function () { $(this).dataTable().fnDraw(); });
	});

		// check active menu
		$SIDEBAR_MENU.find('a[href="' + CURRENT_URL + '"]').parent('li').addClass('current-page');

		$SIDEBAR_MENU.find('a').filter(function () {
			return this.href == CURRENT_URL;
		}).parent('li').addClass('current-page').parents('ul').slideDown(function() {
			setContentHeight();
		}).parent().addClass('active');

		// recompute content when resizing
		$(window).smartresize(function(){  
			setContentHeight();
		});

		setContentHeight();

		// fixed sidebar
		if ($.fn.mCustomScrollbar) {
			$('.menu_fixed').mCustomScrollbar({
				autoHideScrollbar: true,
				theme: 'minimal',
				mouseWheel:{ preventDefault: true }
			});
		}
	};
// /Sidebar

	var randNum = function() {
	  return (Math.floor(Math.random() * (1 + 40 - 20))) + 20;
	};


// Panel toolbox
	$(document).ready(function() {
	    $('.collapse-link').on('click', function() {
	        var $BOX_PANEL = $(this).closest('.x_panel'),
	            $ICON = $(this).find('i'),
	            $BOX_CONTENT = $BOX_PANEL.find('.x_content');
	        
	        // fix for some div with hardcoded fix class
	        if ($BOX_PANEL.attr('style')) {
	            $BOX_CONTENT.slideToggle(200, function(){
	                $BOX_PANEL.removeAttr('style');
	            });
	        } else {
	            $BOX_CONTENT.slideToggle(200); 
	            $BOX_PANEL.css('height', 'auto');  
	        }

	        $ICON.toggleClass('fa-chevron-up fa-chevron-down');
	    });

	    $('.close-link').click(function () {
	        var $BOX_PANEL = $(this).closest('.x_panel');

	        $BOX_PANEL.remove();
	    });
	});
// /Panel toolbox

// Tooltip
	$(document).ready(function() {
	    $('[data-toggle="tooltip"]').tooltip({
	        container: 'body'
	    });
	});
// /Tooltip

// Progressbar
	if ($(".progress .progress-bar")[0]) {
	    $('.progress .progress-bar').progressbar();
	}
// /Progressbar

// Switchery
	$(document).ready(function() {
	    if ($(".js-switch")[0]) {
	        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
	        elems.forEach(function (html) {
	            var switchery = new Switchery(html, {
	                color: '#26B99A'
	            });
	        });
	    }
	});
// /Switchery


// iCheck
	$(document).ready(function() {
	    if ($("input.flat")[0]) {
	        $(document).ready(function () {
	            $('input.flat').iCheck({
	                checkboxClass: 'icheckbox_flat-green',
	                radioClass: 'iradio_flat-green'
	            });
	        });
	    }
	});
// /iCheck

// Table
	$('table input').on('ifChecked', function () {
	    checkState = '';
	    $(this).parent().parent().parent().addClass('selected');
	    countChecked();
	});
	$('table input').on('ifUnchecked', function () {
	    checkState = '';
	    $(this).parent().parent().parent().removeClass('selected');
	    countChecked();
	});

	var checkState = '';

	$('.bulk_action input').on('ifChecked', function () {
	    checkState = '';
	    $(this).parent().parent().parent().addClass('selected');
	    countChecked();
	});
	$('.bulk_action input').on('ifUnchecked', function () {
	    checkState = '';
	    $(this).parent().parent().parent().removeClass('selected');
	    countChecked();
	});
	$('.bulk_action input#check-all').on('ifChecked', function () {
	    checkState = 'all';
	    countChecked();
	});
	$('.bulk_action input#check-all').on('ifUnchecked', function () {
	    checkState = 'none';
	    countChecked();
	});

function countChecked() {
    if (checkState === 'all') {
        $(".bulk_action input[name='table_records']").iCheck('check');
    }
    if (checkState === 'none') {
        $(".bulk_action input[name='table_records']").iCheck('uncheck');
    }

    var checkCount = $(".bulk_action input[name='table_records']:checked").length;

    if (checkCount) {
        $('.column-title').hide();
        $('.bulk-actions').show();
        $('.action-cnt').html(checkCount + ' Records Selected');
    } else {
        $('.column-title').show();
        $('.bulk-actions').hide();
    }
}



// Accordion
	$(document).ready(function() {
	    $(".expand").on("click", function () {
	        $(this).next().slideToggle(200);
	        $expand = $(this).find(">:first-child");

	        if ($expand.text() == "+") {
	            $expand.text("-");
	        } else {
	            $expand.text("+");
	        }
	    });
	});
// Accordion

// NProgress
	if (typeof NProgress != 'undefined') {
	    $(document).ready(function () {
	        NProgress.start();
	    });

	    $(window).load(function () {
	        NProgress.done();
	    });
	}

		
  //hover and retain popover when on popover content
    var originalLeave = $.fn.popover.Constructor.prototype.leave;
    $.fn.popover.Constructor.prototype.leave = function(obj) {
      var self = obj instanceof this.constructor ?
        obj : $(obj.currentTarget)[this.type](this.getDelegateOptions()).data('bs.' + this.type);
      var container, timeout;

      originalLeave.call(this, obj);

      if (obj.currentTarget) {
        container = $(obj.currentTarget).siblings('.popover');
        timeout = self.timeout;
        container.one('mouseenter', function() {
          //We entered the actual popover – call off the dogs
          clearTimeout(timeout);
          //Let's monitor popover content instead
          container.one('mouseleave', function() {
            $.fn.popover.Constructor.prototype.leave.call(self, self);
          });
        });
      }
    };

    $('body').popover({
      selector: '[data-popover]',
      trigger: 'click hover',
      delay: {
        show: 50,
        hide: 400
      }
    });
// NProgress


	function gd(year, month, day) {
		return new Date(year, month - 1, day).getTime();
	}
	  
	
	
	   
	
	  
		
		 
	  
		
	 
/* INPUT MASK */
			
	function init_InputMask() {			
		if( typeof ($.fn.inputmask) === 'undefined'){ return; }
		//console.log('init_InputMask');
		
			$(":input").inputmask();				
	};

	function init_autosize(){"undefined"!=typeof $.fn.autosize&&autosize($(".resizable_textarea"))}

/* init_parsley */
	function init_parsley(){if("undefined"!=typeof parsley){console.log("init_parsley"),$("parsley:field:validate",function(){a()}),$("#demo-form .btn").on("click",function(){$("#demo-form").parsley().validate(),a()});var a=function(){!0===$("#demo-form").parsley().isValid()?($(".bs-callout-info").removeClass("hidden"),$(".bs-callout-warning").addClass("hidden")):($(".bs-callout-info").addClass("hidden"),$(".bs-callout-warning").removeClass("hidden"))};$("parsley:field:validate",function(){a()}),$("#demo-form2 .btn").on("click",function(){$("#demo-form2").parsley().validate(),a()});var a=function(){!0===$("#demo-form2").parsley().isValid()?($(".bs-callout-info").removeClass("hidden"),$(".bs-callout-warning").addClass("hidden")):($(".bs-callout-info").addClass("hidden"),$(".bs-callout-warning").removeClass("hidden"))};try{hljs.initHighlightingOnLoad()}catch(a){}}}function onAddTag(a){alert("Added a tag: "+a)}function onRemoveTag(a){alert("Removed a tag: "+a)}function onChangeTag(a,b){alert("Changed a tag: "+b)}
	  
		
	   
	   
	   /* DATERANGEPICKER */
	   
		function init_daterangepicker() {

			if( typeof ($.fn.daterangepicker) === 'undefined'){ return; }
			console.log('init_daterangepicker');
		
			var cb = function(start, end, label) {
			 // console.log(start.toISOString(), end.toISOString(), label);
			  $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
			};

			var optionSet1 = {
			  startDate: moment().subtract(29, 'days'),
			  endDate: moment(),
			  minDate: '01/01/2012',
			  maxDate: '12/31/2015',
			  dateLimit: {
				days: 60
			  },
			  showDropdowns: true,
			  showWeekNumbers: true,
			  timePicker: false,
			  timePickerIncrement: 1,
			  timePicker12Hour: true,
			  ranges: {
				'Today': [moment(), moment()],
				'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
				'Last 7 Days': [moment().subtract(6, 'days'), moment()],
				'Last 30 Days': [moment().subtract(29, 'days'), moment()],
				'This Month': [moment().startOf('month'), moment().endOf('month')],
				'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
			  },
			  opens: 'left',
			  buttonClasses: ['btn btn-default'],
			  applyClass: 'btn-small btn-primary',
			  cancelClass: 'btn-small',
			  format: 'MM/DD/YYYY',
			  separator: ' to ',
			  locale: {
				applyLabel: 'Submit',
				cancelLabel: 'Clear',
				fromLabel: 'From',
				toLabel: 'To',
				customRangeLabel: 'Custom',
				daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
				monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
				firstDay: 1
			  }
			};
			
			$('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
			$('#reportrange').daterangepicker(optionSet1, cb);
			$('#reportrange').on('show.daterangepicker', function() {
			  console.log("show event fired");
			});
			$('#reportrange').on('hide.daterangepicker', function() {
			  console.log("hide event fired");
			});
			$('#reportrange').on('apply.daterangepicker', function(ev, picker) {
			  console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
			});
			$('#reportrange').on('cancel.daterangepicker', function(ev, picker) {
			  console.log("cancel event fired");
			});
			$('#options1').click(function() {
			  $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
			});
			$('#options2').click(function() {
			  $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
			});
			$('#destroy').click(function() {
			  $('#reportrange').data('daterangepicker').remove();
			});
   
		}
   	   
	   function init_daterangepicker_right() {
	      
				if( typeof ($.fn.daterangepicker) === 'undefined'){ return; }
				console.log('init_daterangepicker_right');
		  
				var cb = function(start, end, label) {
				  console.log(start.toISOString(), end.toISOString(), label);
				  $('#reportrange_right span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
				};

				var optionSet1 = {
				  startDate: moment().subtract(29, 'days'),
				  endDate: moment(),
				  minDate: '01/01/2012',
				  maxDate: '12/31/2020',
				  dateLimit: {
					days: 60
				  },
				  showDropdowns: true,
				  showWeekNumbers: true,
				  timePicker: false,
				  timePickerIncrement: 1,
				  timePicker12Hour: true,
				  ranges: {
					'Today': [moment(), moment()],
					'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
					'Last 7 Days': [moment().subtract(6, 'days'), moment()],
					'Last 30 Days': [moment().subtract(29, 'days'), moment()],
					'This Month': [moment().startOf('month'), moment().endOf('month')],
					'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
				  },
				  opens: 'right',
				  buttonClasses: ['btn btn-default'],
				  applyClass: 'btn-small btn-primary',
				  cancelClass: 'btn-small',
				  format: 'MM/DD/YYYY',
				  separator: ' to ',
				  locale: {
					applyLabel: 'Submit',
					cancelLabel: 'Clear',
					fromLabel: 'From',
					toLabel: 'To',
					customRangeLabel: 'Custom',
					daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
					monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
					firstDay: 1
				  }
				};

				$('#reportrange_right span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));

				$('#reportrange_right').daterangepicker(optionSet1, cb);

				$('#reportrange_right').on('show.daterangepicker', function() {
				  console.log("show event fired");
				});
				$('#reportrange_right').on('hide.daterangepicker', function() {
				  console.log("hide event fired");
				});
				$('#reportrange_right').on('apply.daterangepicker', function(ev, picker) {
				  console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
				});
				$('#reportrange_right').on('cancel.daterangepicker', function(ev, picker) {
				  console.log("cancel event fired");
				});

				$('#options1').click(function() {
				  $('#reportrange_right').data('daterangepicker').setOptions(optionSet1, cb);
				});

				$('#options2').click(function() {
				  $('#reportrange_right').data('daterangepicker').setOptions(optionSet2, cb);
				});

				$('#destroy').click(function() {
				  $('#reportrange_right').data('daterangepicker').remove();
				});

	   }
	   
	    function init_daterangepicker_single_call() {
	      
			if( typeof ($.fn.daterangepicker) === 'undefined'){ return; }
			console.log('init_daterangepicker_single_call');
		   
			$('#single_cal1').daterangepicker({
			  singleDatePicker: true,
			  singleClasses: "picker_1"
			}, function(start, end, label) {
			  console.log(start.toISOString(), end.toISOString(), label);
			});
			$('#single_cal2').daterangepicker({
			  singleDatePicker: true,
			  singleClasses: "picker_2"
			}, function(start, end, label) {
			  console.log(start.toISOString(), end.toISOString(), label);
			});
			$('#single_cal3').daterangepicker({
			  singleDatePicker: true,
			  singleClasses: "picker_3"
			}, function(start, end, label) {
			  console.log(start.toISOString(), end.toISOString(), label);
			});
			$('#single_cal4').daterangepicker({
			  singleDatePicker: true,
			  singleClasses: "picker_4"
			}, function(start, end, label) {
			  console.log(start.toISOString(), end.toISOString(), label);
			});
  
  
		}		
		 
		function init_daterangepicker_reservation() {
	      
			if( typeof ($.fn.daterangepicker) === 'undefined'){ return; }
			console.log('init_daterangepicker_reservation');
		 
			$('#reservation').daterangepicker(null, function(start, end, label) {
			  console.log(start.toISOString(), end.toISOString(), label);
			});

			$('#reservation-time').daterangepicker({
			  timePicker: true,
			  timePickerIncrement: 30,
			  locale: {
				format: 'MM/DD/YYYY h:mm A'
			  }
			});
	
		}
	   
	   /* SMART WIZARD */
		
		function init_SmartWizard() {
			
			if( typeof ($.fn.smartWizard) === 'undefined'){ return; }
			console.log('init_SmartWizard');
			
			$('#wizard').smartWizard();

			$('#wizard_verticle').smartWizard({
			  transitionEffect: 'slide'
			});

			$('.buttonNext').addClass('btn btn-success');
			$('.buttonPrevious').addClass('btn btn-primary');
			$('.buttonFinish').addClass('btn btn-default');
			
		};
	   
	   
	  /* VALIDATOR */

	  function init_validator () {
		 
		if( typeof (validator) === 'undefined'){ return; }
		console.log('init_validator'); 
	  
	  // initialize the validator function
      validator.message.date = 'not a real date';

      // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
      $('form')
        .on('blur', 'input[required], input.optional, select.required', validator.checkField)
        .on('change', 'select.required', validator.checkField)
        .on('keypress', 'input[required][pattern]', validator.keypress);

      $('.multi.required').on('keyup blur', 'input', function() {
        validator.checkField.apply($(this).siblings().last()[0]);
      });

      $('form').submit(function(e) {
        e.preventDefault();
        var submit = true;

        // evaluate the form using generic validaing
        if (!validator.checkAll($(this))) {
          submit = false;
        }

        if (submit)
          this.submit();

        return false;
		});
	  
	  };
	   
	  	/* PNotify */
			
		function init_PNotify() {
			
			if( typeof (PNotify) === 'undefined'){ return; }
			console.log('init_PNotify');
			
			new PNotify({
			  title: "PNotify",
			  type: "info",
			  text: "Welcome. Try hovering over me. You can click things behind me, because I'm non-blocking.",
			  nonblock: {
				  nonblock: true
			  },
			  addclass: 'dark',
			  styling: 'bootstrap3',
			  hide: false,
			  before_close: function(PNotify) {
				PNotify.update({
				  title: PNotify.options.title + " - Enjoy your Stay",
				  before_close: null
				});

				PNotify.queueRemove();

				return false;
			  }
			});

		}; 
	   
	   
	   
	   
		

		
		
	   	
		/* DATA TABLES */
			
			function init_DataTables() {
				
				//console.log('run_datatables');
				
				if( typeof ($.fn.DataTable) === 'undefined'){ return; }
				//console.log('init_DataTables');
				
				var handleDataTableButtons = function() {
				  if ($("#datatable-buttons").length) {
					$("#datatable-buttons").DataTable({
					  dom: "Bfrtip",
					  buttons: [
						{
						  extend: "copy",
						  className: "btn-sm"
						},
						{
						  extend: "csv",
						  className: "btn-sm"
						},
						{
						  extend: "excel",
						  className: "btn-sm"
						},
						{
						  extend: "pdfHtml5",
						  className: "btn-sm"
						},
						{
						  extend: "print",
						  className: "btn-sm"
						},
					  ],
					  responsive: true
					});
				  }
				};

				TableManageButtons = function() {
				  "use strict";
				  return {
					init: function() {
					  handleDataTableButtons();
					}
				  };
				}();

				$('#datatable').dataTable();

				$('#datatable-keytable').DataTable({
				  keys: true
				});

				$('#datatable-responsive').DataTable();

				$('#datatable-scroller').DataTable({
				  ajax: "js/datatables/json/scroller-demo.json",
				  deferRender: true,
				  scrollY: 380,
				  scrollCollapse: true,
				  scroller: true
				});

				$('#datatable-fixed-header').DataTable({
				  fixedHeader: true
				});

				var $datatable = $('#datatable-checkbox');

				$datatable.dataTable({
				  'order': [[ 1, 'asc' ]],
				  'columnDefs': [
					{ orderable: false, targets: [0] }
				  ]
				});
				$datatable.on('draw.dt', function() {
				  $('checkbox input').iCheck({
					checkboxClass: 'icheckbox_flat-green'
				  });
				});

				TableManageButtons.init();
				
			};
/* init_datepicker */
	function init_datepicker(){	
		//if(typeof (datepicker)  === 'undefined'){ return; }
		$(document).ready(function(){
			//$.fn.datepicker.defaults.format = "dd-mm-yyyy";		    
		    $('.datepicker').datepicker({
		        language: 'id',
		        weekStart: 1,
		        todayBtn:  1,
		        autoclose: 1,
		        todayHighlight: 1,
		        todayBtn: 'linked'        
		    });		       
		}); 
	};
/* ajakk chain selected */
	function init_chain_selected(){

		$(document).ready(function(){
			var baseull = $("#id_url").val();
		    $("#provinsi").change(function (){
	          var url = baseull+"index.php/skp/add_ajax_kab/"+$(this).val();
	          $('#kabupaten').load(url);
	          return false;
		    })  
			$("#kabupaten").change(function (){
		        var url = baseull+"index.php/skp/add_ajax_kec/"+$(this).val();
		        $('#kecamatan').load(url);
		        return false;
		    })  
				$("#kecamatan").change(function (){
		        var url =  baseull+"index.php/skp/add_ajax_des/"+$(this).val();
		        $('#desa').load(url);
		        return false;
		    })
		});
	};
/*form_custom input*/		
	/*
	$(document).ready(function(){      
      $("#form_custom").submit(function(){
        var tgl2 = $("#tgl2").val();
        var tgl1 = $("#tgl1").val();      
        if(tgl1!=''){
          if (tgl2!='') {        
            $.ajax({
              type  :'POST',
              url   : $(this).attr("action"),
              data    : $(this).serialize(),
              beforeSend:function(){
                $("#proses_data").show();                               
                  },          
              success:function(xhr){
                $("#proses_data").hide();
                $("#ajax-pulang").show();            
                $("#ajax-pulang").html(xhr);
              }             
            });
          }else{
          swal("Anda belum Mengisi Tanggal kedua");
          }
          return false;            
        }else{
          swal("Anda belum Mengisi Tanggal Pertama");
        }
        return false;
      });        
    });  		
	*/
		
	   
	   
	$(document).ready(function() {
		init_sidebar();
		init_InputMask();
		init_parsley();
		init_daterangepicker();
		init_daterangepicker_right();
		init_daterangepicker_single_call();
		init_daterangepicker_reservation();
		init_SmartWizard();
		init_validator();
		init_DataTables();
		init_PNotify();
		init_autosize();
		init_datepicker();
		init_chain_selected();
	});	
	

