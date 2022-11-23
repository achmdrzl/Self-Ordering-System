<div>
    <table id="table-id" cellpadding="5" class="table display expandable-table table-responsive-md" style="width:100%;">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Menu</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Gambar</th>
                <th>Stok</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <input type="hidden" class="delete_id" value="{{ $product->id }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $product->name_product }}</td>
                    <td>{{ $product->category->name_category }}</td>
                    <td>{{ $product->price }}</td>
                    <td>
                        @if ($product->gallery)
                            <a href="{{ $product->gallery->first()->getUrl() }}" target="_blank">

                                <img src="{{ $product->gallery->first()->getUrl() }}">
                            </a>
                        @else
                            <span class="badge badge-warning">Tidak Ada Gambar!</span>
                        @endif
                    </td>
                    <td class="shoping__cart__quantity">
                        <div class="quantity">
                            <div class=""
                                style="justify-content:center; text-align:center; width:130px; height:30px; margin: 0 auto;">
                                @if($product->stock == null)
                                @else
                                <button wire:click.prevent="decreaseQuantity('{{ $product->id }}')"
                                    class="text-gray-500 focus:outline-none focus:text-gray-600">-</button>
                                @endif
                                <input id=demoInput type=number min=1 max=100
                                    value="{{ $product->stock == null ? '0' : $product->stock }}" readonly
                                    style="border:none; background:whitesmoke; text-align:center; font-weight:bold; width:60px; margin:auto;">
                                <button wire:click.prevent="increaseQuantity('{{ $product->id }}')"
                                    class="text-gray-500 focus:outline-none focus:text-gray-600">+</button>
                            </div>
                        </div>
                    </td>
                    <th>
                        <div class="badge badge-{{ $product->status === 'unactive' ? 'danger' : 'success' }}">
                            {{ strtoupper($product->status) }}</div>
                    </th>
                    <td>
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-md text-white"
                            style="height:40px; display:inline-flex; align-items:center; justify-content: center;"><i
                                class="ti-eye"></i> Detail</a>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-md"
                            style="height:40px; display:inline-flex; align-items:center; justify-content: center;"><i
                                class="ti-pencil"></i> Edit</a>
                        @if ($product->status === 'unactive')
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-success btn-md btnactive"
                                    style="height:40px; display:inline-flex; align-items:center; justify-content: center;"><i
                                        class="ti-cloud-down"></i> Tampilkan</button>
                            </form>
                        @else
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-md btnunactive"
                                    style="height:40px; display:inline-flex; align-items:center; justify-content: center;"><i
                                        class="ti-cloud-up"></i> Arsipkan</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
