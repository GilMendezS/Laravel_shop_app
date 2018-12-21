export default class Product {
    constructor(
        id,
        name,
        description,
        featured,
        price,
        inlimited,
        stock,
        number,
        brand,
        barcode,
        status_id,
        weight
    ){
        this.id = id;
        this.name = name;
        this.description = description;
        this.featured = featured;
        this.price = price;
        this.inlimited = inlimited;
        this.stock = stock;
        this.number = number;
        this.brand = brand;
        this.barcode = barcode;
        this.status_id = status_id,
        this.weight = weight;
    }
}