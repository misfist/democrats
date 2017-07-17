(function($) {

  /**
   * Variables
   */
  var contentEl = $( '#main .results' );

  var buttonContainer = $( '#infinite-scroll' );
  var buttonContent = '<button class="btn btn-primary">' + democrats_load_more.button_text + '</button>';
  buttonContainer.append(buttonContent);
  var buttonEl = $( '#infinite-scroll button' );

  var page = 2;
  var loading = false;

  /**
   * Load More Event
   */
  buttonEl.click(function(event) {
    event.preventDefault();

    if( ! loading ) {
      loading = true;

      var args = {
        query:  democrats_load_more.query
      };

      get_posts(args);
    }

  });

  /**
   * Get Posts Function
   * @param  obj args
   * @return obj response
   */
  function get_posts(args) {

    $.ajax({
      url: democrats_load_more.ajax_url,
      data: {
        action: 'do_democrats_load_more_posts',
        nonce: democrats_load_more.nonce,
        page: page,
        query: args.query
      },
      type: 'POST'
    })
    .success(function(response, textStatus, XMLHttpRequest) {
      //console.log( 'response', response, args);
      contentEl.append( response.content );

      //Increment pager
      page++;
      loading = false;
      buttonEl.attr( 'data-paged', page );

      if( response.current_page >= response.max_pages ) {
        buttonEl.attr( 'disabled', 'disabled' );
      }

    })
    .error(function(response) {
      //console.log('error', response);
    })
    .complete(function(response) {
      //console.log(response);
    });

  }


})(jQuery);
