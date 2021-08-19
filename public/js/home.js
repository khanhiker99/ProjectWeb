// $(document).ready(function() {

// })

function addProduct(id, name, information, picture) {
    let product = { id: id, name: name, information: information, picture: picture };
    let products = [];
    console.log(product);
    if (localStorage.getItem('products')) {
        products = JSON.parse(localStorage.getItem('products'));
    }
    products.push(product);

    localStorage.setItem('products', JSON.stringify(products));
    alert(products);
}



window.onload = function() {
    showProduct();

}

function removeProduct(productId) {
    alert("Remove product")
        // Your logic for your app.

    // strore products in local storage

    let storageProducts = JSON.parse(localStorage.getItem('products'));
    let products = storageProducts.filter(product => product.id != productId);
    console.log(productId);

    localStorage.setItem('products', JSON.stringify(products));
    showProduct();
}



function showProduct() {
    let listProducts = JSON.parse(localStorage.getItem('products'));

    console.log(listProducts);
    let content = "";
    for (let i = 0; i < listProducts.length; i++) {
        content += `  
        <tr>
            <td> ` + listProducts[i].id + ` </td>
                    
            <td> ` + listProducts[i].name + ` </td>
            <td> ` + listProducts[i].information + ` </td>
            <td>
            <input type="number" >
            </td>
            <td> 
            ` + listProducts[i].information + `
            </td>
            <td>
                <a class="btn btn-warning" href="#">Detail</a>   
            
                <button class="btn btn-danger" onclick="removeProduct( ` + listProducts[i].id + `)">Delete</button>
            </td>  
        </tr>   `
    }
    var data = document.getElementById("data");
    data.innerHTML = content
}