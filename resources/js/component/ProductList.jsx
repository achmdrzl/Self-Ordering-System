import { useState, useEffect } from "react";
import { createRoot } from "react-dom/client";
import axios from "axios";
import { useNavigate, useParams } from 'react-router-dom';

const ProductList = () => {
    const [products, setProducts] = useState([]);
    const [loading, setLoading] = useState(true);
    const { slug } = useParams()

    useEffect(() => {
        const url = (`/shop/${slug}`)
        axios.put(url).then(res => {
            if (res.status === 200) {
                setProducts(res.data.products)
            }
            setLoading(false);
        });
    }, []);

    console.log(products);

    return loading ? (
        <div className="col-lg-12 col-md-12">
            <div className="filter__found">
                <h6><span>Product Empty</span></h6>
            </div>
        </div>
    ) 
    : (
        products.data.length === 0 ?
            <div className="col-lg-12 col-md-12">
                <div className="filter__found">
                    <h6><span>Product Empty</span></h6>
                </div>
            </div>
            : products.data.map((products, i) => {
                return (
                    <div key={i} className="col-lg-4 col-md-6 col-sm-6">
                        <div className="product__item">
                            <div className="product__item__pic set-bg"
                                data-setbg="" style={{ backgroundImage: `url(${products.media[0].original_url})` }}>
                                <ul className="product__item__pic__hover">
                                    <li><a href="#"><i className="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div className="product__item__text">
                                <h6><a
                                    href={`product/${products.slug}`}>{products.name_product}</a>
                                </h6>
                                <h5>Rp. {products.price}</h5>
                            </div>
                        </div>
                    </div>
                )
            })
    )
}

export default ProductList;

if (document.getElementById('product-list')) {
    createRoot(document.getElementById('product-list')).render(<ProductList />)
}