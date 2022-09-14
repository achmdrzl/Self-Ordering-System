import React, { useState, useEffect } from 'react';
import { createRoot } from 'react-dom/client';
import axios from 'axios';

const TablesList = () => {

    const [tables, setTables] = useState([]);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        axios.get('customers').then(res => {
            if (res.status === 200) {
                setTables(res.data.tables)
            }
            setLoading(false);
        });
    }, []);

    console.log(tables);

    return loading ? (
        <div className="col-lg-12 col-md-12">
            <div className="filter__found">
                <h6><span>Categories Empty</span></h6>
            </div>
        </div>
    ) : (tables.length === 0 ?
        <div className="col-lg-12 col-md-12">
            <div className="filter__found">
                <h6><span>Categories Empty</span></h6>
            </div>
        </div>
        : tables.map((tables, i) => {
            return (
                <tbody key={i} id="tables-list">
                    <tr>
                        <th>{tables.no_table}</th>
                        <td>
                            {tables.status === 'Free' ?
                                <div class="badge badge-success">{tables.status}
                                </div>
                                : <div class="badge badge-warning">{tables.status}
                                </div>
                            }
                        </td>
                        <td>
                            <a href="{{ route('tables.show', $customer->id) }}"
                                class="btn btn-info btn-md text-white"
                                style="width: 50px; height:40px; display:inline-flex; align-items:center; justify-content: center;"><i
                                    class="ti-printer"></i></a>
                            <form onclick="return confirm('are you sure?')"
                                action="{{ route('tables.destroy', $customer->id) }}"
                                method="POST" class="d-inline">
                                <button type="submit" class="btn btn-danger btn-md"
                                    style="width: 50px; height:40px"><i
                                        class="ti-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            )
        })

    )

    // return loading ? (
    //     <div className="col-lg-12 col-md-12">
    //         <div className="filter__found">
    //             <h6><span>Categories Empty</span></h6>
    //         </div>
    //     </div>
    // ) : (
    //     category.length === 0 ?
    //         <div className="col-lg-12 col-md-12">
    //             <div className="filter__found">
    //                 <h6><span>categories Empty</span></h6>
    //             </div>
    //         </div>
    //         : category.map((category, i) => {
    //             return (
    //                 <div key={i} className="col-lg-4 col-md-6 col-sm-12 mix">
    //                     <div className="featured__item">
    //                         <a href={`shop/${category.slug}`}>
    //                             <div className="featured__item__pic set-bg"
    //                                 data-setbg="" style={{ backgroundImage: `url(${category.media[0].original_url})` }}
    //                             ></div>
    //                         </a>
    //                         <div className="featured__item__text">
    //                             <h5><a href={`shop/${category.slug}`}
    //                                 style={{ color: "black" }}>{category.name_category}</a></h5>
    //                         </div>
    //                     </div>
    //                 </div>
    //             )
    //         })
    // )

}

export default TablesList;

if (document.getElementById('tables-list')) {
    createRoot(document.getElementById('tables-list')).render(<TablesList />)
}