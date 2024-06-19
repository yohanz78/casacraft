function getDataByUrlKey() {
    let windowUrl = $(location).attr('href');
    let windowUrlKey = windowUrl.replace(/\/\s*$/, "").split('/').pop();
    let url = baseUrl+'/api/furniture/'+windowUrlKey;

    axios.get(url, {}, apiHeaders)
    .then(function (response) {
        console.log('[DATA] response..', response.data);
        let template = '';

        $('.product-img-main-href').attr('href', response.data.image);
        $('.product-img-main-src').attr('src', response.data.image);
        $('#product-name').html(response.data.name);
        $('#product-price').html('IDR '+parseFloat(response.data.price).toLocaleString());
        $('#product-description').html(response.data.description);
        $('#product-category').html(response.data.category);
        $('#product-vendor').html(response.data.vendor);

        // Review
        let stars = randomIntFromInterval(1,5);
        template = '';
        for (let index = 0; index < 5; index++) {
            template += `<i class="`+(index<stars?'yellow':'')+` icon_star"></i>`;
        }
        $('#product-review-stars').html(template);
        $('#product-review-body-count').html(randomIntFromInterval(1,1000)+' customer review');

        // Stock status
        let stockStatus = randomIntFromInterval(0,1);
        $('#product-status-stock').addClass(stockStatus?'in-stock':'out-of-stock');
        $('#product-status-stock').html(stockStatus?'<p>Available: <span>In stock</span></p>':'<p>Available: <span>Out of stock</span></p>');
        if (!stockStatus) {
            $('.product-add-to-cart').hide();
            $('.product-add-to-cart-is-disabled').show();
        }

    }).catch(function (error) {
        console.log('[ERROR] response..', error.code)
        if (error.code == "ERR_BAD_REQUEST") {
            Swal.fire({
                position: "top-end",
                icon: "warning",
                title: "Oh no...",
                html: "The products you are looking for were not found",
                showConfirmButton: false,
                timer: 5000
            });
        } else {
            Swal.fire({
                icon: 'error',
                width: 600,
                title: "Error",
                html: error.message,
                confirmButtonText: 'Yes',
            });
        }
    });
}

$(function () {
    getDataByUrlKey();
});
