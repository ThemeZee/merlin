/**
 * Customizer Communicator
 */
( function ( exports, $ ) {
	"use strict";

	var api = wp.customize, OldPreviewer;

	// Custom Customizer Previewer class (attached to the Customize API)
	api.myCustomizerPreviewer = {
		// Init
		init: function () {
			var self = this; // Store a reference to "this" in case callback functions need to reference it
			
			var status = api.panel( 'leeway_options_panel' ).expanded();
			
			console.log(status);
			
			api.panel( 'leeway_options_panel' ).expand({ completeCallback: function () {
				api.section( 'leeway_section_slider' ).expand(); // show after nav hides completely
			} });
			
		}
	};

	/**
	 * Capture the instance of the Preview since it is private (this has changed in WordPress 4.0)
	 *
	 * @see https://github.com/WordPress/WordPress/blob/5cab03ab29e6172a8473eb601203c9d3d8802f17/wp-admin/js/customize-controls.js#L1013
	 */
	OldPreviewer = api.Previewer;
	api.Previewer = OldPreviewer.extend( {
		initialize: function( params, options ) {
			// Store a reference to the Previewer
			api.myCustomizerPreviewer.preview = this;

			// Call the old Previewer's initialize function
			OldPreviewer.prototype.initialize.call( this, params, options );
		}
	} );

	// Document Ready
	$( function() {
		// Initialize our Previewer
		api.myCustomizerPreviewer.init();
	} );
} )( wp, jQuery );