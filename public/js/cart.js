// document.addEventListener("DOMContentLoaded", function () {
//     const cartButtons = document.querySelectorAll(".add-to-cart-btn");

//     cartButtons.forEach((btn) => {
//         btn.addEventListener("click", function (e) {
//             e.preventDefault();
//             const productId = this.dataset.id;

//             fetch(`/cart/add/${productId}`, {
//                 method: "POST",
//                 headers: {
//                     "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
//                     "Content-Type": "application/json",
//                 },
//                 body: JSON.stringify({ quantity: 1 }),
//             })
//                 .then((res) => res.json())
//                 .then((data) => {
//                     if (data.success) {
//                         alert("🛒 Sản phẩm đã được thêm vào giỏ hàng!");
//                     } else {
//                         alert("❌ Lỗi: " + data.message);
//                     }
//                 })
//                 .catch((err) => console.error("Cart AJAX error:", err));
//         });
//     });
// });
