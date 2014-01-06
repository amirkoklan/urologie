<?php
/**
 * File Name: localized-js.php
 */
?>
<script type="text/javascript">
    jQuery(document).ready(function(e) {

        $ = jQuery;

        /*-----------------------------------------------------------------------------------*/
        /*	Responsive Nav
        /*-----------------------------------------------------------------------------------*/
        var $mainNav    = $('.main-nav .menu-div').children('ul');
        var optionsList = '<option value="" selected><?php _e("Go to...", 'framework'); ?></option>';

        $mainNav.find('li').each(function() {
            var $this   = $(this),
                    $anchor = $this.children('a'),
                    depth   = $this.parents('ul').length - 1,
                    indent  = '';
            if( depth ) {
                while( depth > 0 ) {
                    indent += ' - ';
                    depth--;
                }
            }
            optionsList += '<option value="' + $anchor.attr('href') + '">' + indent + ' ' + $anchor.text() + '</option>';
        }).end()
                .after('<select class="responsive-nav">' + optionsList + '</select>');

        $('.responsive-nav').on('change', function() {
            window.location = $(this).val();
        });



        /*----------------------------------------------------------------------------------*/
        /*	Form AJAX validation and submition
        /*  Validation Plugin : http://bassistance.de/jquery-plugins/jquery-plugin-validation/
        /*	Form Ajax Plugin : http://www.malsup.com/jquery/form/
        /*---------------------------------------------------------------------------------- */
        if( jQuery().validate ){

            // Contact Options
            var contact_options = {
                target: '#message-sent',
                beforeSubmit: function(){
                    $('#contact-loader').fadeIn('fast');
                    $('#message-sent').fadeOut('fast');
                },
                success: function(responseText, statusText, xhr, $form){

                    $('#contact-loader').fadeOut('fast');
                    $('#message-sent').fadeIn('fast');

                    if( responseText == "<?php _e("Wrong Code!", 'framework'); ?>" )
                    {
                        // wrong code
                    }
                    else
                    {
                        $('#contact-form').resetForm();
                    }
                }
            };

            // Contact Form AJAX Function
            $("#contact-form").validate({
                errorLabelContainer: $("#contact-form div.error-container"),
                submitHandler: function(form) {
                    $(form).ajaxSubmit(contact_options);
                }
            });


            // Appointment Form Options
            var appointment_options = {
                target: '#apo-message-sent',
                beforeSubmit: function(){
                    $('#apo-loader').fadeIn('fast');
                    $('#apo-message-sent').fadeOut('fast');
                },
                success: function(responseText, statusText, xhr, $form){

                    $('#apo-loader').fadeOut('fast');
                    $('#apo-message-sent').fadeIn('fast');

                    if( responseText == "<?php _e("Wrong Code!", 'framework'); ?>" )
                    {
                        // wrong code
                    }
                    else
                    {
                        $('#appoint-form').resetForm();
                    }

                }
            };


            // Appointment Form AJAX Function
            $("#appoint-form").validate({
                errorLabelContainer: $("#appoint-form .error-container"),
                submitHandler: function(form) {
                    $(form).ajaxSubmit(appointment_options);
                }
            });

            // Newsletter Form
            $('#newsletter').validate({
                errorLabelContainer: $("#newsletter .error-container")
            });

        }






    });

</script>
