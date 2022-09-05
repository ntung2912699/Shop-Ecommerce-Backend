// get category for home page
$(document).ready(function(){
    $.ajax({
        type: "GET",
        url: 'http://127.0.0.1:8000/api/get-categories-client',
        dataType: "json",
        success: function(data){
            var jsonData = JSON.stringify(data)
            var result = JSON.parse(jsonData);
            for (i=0; i<result.categories.length; i++){
                $('#list_categories').append("<div class=\"col-lg-3 col-md-4 col-sm-6 pb-1\">\n" +
                    "<a class=\"text-decoration-none\" href=\"\">\n" +
                    "<div class=\"cat-item img-zoom d-flex align-items-center mb-4\">\n" +
                    "<div class=\"overflow-hidden\" style=\"width: 100px; height: 100px;\">\n" +
                    "<img class=\"img-fluid\" src=\"http://127.0.0.1:8000/"+result.categories[i].logo+"\" alt=\"\">\n" +
                    "</div>\n" +
                    "<div class=\"flex-fill pl-3\">\n" +
                    "<h6>"+ result.categories[i].name + "</h6>\n" +
                    "<small class=\"text-body\">" + result.categories[i].status +"</small>\n" +
                    "</div>\n" +
                    "</div>\n" +
                    "</a>\n" +
                    "</div>")
            }
        },
        error: function (xhr, status) {
            alert(status);
        }
    });
});

//get list products for home page
$(document).ready(function(){
    $.ajax({
        type: "GET",
        url: 'http://127.0.0.1:8000/api/get-product-clients',
        dataType: "json",
        success: function(response){
            var jsonData = JSON.stringify(response)
            var result = JSON.parse(jsonData);
            for (i=0; i<result.list_products.length; i++){
                $('#list_products_new').append("<div class=\"col-lg-3 col-md-4 col-sm-6 pb-1\">\n" +
                    "<div class=\"product-item bg-light mb-4\">\n" +
                    "<div class=\"product-img position-relative overflow-hidden\">\n" +
                    "<img class=\"img-fluid w-100\" src=\"http://127.0.0.1:8000/"+ result.list_products[i].thumbnail+"\" alt=\"\">\n" +
                    "<div class=\"product-action\">\n" +
                    "<a class=\"btn btn-outline-dark btn-square\" href=\"\"><i class=\"fa fa-shopping-cart\"></i></a>\n" +
                    "<a class=\"btn btn-outline-dark btn-square\" href=\"\"><i class=\"far fa-heart\"></i></a>\n" +
                    "<a class=\"btn btn-outline-dark btn-square\" href=\"\"><i class=\"fa fa-sync-alt\"></i></a>\n" +
                    "<a class=\"btn btn-outline-dark btn-square\" href=\"\"><i class=\"fa fa-search\"></i></a>\n" +
                    "</div>\n" +
                    "</div>\n" +
                    "<div class=\"text-center py-4\">\n" +
                    "<a class=\"h6 text-decoration-none text-truncate\" href=\"\">"+ result.list_products[i].name +"</a>\n" +
                    "<div class=\"d-flex align-items-center justify-content-center mt-2\">\n" +
                    "<h5>"+ result.list_products[i].price +"$</h5><h6 class=\"text-muted ml-2\"><del>"+ result.list_products[i].price +"$</del></h6>\n" +
                    "</div>\n" +
                    "<div class=\"d-flex align-items-center justify-content-center mb-1\">\n" +
                    "<small class=\"fa fa-star text-primary mr-1\"></small>\n" +
                    "<small class=\"fa fa-star text-primary mr-1\"></small>\n" +
                    "<small class=\"fa fa-star text-primary mr-1\"></small>\n" +
                    "<small class=\"fa fa-star text-primary mr-1\"></small>\n" +
                    "<small class=\"fa fa-star text-primary mr-1\"></small>\n" +
                    "<small>"+ result.list_products[i].count +"</small>\n" +
                    "</div>\n" +
                    "</div>\n" +
                    "</div>\n" +
                    "</div>")
            }
        },
        error: function (xhr, status) {
            alert(status);
        }
    });
});
