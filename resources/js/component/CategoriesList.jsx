import React, { useState, useEffect } from 'react';
import { createRoot } from 'react-dom/client';
import axios from 'axios';

const CategoriesList = () => {

    const [category, setCategories] = useState([]);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        axios.get('categories').then(res => {
            if (res.status === 200) {
                setCategories(res.data.category)
            }
            setLoading(false);
        });
    }, []);

    console.log(category);

    return loading ? (
        <div className="col-lg-12 col-md-12">
            <div className="filter__found">
                <h6><span>Categories Empty</span></h6>
            </div>
        </div>
    ) : (
        category.length === 0 ?
            <div className="col-lg-12 col-md-12">
                <div className="filter__found">
                    <h6><span>categories Empty</span></h6>
                </div>
            </div>
            : category.map((category, i) => {
                return (
                    <div key={i} className="col-lg-4 col-md-6 col-sm-12 mix">
                        <div className="featured__item">
                            <a href={`shop/${category.slug}`}>
                                <div className="featured__item__pic set-bg"
                                    data-setbg="" style={{ backgroundImage: `url(${category.media[0].original_url})` }}
                                ></div>
                            </a>
                            <div className="featured__item__text">
                                <h5><a href={`shop/${category.slug}`}
                                    style={{ color: "black" }}>{category.name_category}</a></h5>
                            </div>
                        </div>
                    </div>
                )
            })
    )

}

export default CategoriesList;

if (document.getElementById('category-list')) {
    createRoot(document.getElementById('category-list')).render(<CategoriesList />)
}