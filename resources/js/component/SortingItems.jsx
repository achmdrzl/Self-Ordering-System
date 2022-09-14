import { useState, useEffect } from "react";
import { createRoot } from "react-dom/client";
import axios from "axios";
import { useNavigate, useParams } from 'react-router-dom';

const SortingItems = () => {
    const [products, setProducts] = useState([]);
    const [loading, setLoading] = useState(true);
    const { slug } = useParams()

    useEffect(() => {
        const url = (`sorting`)
        axios.get(url).then(res => {
            if (res.status === 200) {
                setProducts(res.data.products)
            }
            setLoading(false);
        });
    }, []);

    return 
}

export default SortingItems;

if (document.getElementById('sorting-items')) {
    createRoot(document.getElementById('sorting-items')).render(<SortingItems />)
}