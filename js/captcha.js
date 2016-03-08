$("#myForm").bind('blur keydown focusout', function(){ 

        var dataArray = $("#myForm").serializeArray(),
        dataObj = {};
        console.dir(dataArray); //require firebug
        //console.log(dataArray);

        $(dataArray).each(function(i, field){
          dataObj[field.name] = field.value;
        });

        var recaptcha = (dataObj['g-recaptcha-response']);

        if(recaptcha != "") {
                $( "#temp" ).remove();
        }       
    });

    $( ".register" ).click(function() {

        var dataArray = $("#myForm").serializeArray(),
            dataObj = {};
            console.dir(dataArray); //require firebug
            //console.log(dataArray);

        $(dataArray).each(function(i, field){
          dataObj[field.name] = field.value;
        });

        var recaptcha = (dataObj['g-recaptcha-response']);

        $( "#temp" ).remove();

            if(recaptcha == "") {
                $("#recaptcha").append('<label id="temp" style="color:red;line-height:normal;font-size: small;">This field is required.</label>');
            }

    });             

});