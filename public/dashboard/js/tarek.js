$(function() {

    /*   $('.modal').on('shown.bs.modal', function () {
        $('.modal').trigger('focus')
      }) */

    // Multiple images preview in browser
    var imagesPreview = function(input, placeToInsertImagePreview) {

        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                }

                reader.readAsDataURL(input.files[i]);
            }
        }

    };

    $('#gallery-photo-attachments').on('change', function() {
        imagesPreview(this, 'div.gallery_attachments');
    });

    $('#gallery-photo-geometric').on('change', function() {
        imagesPreview(this, 'div.gallery_geometric');
    });

});


/* $(document).ready(function() {

    $(".loading_tbn").hide();
    //$(".loading_tbn").css('display', 'none');
    $("form").submit(function() {

        $(".btn").hide();
        $(".loading_tbn").show();
    });

});
 */


$('.btn').on('click', function() {
    var $this = $(this);

    $this.button('loading');
    setTimeout(function() {
            $this.button('reset');

    }, 1000);
});


//select all checkboxes
$("#select_all").change(function(){  //"select all" change
    $(".checkbox").prop('checked', $(this).prop("checked")); //change all ".checkbox" checked status
});

//".checkbox" change
$('.checkbox').change(function(){
	//uncheck "select all", if one of the listed checkbox item is unchecked
    if(false == $(this).prop("checked")){ //if this item is unchecked
        $("#select_all").prop('checked', false); //change "select all" checked status to false
    }
	//check "select all" if all checkbox items are checked
	if ($('.checkbox:checked').length == $('.checkbox').length ){
		$("#select_all").prop('checked', true);
    }

});

