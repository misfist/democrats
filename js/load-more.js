(function($) {

  /**
   * Variables
   */
  var contentEl = $( '#main .results' );

  var buttonContainer = $( '#infinite-scroll' );
  var buttonContent = '<button class="btn btn-primary">' + democrats_load_more.button_text + '</button>';
  buttonContainer.append(buttonContent);
  var buttonEl = $( '#infinite-scroll button' );

  var nextPage = 2;

  /**
   * Load More Event
   */
  buttonEl.click(function(event) {
    event.preventDefault();

    var $this = $( this );
    var data = $this[0].dataset;

    var args = {};

    args.posts_per_page =  democrats_load_more.posts_per_page;
    args.paged = nextPage;

    console.log( 'args', args );

    get_posts(args);

  });

  /**
   * Get Posts
   * @param  obj args
   * @return obj response
   */
  function get_posts(args) {

    $.ajax({
      url: democrats_load_more.ajax_url,
      data: {
        action: 'do_democrats_load_more_posts',
        nonce: democrats_load_more.nonce,
        args: args
      },
      type: 'POST'
    })
    .success(function(response, textStatus, XMLHttpRequest) {

      console.log( 'response', response );

      //If a paged request, append posts
      if( response.paged ) {
        contentEl.append( response.content );

        //Increment pager
        nextPage++;
        buttonEl.attr( 'data-paged', nextPage );

      }

      // Disable Load More
      // If there is only 1 page of posts or is last page, disable the button
      if( 1 === response.max_pages || response.max_pages <= response.paged ) {
        buttonEl.prop( 'disabled', true );
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
