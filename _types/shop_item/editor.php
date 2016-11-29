<?php 
/*
#############################################################################################
Editor values for section "Shop Item" for Typesetter CMS developer plugin - 'Custom Sections'
Author: J. Krausz and a2exfr
Date: 2016-11-28
Version 1.0b1
#############################################################################################
*/


defined('is_running') or die('Not an entry point...');

$editor = array(
  'custom_script' => false, // use a custom editor Javascript for this section type?
  'custom_css' =>    false, // use a custom editor CSS for this section type?

   /*---------------------------------------------*/
   /*    If both values above are set to false,   */
   /*         WE USE THE UNIVERSAL EDITOR         */
   /*     (see /universal_editor/edit.js/css)     */
   /*                                             */
   /* The universal editor only needs definitions */
   /* for the controls of the used values.        */
   /*                                             */
   /* This demo 'shop_item' section makes use     */
   /* of all currently available control types.   */
   /*                                             */
   /* More will follow...                         */
   /*---------------------------------------------*/
   
  'controls' => array( 
  
    // the controls array keys must match the section's values

    // value 'image' --start
    'image' => array(
      'label' => 'Select Image',
      'control_type' => 'finder-select',
      'attributes' => array(),
      'on' => array(
        // event handlers will be bound to the associated hidden input, not the button!
      ),
    ), 
    // value 'image' --end


    // value 'show_badge' --start
    'show_badge' => array(
      'label' => 'Show Badge',
      'control_type' => 'checkbox',
      'attributes' => array(),
      'on' => array(),
    ), 
    // value 'show_badge' --end


    // value 'badge_position' --start
    'badge_position' => array(
      'label' => 'Badge Position',
      'control_type' => 'radio-group',
      'radio-buttons' => array( 
        // radio value => radio label
        'top-left' => 'top left',
        'top-right' => 'top right',
        'bottom-left' => 'bottom left',
        'bottom-right' => 'bottom right',
      ),
      'attributes' => array(),
      'on' => array(),
    ), 
    // value 'badge_position' --end


    // value 'badge_color' --start
    'badge_color' => array(
      'label' => 'Badge Color',
      'control_type' => 'color',
      'attributes' => array(
        'placeholder' => '#123ABC',
      ),
      'on' => array(),
    ), 
    // value 'badge_color' --end


    // value 'title' --start
    'title' => array(
      'label' => 'Title',
      'control_type' => 'text',
      'attributes' => array(
        // 'class' => '',
        'placeholder' => 'Item Title',
        // 'pattern' => '', // regex for validation
      ),
      'on' => array(
        'focus' => 'function(){ $(this).select(); }',
      ),
    ), 
    // value 'title' --end


    // value 'description' --start
    /* 
    'description' => array(
      'label' => 'Description',
      'control_type' => 'textarea',
      'attributes' => array(
        // 'class' => '',
        'placeholder' => 'A short description',
      ),
      'on' => array(),
    ), 
    */
    // value 'description' --end


    // value 'description' --start
    'description' => array(
      'label' => 'Edit Description',
      'control_type' => 'ck_editor',
      'attributes' => array(
        // 'class' => '',
        // 'placeholder' => 'A short description',
      ),
      'on' => array(),
    ), 
    // value 'description' --end


    // value 'price' --start
    'price' => array(
      'label' => 'Price',
      'control_type' => 'number',
      'attributes' => array(
        // 'class' => '',
        'step' => 'any',
        'placeholder' => '00.00',
        // 'pattern' => '', // regex for validation
      ),
      'on' => array(
        'focus' => 'function(){ $(this).select(); }',
      ),
    ), 
    // value 'price' --end


    // value 'available' --start
    'available' => array(
      'label' => 'Available',
      'control_type' => 'select',
      'options' => array( 
        // option value => option text
        'in stock' => 'in stock',
        'available short-term' => 'short-term', 
        'available long-term' => 'long-term', 
        'available on request' => 'on request', 
        'sold out' => "sold out", 
      ),
      'attributes' => array(),
      'on' => array(),
    ), 
    // value 'available' --end

  ),
);