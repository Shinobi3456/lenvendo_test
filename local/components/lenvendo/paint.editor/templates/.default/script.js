$(document).ready(function()
{
    $("#paintCanvas").jqScribble();
    $('#saveimg').on('click', function(){
        $("#paintCanvas").data("jqScribble").save(function(imageData)
        {
            if(confirm("Сохранить данные?"))
            {
                var url = window.location.href;

                var data = {
                    canvasFile:imageData,
                    passw : $("#passw").val()
                };

                $.post(url, data, function(response)
                {
                    if(response.ELEMENT_ID)  {
                        document.location.href =  '/paint/editor/' + response.ELEMENT_ID + '/';
					} else {
						alert(response.MESSAGE);
					}
                });
            }
        });
    });

    $('#clear').on('click', function(){
        $("#paintCanvas").data("jqScribble").clear();
    });
    if(src !== '')$("#paintCanvas").data("jqScribble").update({backgroundImage: src});

});