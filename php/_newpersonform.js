$( function() {
    var dialog, form,

        // From http://www.whatwg.org/specs/web-apps/current-work/multipage/states-of-the-type-attribute.html#e-mail-state-%28type=email%29
        emailRegex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/,
        firstName = $( "#firstName" ),
        lastName = $( "#lastName" ),
        gender = $( "#gender" ),
        address = $( "#address" ),
        emailAddress = $( "#emailAddress" ),
        personType = $( "#personType" ),
        allFields = $( [] ).add( firstName ).add( lastName ).add( gender ).add( address ).add( emailAddress ).add( personType ),
        tips = $( ".validateTips" );

    function updateTips( t ) {
        tips
            .text( t )
            .addClass( "ui-state-highlight" );
        setTimeout(function() {
            tips.removeClass( "ui-state-highlight", 1500 );
        }, 500 );
    }

    function checkLength( o, n, min, max ) {
        if ( o.val().length > max || o.val().length < min ) {
            o.addClass( "ui-state-error" );
            updateTips( "Length of " + n + " must be between " +
                min + " and " + max + "." );
            return false;
        } else {
            return true;
        }
    }

    function checkRegexp( o, regexp, n ) {
        if ( !( regexp.test( o.val() ) ) ) {
            o.addClass( "ui-state-error" );
            updateTips( n );
            return false;
        } else {
            return true;
        }
    }

    function addUser() {
        var valid = true;
        allFields.removeClass( "ui-state-error" );

        valid = valid && checkLength( firstName, "First Name", 1, 100 );
        valid = valid && checkLength( lastName, "Last Name", 1, 100 );
        valid = valid && checkLength( gender, "Gender", 4, 6 );
        valid = valid && checkLength( address, "Address", 1, 100 );
        valid = valid && checkLength( emailAddress, "Email Address", 1, 100 );
        valid = valid && checkLength( personType, "Person Type", 1, 100 );


        valid = valid && checkRegexp( firstName, /^[a-z]([0-9a-z_\s])+$/i, "Username may consist of a-z, 0-9, underscores, spaces and must begin with a letter." );
        valid = valid && checkRegexp( lastName, /^[a-z]([0-9a-z_\s])+$/i, "Username may consist of a-z, 0-9, underscores, spaces and must begin with a letter." );
        valid = valid && checkRegexp( emailAddress, emailRegex, "eg. ui@jquery.com" );

        if ( valid ) {
            dialog.dialog( "close" );
        }
        return valid;
    }

    dialog = $( "#dialog-form" ).dialog({
        autoOpen: false,
        height: 400,
        width: 350,
        modal: true,
        buttons: {
            "Create new person": addUser,
            Cancel: function() {
                dialog.dialog( "close" );
            }
        },
        close: function() {
            form[ 0 ].reset();
            allFields.removeClass( "ui-state-error" );
        }
    });

    form = dialog.find( "form" ).on( "submit", function( event ) {
        event.preventDefault();
        addUser();
    });

    $( "#create-user" ).button().on( "click", function() {
        dialog.dialog( "open" );
    });
} );