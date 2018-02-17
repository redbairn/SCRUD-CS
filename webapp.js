$(document).ready(function(){
  // On page load: datatable
  var table_sensitivities = $('#table_sensitivities').dataTable({
    "ajax": "data.php?job=get_sensitivities",
    "columns": [
		{ "data": "date_created",  "sClass": "datatime"},
		{ "data": "date_updated",  "sClass": "datatime"},
		{ "data": "sensitivity_val", "sClass": "integer"},
		{ "data": "kpd", "sClass": "integer" },
		{ "data": "kills",      "sClass": "integer" },
		{ "data": "deaths",     "sClass": "integer" },
		{ "data": "headshot",     "sClass": "integer" },
		{ "data": "hpk",     "sClass": "integer" },
		{ "data": "accuracy",     "sClass": "integer" },
		{ "data": "map_played" },
		{ "data": "game" },
		{ "data": "comment" },
		{ "data": "functions",      "sClass": "functions" }
    ],
    "aoColumnDefs": [
      { "bSortable": false, "aTargets": [-1] }
    ],
    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
    "oLanguage": {
      "oPaginate": {
        "sFirst":       " ",
        "sPrevious":    " ",
        "sNext":        " ",
        "sLast":        " ",
      },
      "sLengthMenu":    "Records per page: _MENU_",
      "sInfo":          "Total of _TOTAL_ records (showing _START_ to _END_)",
      "sInfoFiltered":  "(filtered from _MAX_ total records)"
    }
  });
  
  // On page load: form validation
  jQuery.validator.setDefaults({
    success: 'valid',
    errorPlacement: function(error, element){
      error.insertBefore(element);
    },
    highlight: function(element){
      $(element).parent('.field_container').removeClass('valid').addClass('error');
    },
    unhighlight: function(element){
      $(element).parent('.field_container').addClass('valid').removeClass('error');
    }
  });
  var form_sensitivity = $('#form_sensitivity');
  form_sensitivity.validate();

  // Show message
  function show_message(message_text, message_type){
    $('#message').html('<p>' + message_text + '</p>').attr('class', message_type);
    $('#message_container').show();
    if (typeof timeout_message !== 'undefined'){
      window.clearTimeout(timeout_message);
    }
    timeout_message = setTimeout(function(){
      hide_message();
    }, 8000);
  }
  // Hide message
  function hide_message(){
    $('#message').html('').attr('class', '');
    $('#message_container').hide();
  }

  // Show loading message
  function show_loading_message(){
    $('#loading_container').show();
  }
  // Hide loading message
  function hide_loading_message(){
    $('#loading_container').hide();
  }

  // Show lightbox
  function show_lightbox(){
    $('.lightbox_bg').show();
    $('.lightbox_container').show();
  }
  // Hide lightbox
  function hide_lightbox(){
    $('.lightbox_bg').hide();
    $('.lightbox_container').hide();
  }
  // Lightbox background
  $(document).on('click', '.lightbox_bg', function(){
    hide_lightbox();
  });
  // Lightbox close button
  $(document).on('click', '.lightbox_close', function(){
    hide_lightbox();
  });
  // Escape keyboard key
  $(document).keyup(function(e){
    if (e.keyCode == 27){
      hide_lightbox();
    }
  });
  
  // Hide iPad keyboard
  function hide_ipad_keyboard(){
    document.activeElement.blur();
    $('input').blur();
  }

  // Add sensitivity button
  $(document).on('click', '#add_sensitivity', function(e){
    e.preventDefault();
    $('.lightbox_content h2').text('Add sensitivity');
    $('#form_sensitivity button').text('Add sensitivity');
    $('#form_sensitivity').attr('class', 'form add');
    $('#form_sensitivity').attr('data-id', '');
    $('#form_sensitivity .field_container label.error').hide();
    $('#form_sensitivity .field_container').removeClass('valid').removeClass('error');
    $('#form_sensitivity #sensitivity_val').val('');
	$('#form_sensitivity #kpd').val('');
	$('#form_sensitivity #kills').val('');
	$('#form_sensitivity #deaths').val('');
	$('#form_sensitivity #headshot').val('');
	$('#form_sensitivity #hpk').val('');
	$('#form_sensitivity #accuracy').val('');
	$('#form_sensitivity #map_played').val('');
	$('#form_sensitivity #game').val('');
	$('#form_sensitivity #comment').val('');
    show_lightbox();
  });

  // Add sensitivity submit form
  $(document).on('submit', '#form_sensitivity.add', function(e){
    e.preventDefault();
    // Validate form
    if (form_sensitivity.valid() == true){
      // Send sensitivity information to database
      hide_ipad_keyboard();
      hide_lightbox();
      show_loading_message();
      var form_data = $('#form_sensitivity').serialize();
      var request   = $.ajax({
        url:          'data.php?job=add_sensitivity',
        cache:        false,
        data:         form_data,
        dataType:     'json',
        contentType:  'application/json; charset=utf-8',
        type:         'get'
      });
      request.done(function(output){
        if (output.result == 'success'){
          // Reload datable
          table_sensitivities.api().ajax.reload(function(){
            hide_loading_message();
            var sensitivity_val = $('#sensitivity_val').val();
            show_message("Sensitivity '" + sensitivity_val + "' added successfully.", 'success');
          }, true);
        } else {
          hide_loading_message();
          show_message('Add request failed', 'error');
        }
      });
      request.fail(function(jqXHR, textStatus){
        hide_loading_message();
        show_message('Add request failed: ' + textStatus, 'error');
      });
    }
  });

  // Edit sensitivity button
  $(document).on('click', '.function_edit a', function(e){
    e.preventDefault();
    // Get sensitivity information from database
    show_loading_message();
    var id      = $(this).data('id');
    var request = $.ajax({
      url:          'data.php?job=get_sensitivity',
      cache:        false,
      data:         'id=' + id,
      dataType:     'json',
      contentType:  'application/json; charset=utf-8',
      type:         'get'
    });
    request.done(function(output){
      if (output.result == 'success'){
        $('.lightbox_content h2').text('Edit sensitivity');
        $('#form_sensitivity button').text('Edit sensitivity');
        $('#form_sensitivity').attr('class', 'form edit');
        $('#form_sensitivity').attr('data-id', id);
        $('#form_sensitivity .field_container label.error').hide();
        $('#form_sensitivity .field_container').removeClass('valid').removeClass('error');
        $('#form_sensitivity #sensitivity_val').val(output.data[0].sensitivity_val);
        $('#form_sensitivity #kpd').val(output.data[0].kpd);
        $('#form_sensitivity #kills').val(output.data[0].kills);
        $('#form_sensitivity #deaths').val(output.data[0].deaths);
		$('#form_sensitivity #headshot').val(output.data[0].headshot);
		$('#form_sensitivity #hpk').val(output.data[0].hpk);
		$('#form_sensitivity #accuracy').val(output.data[0].accuracy);
		$('#form_sensitivity #map_played').val(output.data[0].map_played);
        $('#form_sensitivity #game').val(output.data[0].game);
		$('#form_sensitivity #comment').val(output.data[0].comment);
        hide_loading_message();
        show_lightbox();
      } else {
        hide_loading_message();
        show_message('Information request failed', 'error');
      }
    });
    request.fail(function(jqXHR, textStatus){
      hide_loading_message();
      show_message('Information request failed: ' + textStatus, 'error');
    });
  });
  
  // Edit sensitivity submit form
  $(document).on('submit', '#form_sensitivity.edit', function(e){
    e.preventDefault();
    // Validate form
    if (form_sensitivity.valid() == true){
      // Send sensitivity information to database
      hide_ipad_keyboard();
      hide_lightbox();
      show_loading_message();
      var id        = $('#form_sensitivity').attr('data-id');
      var form_data = $('#form_sensitivity').serialize();
      var request   = $.ajax({
        url:          'data.php?job=edit_sensitivity&id=' + id,
        cache:        false,
        data:         form_data,
        dataType:     'json',
        contentType:  'application/json; charset=utf-8',
        type:         'get'
      });
      request.done(function(output){
        if (output.result == 'success'){
          // Reload datable
          table_sensitivities.api().ajax.reload(function(){
            hide_loading_message();
            var sensitivity_val = $('#sensitivity_val').val();
            show_message("Sensitivity '" + sensitivity_val + "' edited successfully.", 'success');
          }, true);
        } else {
          hide_loading_message();
          show_message('Edit request failed', 'error');
        }
      });
      request.fail(function(jqXHR, textStatus){
        hide_loading_message();
        show_message('Edit request failed: ' + textStatus, 'error');
      });
    }
  });
  
  // Delete sensitivity
  $(document).on('click', '.function_delete a', function(e){
    e.preventDefault();
    var sensitivity_val = $(this).data('name');
    if (confirm("Are you sure you want to delete '" + sensitivity_val + "'?")){
      show_loading_message();
      var id      = $(this).data('id');
      var request = $.ajax({
        url:          'data.php?job=delete_sensitivity&id=' + id,
        cache:        false,
        dataType:     'json',
        contentType:  'application/json; charset=utf-8',
        type:         'get'
      });
      request.done(function(output){
        if (output.result == 'success'){
          // Reload datable
          table_sensitivities.api().ajax.reload(function(){
            hide_loading_message();
            show_message("Sensitivity '" + sensitivity_val + "' deleted successfully.", 'success');
          }, true);
        } else {
          hide_loading_message();
          show_message('Delete request failed', 'error');
        }
      });
      request.fail(function(jqXHR, textStatus){
        hide_loading_message();
        show_message('Delete request failed: ' + textStatus, 'error');
      });
    }
  });

});