<!-- latest jquery-->
<script src="{{ url('frontend') }}/assets/js/jquery-3.3.1.min.js"></script>
<!-- slick js-->
<script src="{{ url('frontend') }}/assets/js/slick.js"></script>
<!-- tool tip js -->
<script src="{{ url('frontend') }}/assets/js/tippy-popper.min.js"></script>
<script src="{{ url('frontend') }}/assets/js/tippy-bundle.iife.min.js"></script>
<!-- popper js-->
<script src="{{ url('frontend') }}/assets/js/popper.min.js"></script>
<!-- Timer js-->
<script src="{{ url('frontend') }}/assets/js/menu.js"></script>
<!-- father icon -->
<script src="{{ url('frontend') }}/assets/js/feather.min.js"></script>
<script src="{{ url('frontend') }}/assets/js/feather-icon.js"></script>
<!-- Bootstrap js-->
<script src="{{ url('frontend') }}/assets/js/bootstrap.js"></script>
<!-- Bootstrap js-->
<script src="{{ url('frontend') }}/assets/js/bootstrap-notify.min.js"></script>
<!-- FancyBox Zoom Image -->
<script src="{{ url('frontend') }}/assets/fancybox.umd.js"></script>
<!-- Theme js-->
<script src="{{ url('frontend') }}/assets/js/script.js"></script>
<script src="{{ url('frontend') }}/assets/js/modal.js"></script>

{{-- site scripts --}}
<script src="{{ url('frontend') }}/assets/scripts/autocomplete.js"></script>

{{-- start auto complete --}}
<script>
    $(document).ready(function() {
        let rt = "{{ route('search') }}";
        let token = "{{ csrf_token() }}";

        $("#search").on("keyup", function() {
            var query = $(this).val();
            $.ajax({
                url: rt,

                type: "GET",

                data: {
                    search: query,
                    _token: token,
                },

                success: function(data) {
                    $("#product_list").show().html(data);
                },
            });
            // end of ajax call
        });

        $(document).on("click", "li.searchItems", function() {
            var value = $(this).text();
            $("#search").val(value);
            $("#product_list").html("");
        });

        $(document).mouseup((e) => {
            if (
                !$("#product_list").is(e.target) &&
                $("#product_list").has(e.target).length === 0
            ) {
                // ... nor a descendant of the container
                $("#product_list").hide();
            }
        });
    });
</script>
{{-- end auto complete --}}
