import React from "react";
import { Link } from 'react-router-dom';

const Paginator = ({ meta }) => {
    console.log(meta)
    const next = meta.links[meta.links.length - 1].url;
    const prev = meta.links[0].url;
    const current = meta.current_page;
    return (
        <div className="btn-group">
            {prev && <Link path={prev} className="btn btn-outline">«</Link>}
            <Link className="btn btn-outline">{current}</Link>
            {next && <Link path={next} className="btn btn-outline">»</Link>}
        </div>
    )
}

export default Paginator;