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

    function checkEmail( o, n){
        var isEmailValid = false;
        $.ajax({
            // Action
            url: '_ajaxpostcommands.php',
            // Method
            type: 'POST',
            async: false,
            data: {
                // Get value
                emailAddress: $("input[name=emailAddress]").val(),
                action: "getEmail"
            },
            success:function(returnData){
                if(returnData === "false"){
                    isEmailValid = false;
                    o.addClass( "ui-state-error" );
                    updateTips( n + " has already been used with us");
                }
                else isEmailValid = returnData === "true";
            }
        });
        return isEmailValid;
    }

    function addUser() {
        var valid = true;

        valid = valid && checkLength( firstName, "First Name", 1, 100 );
        valid = valid && checkLength( lastName, "Last Name", 1, 100 );
        valid = valid && checkLength( gender, "Gender", 4, 6 );
        valid = valid && checkLength( address, "Address", 1, 100 );
        valid = valid && checkLength( emailAddress, "Email Address", 1, 100 );
        valid = valid && checkLength( personType, "Person Type", 1, 100 );


        valid = valid && checkRegexp( firstName, /^[a-z]([0-9a-z_\s])+$/i, "Username may consist of a-z, 0-9, underscores, spaces and must begin with a letter." );
        valid = valid && checkRegexp( lastName, /^[a-z]([0-9a-z_\s])+$/i, "Username may consist of a-z, 0-9, underscores, spaces and must begin with a letter." );
        valid = valid && checkRegexp( emailAddress, emailRegex, "eg. ui@jquery.com" );
        valid = valid && checkEmail( emailAddress,  "Email Address");

        if ( valid ) {
            allFields.removeClass( "ui-state-error" );
            updateTips( "" );
            $.ajax({
                // Action
                url: '_ajaxpostcommands.php',
                // Method
                type: 'POST',
                data: {
                    // Get value
                    firstName: $("input[name=firstName]").val(),
                    lastName: $("input[name=lastName]").val(),
                    gender: $("select[name=gender]").val(),
                    address: $("input[name=address]").val(),
                    emailAddress: $("input[name=emailAddress]").val(),
                    personType: $("input[name=personType]").val(),
                    action: "insert"
                },
                success:function(){
                    $("#person-table").load("loadPeopleTable.php");
                }
            });
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