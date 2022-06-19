const path = "/eCommerce/"

function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (7*24*60*60*1000));
    let expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " +expires+ ";path=/";
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) === ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) === 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}


function round(value, decimals) {
    return Number(Math.round(value+'e'+decimals)+'e-'+decimals);
}

function reloadPanier() {
    let panier = getCookie("products");
    let count = 0;
    let array = [];
    if(panier !== "" && panier !== null) {
        array = JSON.parse(panier);
        count = array.length;
    }

    if(count === 0) {
        $("#panier_counter").hide();
        let panier_content = $("#panier_products");
        panier_content.append("<p class='text-center'>Votre panier est vide.</p>");
    } else {
        $("#panier_counter").show();
        $("#panier_counter").text(count);
    }

    if(count > 0) {
        let panier_content = $("#panier_products");
        let panier_price = 0;
        panier_content.text(" ");
        for (const i in array) {
            let product = array[i];
            let price_string = product.price.replace(" €", "").replace(",", ".")
            let price = parseFloat(price_string)
            panier_price += price;

            panier_content.append("<li>\n" +
                "                            <a class=\"dropdown-item\" href=\"#\">\n" +
                "                                <div class=\"row\">\n" +
                "                                    <div class=\"col-3\">\n" +
                "                                        <img width=\"50px\" src=\""+product.image+"\" alt=\"\">\n" +
                "                                    </div>\n" +
                "                                    <div class=\"col-9\">\n" +
                "                                        "+product.name+"\n" +
                "                                        <p class=\"card-title pricing-card-title text-danger\">\n" +
                "                                            "+product.price+"\n" +
                "                                        </p>\n" +
                "                                    </div>\n" +
                "                                </div>\n" +
                "                            </a>\n" +
                "                        </li>");
        }
        $("#panier_price").text(round(panier_price, 2) + " €")
    }
}


$(document).ready(function() {

    function addRequest(id) {

        $.post(path+'request', {type:'add', id:id});

    }

    function addInPanier(clicked, cookieName = false) {
        let brut_id = $(clicked).attr('id').replace("product_", "");

        let id = $(clicked).attr('id')+"_content";
        let product_string = "#"+id+" h4";
        let product_price = $.trim($(product_string+"[name='price_product']").text());
        let product_name = $.trim($(product_string+"[name='name_product']").text());
        let product_img = $.trim($("#"+id+" img").attr("src"));

        let all = getCookie("products");
        let arrayAll = []
        let obj = {
            id: brut_id,
            name: product_name,
            price: product_price,
            image: product_img
        }
        if(all !== "" && all !== null) {

            arrayAll = JSON.parse(all);
            arrayAll.push(obj)
        } else {

            arrayAll.push(obj)
        }
        if(!cookieName) {
            addRequest(brut_id);
        }
        setCookie("products", JSON.stringify(arrayAll), 7);
        if(cookieName) {
            setCookie("productsNOTLOGGED", JSON.stringify(arrayAll), 7);
        }



        $("#"+id).append("<div class=\"toast-container position-fixed bottom-0 end-0 p-3\">\n" +
            "  <div id=\"liveToast\" class=\"toast\" role=\"alert\" aria-live=\"assertive\" aria-atomic=\"true\">\n" +
            "    <div class=\"toast-header\">\n" +
            "      <i class=\"fa fa-shopping-cart\"></i>&nbsp;\n" +
            "      <strong class=\"me-auto\"> Votre panier</strong>\n" +
            "      <small>Succès</small>\n" +
            "      <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"toast\" aria-label=\"Close\"></button>\n" +
            "    </div>\n" +
            "    <div class=\"toast-body text-black\">\n" +
            "      Le produit a bien été ajouté à votre panier.\n" +
            "    </div>\n" +
            "  </div>\n" +
            "</div>");

        const toastElement = document.getElementById('liveToast')
        const toast = new bootstrap.Toast(toastElement)

        toast.show()

        reloadPanier();


    }

    reloadPanier();

    $("[name='filter_by_prices']").click(function (e) {

        let minPrice = $('#minPriceFilter').val();
        let maxPrice = $('#maxPriceFilter').val();

        if(maxPrice !== '' && minPrice !== '') {
            document.location.href = path+minPrice+'~'+maxPrice
        } else if( maxPrice !== '' && minPrice === '') {
            document.location.href = path+'all~'+maxPrice
        } else {
            document.location.href = path+minPrice+'~all'
        }

    })

    $("[name='buy_not_logged']").click(function (e) {

        const toastElement = document.getElementById('notLogged')
        const toast = new bootstrap.Toast(toastElement)

        toast.show()

    })

    $("[name='buy_product']").click(function (e) {
        addInPanier(this);
    })

    $("[name='buy_product_not_logged']").click(function (e) {

        addInPanier(this, true);
    })
});