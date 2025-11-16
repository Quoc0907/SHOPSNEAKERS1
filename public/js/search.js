
// $(document).ready(function() {

//     $('#search-product').keyup(function() {
//         let query = $(this).val();
//         if (query.length > 0) {
//             $.ajax({
//                 url: "{{ route('product.search.ajax') }}",
//                 method: "GET",
//                 data: { q: query },
//                 success: function(data) {
//                     let html = '<ul style="list-style:none; padding:0; margin:0; background:#fff; border:1px solid #ccc;">';
//                     if (data.length > 0) {
//                         data.forEach(function(item) {
//                             html += `<li style="padding:5px 10px; cursor:pointer;" 
//                                         onclick="window.location.href='/product/${item.MASP}'">
//                                         ${item.TENSP}
//                                      </li>`;
//                         });
//                     } else {
//                         html += '<li style="padding:5px 10px;">No products found</li>';
//                     }
//                     html += '</ul>';
//                     $('#search-suggest').fadeIn().html(html);
//                 }
//             });
//         } else {
//             $('#search-suggest').fadeOut();
//         }
//     });

//     // Click ra ngoài ẩn gợi ý
//     $(document).on('click', function(e) {
//         if (!$(e.target).closest('#search-product').length) {
//             $('#search-suggest').fadeOut();
//         }
//     });
// });