// $(document).ready(function () {
//   var base_url = window.location.origin;

//   var host = window.location.host;

//   // var local = "{{ app()->getLocal() }}";

//   // console.log(local);
//   console.log(base_url);
//   console.log(host);

//   let rt = "{{ route('search') }}";
//   let token = "{{ csrf_token() }}";

//   console.log(rt);
//   $("#search").on("keyup", function () {
//     var query = $(this).val();
//     $.ajax({
//       url: rt,

//       type: "GET",

//       data: {
//         search: query,
//         _token: token,
//       },

//       success: function (data) {
//         $("#product_list").show().html(data);
//       },
//     });
//     // end of ajax call
//   });

//   $(document).on("click", "li.searchItems", function () {
//     var value = $(this).text();
//     $("#search").val(value);
//     $("#product_list").html("");
//   });

//   $(document).mouseup((e) => {
//     if (
//       !$("#product_list").is(e.target) &&
//       $("#product_list").has(e.target).length === 0
//     ) {
//       // ... nor a descendant of the container
//       $("#product_list").hide();
//     }
//   });
// });
