<?php 
defined('is_running') or die('Not an entry point...');

/* ####################################################################################### */
/* ############################### DEMO TYPE "SINGLE EVENT" ############################## */
/* ############################## CUSTOM SECTION DEFINITION ############################## */
/* ####################################################################################### */
/* ###    $sectionRelativeCode == relative path to this folder, e.g. to load images    ### */
/* ###    $sectionCurrentValues == updated values array, empty for new section         ### */
/* ####################################################################################### */

$section = array(); 

// Required: default values for new sections
// We merge $sectionCurrentValues right here, so we can use $section['values'] for conditional rendering down * in the 'content' key.
$section['values'] = array_merge(array( 
  'image'           =>  $sectionRelativeCode . '/img/default_image.png', // control_type = finder-select
  'overlay_color'   => 'rgba(0, 60, 192, 0.5)', // control_type = color-picker
  'title'           => 'My Event', // control_type = text
  'subtitle'        => 'Save the Date!', // control_type = text
  // 'description'     => 'The annual Typesetter CMS developers conference!', // control_type = ck_editor
  'location_name'   => 'City Hall', // control_type = text
  'location_link'   => array( 
                        'url' => 'https://www.typesettercms.com',  // absolute URL, relative URL, mailto, #anchor
                        'target' => '_blank', // _blank, _self
                       ), // control_type = link-field

  'start_day'       => '2017-01-01', // control_type = datepicker
  'start_time'      => '20:00', // control_type = clockpicker
  'end_day'         => '2017-01-01', // control_type = datepicker
  'end_time'        => '22:30', // control_type = clockpicker

  'use_booking'     => '1', // control_type = checkbox
  'booking_text'    => 'Tickets', // control_type = text
  'booking_status'  => 'bookable', // control_type = select 
  'booking_link'    => array( 
                        'url' => 'https://www.typesettercms.com',  // absolute URL, relative URL, mailto, #anchor
                        'target' => '_blank', // _blank, _self
                       ), // control_type = link-field

  'readmore_text'     => 'Read more', // control_type = text
  'readmore_link'     => array( 
                        'url' => 'https://www.typesettercms.com/Plugins',  // absolute URL, relative URL, mailto, #anchor
                        'target' => '_blank', // _blank, _self
                       ), // control_type = link-field
), $sectionCurrentValues );


// Required: we should always include an attributes array, even when it's empty
$section['attributes'] = array(
  'class' => 'col-md-4 col-sm-6',  // optional: 'filetype-single_event' class will be added by the system
  // 'style' => '', // optional inline styles
);


// Required: Predefined section content
// use {{value key}} for simple value placeholders/replacements
// use $section['values']['xyz'], e.g. for conditional rendering * whole elements 

$section['content']  =  '<div class="single-event-box" style="background-image:url(\'{{image}}\');">';
//$section['content'] .=    '<img class="single-event-main-image" alt="Image of {{title}}" src="{{image}}" />';
$section['content'] .=    '<div class="single-event-overlay" style="background-color:{{overlay_color}};"></div>';

$section['content'] .=    '<div class="single-event-content">';
$section['content'] .=      '<h2 class="single-event-title text-center">{{title}}</h2>';
$section['content'] .=      '<h4 class="single-event-subtitle text-center">{{subtitle}}</h4>';

if( !empty($section['values']['location_link']['url']) ){
  $section['content'] .=      '<h5 class="single-event-location"><a href="{{location_link|url}}" target="{{location_link|target}}"><i class="fa fa-home"></i> {{location_name}}</a></h5>';
}else{
  $section['content'] .=      '<h5 class="single-event-location"><i class="fa fa-home"></i> {{location_name}}</h5>';
}

$day_prefixing = '';
$time_prefixing = '';

if( !empty($section['values']['start_day']) ){
  // calc date range from possible range of set inputs
  $start_date = $section['values']['start_day'] . ' ' . ( !empty($section['values']['start_time']) ? $section['values']['start_time'] : '00:00' );
  if( !empty($section['values']['end_day']) ){
    $end_date = $section['values']['end_day'] . ' ' . ( !empty($section['values']['end_time']) ? $section['values']['end_time'] : '23:59' );
  }else{
    $end_date = $section['values']['start_day'] . ' 23:59';
  }
  $start_datetime = strtotime($start_date);
  $end_datetime = strtotime($end_date);

  //msg("start_date: " . pre($start_date));
  //msg("start_datetime: " . pre($start_datetime));
  //msg("end_date: " . pre($end_date));
  //msg("end_datetime: " . pre($end_datetime));

  // 'humanize' dates output
  $day_prefixing = 'on';
  if( !empty($section['values']['end_day']) && ($section['values']['start_day'] != $section['values']['end_day']) ){ 
    // both start day and end day are defined and not equal
    $day_prefixing = 'from-to';
  }
  if( !empty($section['values']['start_time']) ){
    $time_prefixing = 'at';
    if( !empty($section['values']['end_time']) ){ 
      // both start time and end time are defined
      $time_prefixing = 'from-until';
    }
  }

  global $config;
  $current_lang = $config['language']; // TODO: should be obteined from Multi-Language Manager's page language, if present

  // DATE/TIME FORMATTING, see http://php.net/manual/en/function.strftime.php

  $i18n = array(
    'en' => array(
      /* USA, default */
      'locale' =>      'en_US',
      'day_format' =>   '%a, %b %e %Y',  // used by strftime: gives Sun, Jan 1 2017
      'time_format' =>  '%l:%M%P',       // used by strftime: gives 7:30pm
      'on_day' =>       'on',
      'from_day' =>     'from',
      'to_day' =>       'to',
      'at_time' =>      'at',
      'from_time' =>    'from',
      'until_time' =>   'until',
    ),
    'de' => array(
      /* Germany, Austria */
      'locale' =>       'de_DE', 
      'day_format' =>   '%a, %e. %b %Y',  // used by strftime: gives So, 1. Jan 2017
      'time_format' =>  '%k:%M',        // used by strftime: gives 19:30
      'on_day' =>       'am',
      'from_day' =>     'vom',
      'to_day' =>       'bis',
      'at_time'=>       'um',
      'from_time' =>    'von',
      'until_time' =>   'bis',
    ),
  );

  $lang = !empty($i18n[$current_lang]) ? $i18n[$current_lang] : $i18n['en'];

  // msg("current_lang: " . $current_lang);
  // msg("lang: " . pre($lang));
  // msg("locale: " . pre($lang['locale']));

  // Usually, nowadays locales like en_US.UTF-8  or de_DE.UTF-8 work, depending on server OS, configuration and installed software
  // $setLoc = setlocale(LC_TIME, $lang['locale']);
  // if( \gp\tool::LoggedIn() && !$setLoc ){ 
  //  msg("setLocale() failed! The locale '" . $lang['locale'] . "' is probably not available on your server."); 
  // }

  $date_row = '<div class="single-event-date-row row" data-start-date="' . $start_datetime . '" data-end-date="' . $end_datetime . '">';

  $start_time_html  = !empty($section['values']['start_time']) ? '<span class="single-event-time">' . \intltime\strftime($lang['time_format'], $start_datetime) . '</span>'  : ''; 
  $end_time_html    = !empty($section['values']['end_time'])   ? '<span class="single-event-time">' . \intltime\strftime($lang['time_format'], $end_datetime) . '</span>'    : ''; 

  switch( $time_prefixing ){
    case 'at':
      $start_time_html = '<span class="single-event-at-time">' . $lang['at_time'] . '</span> ' . $start_time_html;
      break;
    case 'from-until':
      $start_time_html = '<span class="single-event-from-time">' . $lang['from_time'] . '</span> ' . $start_time_html;
      $end_time_html = '<span class="single-event-until-time">' . $lang['until_time'] . '</span> ' . $end_time_html;
      break;
  }

  switch( $day_prefixing ){
    case 'on':
      $date_row .=  '<div class="col-sm-6 single-event-on">';
      $date_row .=    '<p>';
      $date_row .=      '<span class="single-event-on-day">' . $lang['on_day'] . '</span> ';
      $date_row .=      '<span class="single-event-day">' . \intltime\strftime($lang['day_format'], $start_datetime) . '</span>';
      $date_row .=    '</p>';
      $date_row .=    '<p>';
      $date_row .=      $start_time_html . $end_time_html;
      $date_row .=    '</p>';
      $date_row .=  '</div>';
      break;

    case 'from-to':
      $date_row .=  '<div class="col-sm-6 single-event-from">';
      $date_row .=    '<p>';
      $date_row .=      '<span class="single-event-from-day">' . $lang['from_day'] . '</span> ';
      $date_row .=      '<span class="single-event-day">' . strftime($lang['day_format'], $start_datetime) . '</span>';
      $date_row .=    '</p>';
      $date_row .=    '<p>';
      $date_row .=      $start_time_html;
      $date_row .=    '</p>';
      $date_row .=  '</div>';
      $date_row .=  '<div class="col-sm-6 single-event-to">';
      $date_row .=    '<p>';
      $date_row .=      '<span class="single-event-to-day">' . $lang['to_day'] . '</span> ';
      $date_row .=      '<span class="single-event-day">' . strftime($lang['day_format'], $end_datetime) . '</span>';
      $date_row .=    '</p>';
      $date_row .=    '<p>';
      $date_row .=      $end_time_html;
      $date_row .=    '</p>';
      $date_row .=  '</div>';
      break;
  }
  $date_row .= '</div>';

  $section['content'] .= $date_row;
} // end if( !empty($section['values']['start_day'] )


// booking
if( $section['values']['use_booking'] == '1' ){
  $section['content'] .=      '<div class="single-event-booking-row row">';
  $section['content'] .=      '<span class="col-sm-6 single-event-booking-text">{{booking_text}}</span>';
  switch( $section['values']['booking_status'] ){
    case 'bookable':
    default:
      $section['content'] .=      '<a class="single-event-booking col-sm-6" href="{{booking_link|url}}" target="{{booking_link|target}}"><i class="fa fa-ticket"></i> {{booking_status}}</a>';
      break;
    case 'booked-out':
      $section['content'] .=      '<span class="single-event-booking col-sm-6"><i class="fa fa-ban"></i> {{booking_status}}</span>';
      break;
    case 'canceled':
      $section['content'] .=      '<span class="single-event-booking col-sm-6"><i class="fa fa-exclamation-triangle"></i> {{booking_status}}</span>';
      break;
  }
  $section['content'] .=      '</div>';
}

$section['content'] .=      '<a class="single-event-readmore-btn btn btn-info btn-block" href="{{readmore_link|url}}" target="{{readmore_link|target}}">';
$section['content'] .=        '{{readmore_text}} <span class="fa fa-angle-double-right">&zwnj;</span>';
$section['content'] .=      '</a>';
$section['content'] .=    '</div>'; // end of single-event-content
$section['content'] .=  '</div>';


/* ###################### */
/* ### end of content ### */
/* ###################### */


// Recommended: Section Label. If not defined, it will be generated from the folder name.
$section['gp_label'] = 'Single Event';

// Optional: Always process values - if set to true, content will always be generated by processing values, even when not logged-in.
// Using this option, sections may have dynamic content.
$section['always_process_values'] = false;

// Optional: Admin UI color label. This is solely used in the editor's section manager ('Page' mode)
$section['gp_color'] = '#0060C0';

// Optional: Loadable Components needed for rendering section to visitors, see https://github.com/Typesetter/Typesetter/blob/master/include/tool/Output/Combine.php#L111
$components = 'fontawesome,'; // comma separated string. If 'colorbox' is included \gp\tool::AddColorBox() will be called

// Ootional: Additional CSS and JS if needed
$css_files = array( 'style.css', ); // style.css must reside in this directory (_types/exent_box). Relative and absolute paths are also possible

// $style = 'body { background:red!important; }';

// $js_files = array( 'script.js', ); // script.js must reside in this directory (_types/exent_box). Relative and absolute paths are also possible.

// $javascript = 'var hello_world = "Hello World!";'; // this will add a global js variable 

// $jQueryCode = '$(".hello").on("click", function(){ alert("Click: " + hello_world); });';


/* ############################################################## */
/* ## EXAMPLES for JS to be executed when a section is updated ## */
/* ############################################################## */

/* Example for CurrenSections.onUpdate() function. 'this' refers to the section's jQuery object in the functions context: */
// $javascript = 'CustomSections = { onUpdate : function(){ console.log("CustomSections.onUpdate function called for ", $(this));} };'; 

/* Example for using the delegated CustomSection:updated event */
// $jQueryCode = '$(document).on("CustomSection:updated", "div.GPAREA", function(){ console.log("The event \"CustomSection:updated\" was triggered on section ", $(this)); });'; 

